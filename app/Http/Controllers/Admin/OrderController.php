<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\ProductCoupon;
use App\Services\OmniPayService;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public $order;

    public $orders_status =
        ['0' => 'NewOrder',
            '1' => 'PAYMENT_COMPLETED',
            '2' => 'UNDER_PROCESS',
            '3' => 'FINISHED',
            '4' => 'REJECTED',
            '6' => 'REFUNDED REQUEST',
            '7' => 'Returned Order',
            '8' => 'REFUNDED',
        ];

    public function __construct(Order $order)
    {
        $this->order = $order;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     *
     */
    public function index()
    {
        $orders = $this->order->with('user')->paginate(10);
        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return redirect()->route('admin.orders.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = $this->order->findOrFail(getDecrypt($id));

        $order_key = array_search($order->order_status, array_keys($this->orders_status));

        if ($order_key) {
            $orders_status = array_slice($this->orders_status, $order_key + 1, null, true);
        } else {
            $orders_status = [];
        }

        return view('admin.orders.show', compact('order', 'orders_status'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $order = $this->order->findOrFail(getDecrypt($id));
        if ($request->orders_status == Order::REFUNDED) {
            $omniPayService = new OmniPayService($order->payment_method);

            $response = $omniPayService->refund([
                'amount' => number_format($order->total_paid , 2, '.', ''),
                'transactionReference' => $order->transactions->where('transaction',Order::PAYMENT_COMPLETED)->first()->transaction_number,
            ]);
            if ($response->isSuccessful()) {
                $order->update(['order_status' => Order::REFUNDED]);
                $order->products()->each(function ($product) {
                    $product->update(['quantity' => $product->quantity + $product->pivot->qty]);
                });

                $order->transactions()->create([
                    'transaction' => Order::REFUNDED,
                    'transaction_number' => $response->getTransactionReference(),
                    'payment_result' => 'success',
                ]);
                return redirect()->route('admin.orders.index')->with('success', 'تم استرجاع المبلغ بنجاح');
            } else {
                return redirect()->back()->with('warning',$response->getMessage());
            }
        } else {
            $order->update(['order_status' => $request->orders_status]);
            $order->transactions()->create([
                'transaction' => $request->orders_status,
                'payment_result' => $this->orders_status[$request->orders_status]
            ]);
            return redirect()->route('admin.orders.index')->with('success', 'تم تحديث حالة الطلب بنجاح');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
