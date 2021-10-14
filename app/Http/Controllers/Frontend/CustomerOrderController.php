<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use ParagonIE\Sodium\Crypto;

class CustomerOrderController extends Controller
{
    public $order;

    /**
     * Display a listing of the resource.
     *
     * @param Order $order
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }
    public function index()
    {
        $orders =  auth()->user()->orders;
        return view('frontend.customers.orders.index',compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return redirect()->route('orders.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         $order = $this->order->where('id',getDecrypt($id))->where('user_id',auth()->user()->id)->with('products')->first();
        if (!$order)
            return abort(404);
        return view('frontend.customers.orders.show',compact('order'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $order = $this->order->findOrFail(getDecrypt($id));
        $order->update(['order_status' => Order::REFUNDED_REQUEST]);
        $order->transactions()->create([
            'transaction' => Order::REFUNDED_REQUEST,
            'payment_result' => 'Request Return Order'
        ]);
        return redirect()->route('orders.show',$id)->with('success','تم حفظ الطلب بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
