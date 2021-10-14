@extends('layouts.frontend.app')
@section('styles')
    <style>
        .title-name {
            padding-bottom: 21px;
            margin-bottom: 21px;
            border-bottom: 2px solid #DCDCDD;
        }

        .title-name a.current {
            color: red;
        }
    </style>

@endsection
@section('content')
    <!-- Page Introduction Wrapper -->
    <div class="page-style-a">
        <div class="container">
            <div class="page-intro">
                <h2>Detail</h2>
                <ul class="bread-crumb">
                    <li class="has-separator">
                        <i class="ion ion-md-home"></i>
                        <a href="home.html">Home</a>
                    </li>
                    <li class="is-marked">
                        <a href="single-product.html">Detail</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Page Introduction Wrapper /- -->
    <div class="page-shop u-s-p-t-80">
        <div class="container">
            <!-- Shop-Intro -->
            <div class="shop-intro">
                <h3>الطلبات</h3>
            </div>

            <div class="row">
                <!-- Shop-Left-Side-Bar-Wrapper -->
                @include('frontend.customers.sidebar')
                <div class="col-lg-10 col-md-10 col-sm-12">
                    <div class="order-table">
                        <table class="u-s-m-b-13">
                            <thead>
                            <tr>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Qty</th>
                                <th>Total</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($order->products as $item)
                                <tr>
                                    <td>
                                        <h6 class="order-h6">{{$item->name}}</h6>
                                    </td>
                                    <td>
                                        <h6 class="order-h6">{{$order->paymentCurrencySymbol()}} {{number_format($item->price * $order->rating_default_currency,2)}}</h6>
                                    </td>
                                    <td>
                                        <h6 class="order-h6">{{$item->pivot->qty}}</h6>
                                    </td>
                                    <td>
                                        <h6 class="order-h6">{{$order->paymentCurrencySymbol()}} {{number_format($item->price * $item->pivot->qty  * $order->rating_default_currency,2)}}</h6>
                                    </td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="2"></td>
                                <td>
                                    <h3 class="order-h3">Subtotal</h3>
                                </td>
                                <td>
                                    <h3 class="order-h3">{{$order->paymentCurrencySymbol()}} {{number_format($order->subtotal * $order->rating_default_currency,2)}}</h3>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2"></td>
                                <td>
                                    <h3 class="order-h3">Discount</h3>
                                </td>
                                <td>
                                    <h3 class="order-h3">{{$order->paymentCurrencySymbol()}} {{number_format($order->discount * $order->rating_default_currency,2)}}</h3>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2"></td>
                                <td>
                                    <h3 class="order-h3">Tax</h3>
                                </td>
                                <td>
                                    <h3 class="order-h3">{{$order->paymentCurrencySymbol()}} {{number_format($order->tax * $order->rating_default_currency,2)}}</h3>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2"></td>
                                <td>
                                    <h3 class="order-h3">Shipping</h3>
                                </td>
                                <td>
                                    <h3 class="order-h3">{{$order->paymentCurrencySymbol()}} {{number_format($order->shipping * $order->rating_default_currency,2)}}</h3>
                                </td>
                            </tr>

                            <tr>
                                <td colspan="2"></td>
                                <td>
                                    <h3 class="order-h3">Total</h3>
                                </td>
                                <td>
                                    <h3 class="order-h3">{{$order->paymentCurrencySymbol()}} {{number_format($order->total * $order->rating_default_currency,2)}}</h3>
                                </td>
                            </tr>
                            @if($order->payment_currency != "USD")
                            <tr>
                                <td colspan="2"></td>
                                <td>
                                    <h3 class="order-h3">Total</h3>
                                </td>
                                <td>
                                    <h3 class="order-h3">{{$order->paymentCurrencySymbol()}} {{number_format($order->total * $order->rating_default_currency,2)}}</h3>
                                </td>
                            </tr>
                                @endif
                            </tbody>
                        </table>

                    </div>
                    <div class="card">
                        <div class="card-header pb-0">
                            <div class="tx-center">
                                <h4 class="card-title mg-b-0">transactions</h4>

                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover mb-0 text-md-nowrap">
                                    <thead>
                                    <tr>
                                        <td>Ref</td>
                                        <td>Date</td>
                                        <td>Status</td>
                                        <td>Des</td>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($order->transactions as $transaction)
                                        <tr>
                                            <td>
                                                {{$transaction->transaction_number}}
                                            </td>
                                            <td>
                                                {{$transaction->created_at->format('Y-m-d')}}
                                            </td>
                                            <td>
                                                {!!  $order->status($transaction->transaction)!!}
                                            </td>
                                            <td>{{$transaction->payment_result}}</td>
                                        </tr>
                                        @if($transaction->transaction == \App\Models\Order::FINISHED && (5 - \Carbon\Carbon::now()->diffInDays($transaction->created_at->format('Y-m-d'))) >= 0 && $loop->last)
                                            <tr>
                                                <td colspan="2">you Can Return Order
                                                    in {{(5 - \Carbon\Carbon::now()->diffInDays($transaction->created_at->format('Y-m-d')))}}
                                                    Days
                                                </td>
                                                <td colspan="2">
                                                    <form action="{{route('orders.update',setCrypt($order->id))}}"
                                                          method="POST" >
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit" class="btn btn-sm btn-danger tx-white">
                                                            Return Order
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




@endsection
@section('js')



@endsection
