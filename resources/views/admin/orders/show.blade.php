@extends('layouts.master')
@section('css')
    <!-- Internal Select2 css -->
    <link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection
@section('title','الطلبات')
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الطلبات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">> عرض طلب</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row opened -->
    <div class="row row-sm">
        <!--div-->
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-around ">
                        <h4 class="card-title mg-b-0 pt-4">عرض طلب الخاص بالعميل {{$order->user->full_name}}</h4>
                        @if( !empty($orders_status) )
                            <div>
                                <form action="{{route('admin.orders.update',setCrypt($order->id))}}" method="POST">
                                    @csrf
                                    @method('PUT')
                                <div class="mg-b-20 mg-lg-b-0">
                                        <p class="mg-b-10">تحديث حالة الطلب</p>
                                    <select class="form-control select2 orders_status"
                                            name="orders_status" onchange="this.form.submit()">
                                            <option></option>
                                            @foreach($orders_status as $key => $value)
                                                <option value="{{$key}}">
                                                    {{$value}}
                                                </option>
                                        @endforeach
                                    </select>
                                </div>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0 text-md-nowrap">
                            <tbody>

                            <tr>
                                <td class="tx-bold">رقم المرجع</td>
                                <td>{{$order->ref_id}}</td>
                                <td class="tx-bold">العميل</td>
                                <td>{{$order->user->full_name}}</td>
                                <td class="tx-bold">العنوان</td>
                                <td>{{$order->user_address->company_name}}</td>
                            </tr>
                            <tr>
                                <td class="tx-bold">شركة الشحن</td>
                                <td>{{$order->shipping_company->name}}</td>
                                <td class="tx-bold">التاريخ</td>
                                <td>{{$order->created_at->format('Y-m-d')}}</td>
                                <td class="tx-bold">الحالة</td>
                                <td>{!! $order->status() !!}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!--/div-->
    </div>
    <div class="row row-sm">
        <!--div-->
        <div class="col-md-4">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex ">
                        <h4 class="card-title mg-b-0">تفاصيل الحساب الخاص بالعميل {{$order->user->full_name}}</h4>

                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0 text-md-nowrap">
                            <tbody>
                            <tr>
                                <td>
                                    <h5 class="order-h3">الاجمالى</h5>
                                </td>
                                <td>
                                    <h5 class="order-h3">${{number_format($order->subtotal,2)}}</h5>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h5 class="order-h3">الخصم</h5>
                                </td>
                                <td>
                                    <h5 class="order-h3">${{number_format($order->discount,2)}}</h5>
                                </td>

                            </tr>
                            <tr>
                                <td>
                                    <h5 class="order-h3">الضريبة</h5>
                                </td>
                                <td>
                                    <h5 class="order-h3">${{number_format($order->tax,2)}}</h5>
                                </td>

                            </tr>
                            <tr>
                                <td>
                                    <h5 class="order-h3">مصاريف شحن</h5>
                                </td>
                                <td>
                                    <h5 class="order-h3">${{number_format($order->shipping,2)}}</h5>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <h5 class="order-h3">الاجمالى الكلى</h5>
                                </td>
                                <td>
                                    <h5 class="order-h3">${{number_format($order->total,2)}}</h5>
                                </td>
                            </tr>


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="tx-center">
                        <h4 class="card-title mg-b-0">العمليات</h4>

                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0 text-md-nowrap">
                            <thead>
                            <tr>
                                <td>رقم العملية</td>
                                <td>التاريخ</td>
                                <td>الحالة</td>
                                <td>الوصف</td>
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
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header pb-0">
                    <div class="tx-center">
                        <h4 class="card-title mg-b-0">المنتجات</h4>

                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0 text-md-nowrap">
                            <thead>
                            <tr>
                                <td>اسم المنتج</td>
                                <td>السعر</td>
                                <td>الكمية</td>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($order->products as $product)
                                <tr>
                                    <td>
                                        {{$product->name}}
                                    </td>
                                    <td>
                                        {{$product->price}}
                                    </td>
                                    <td>{{$product->pivot->qty}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!--/div-->
    </div>
    <!-- /row -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
    <script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>

    <script>
        $(function () {
            let pluginSelect2 = function (selector, placeholder) {
                $(selector).select2({
                    placeholder: placeholder,
                });
            }
            pluginSelect2('.orders_status', 'اختر حالة الطلب');
        });
    </script>
@endsection
