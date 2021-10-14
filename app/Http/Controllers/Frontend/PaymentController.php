<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\OrderRepositoryInterface;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductCoupon;
use App\Services\OmniPayService;
use Gloudemans\Shoppingcart\Facades\Cart;
use HttpResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public $product;
    public $orderRepository;


    public function __construct(Product $product, OrderRepositoryInterface $orderRepository)
    {
        $this->orderRepository = $orderRepository;
        $this->product = $product;
    }

    public function checkout(Request $request)
    {
        $this->method = $request->input('payment-method');

        try {
            DB::beginTransaction();
            $order = $this->orderRepository->create($request->all());
            $omnipay = new OmniPayService($order->payment_method);
            $data = [
                'amount' => number_format($order->total_paid, 2, '.', ''),
                'transactionId' => $order->id,
                'currency' => 'USD',
                'cancelUrl' => $omnipay->getUrlCanceled(setCrypt($order->id)),
                'returnUrl' => $omnipay->getUrlComplete(setCrypt($order->id)),
            ];
            if ($order->payment_method == 'Myfatoorah') {
                $data = array_merge($data, ['Card' => [
                    'firstName' => $order->user->first_name,
                    'lastName' => $order->user->last_name,
                    'email' => $order->user->email,
                ]]);
            }
            $response = $omnipay->purchase($data);
            DB::commit();
            if ($response->isRedirect()) {
                if ($order->payment_method == 'Myfatoorah') {
                    return new RedirectResponse($response->getRedirectUrl());
                }
                $response->redirect();
            }
        } catch (\Exception $exception) {
            return $exception->getMessage();
            DB::rollback();
            return redirect()->route('frontend.checkout')->with('warning', 'هناك خطأ ما حاول مره أخرى');
        }
    }

    public function completed($order_id)
    {
        $order = Order::findOrFail(getDecrypt($order_id));
        $omnipay = new OmniPayService($order->payment_method);
        $data = ['amount' => number_format($order->total_paid, 2, '.', ''),
            'transactionId' => $order->id,
            'currency' => 'USD',
            'cancelUrl' => $omnipay->getUrlCanceled(setCrypt($order->id)),
            'returnUrl' => $omnipay->getUrlComplete(setCrypt($order->id)),
        ];
        if ($order->payment_method == 'Myfatoorah') {
            $data = ['paymentId' => request()->input('paymentId')];
        }
        $response = $omnipay->completed($data);

        if ($response->isSuccessful()) {
            $order->update(['order_status' => Order::PAYMENT_COMPLETED]);
            $order->products()->each(function ($product) {
                $product->update(['quantity' => $product->quantity - $product->pivot->qty]);
            });
            $order->transactions()->create([
                'transaction' => Order::PAYMENT_COMPLETED,
                'transaction_number' => $response->getTransactionReference(),
                'payment_result' => 'success',
            ]);
            if (session()->has('coupon')) {
                $coupon = ProductCoupon::where('code', session()->get('coupon')['code'])->first();
                $coupon->increment('used_times');
            }
            Cart::instance('default')->destroy();
            session()->forget(['coupon', 'shipping']);
            return redirect()->route('index')->with('success', 'تم عملية الشراء بنجاح');
        }

        return redirect()->route('index')->with('warring', 'لم يتم الدفع حاول مره أخرى');

    }

    public function cancel($order_id)
    {
        $order = Order::findOrFail(getDecrypt($order_id));
        $order->update(['order_status' => Order::CANCELED]);
        return redirect()->route('frontend.cart')->with('error', 'تم الغاء عملية الشراء');
    }
}
