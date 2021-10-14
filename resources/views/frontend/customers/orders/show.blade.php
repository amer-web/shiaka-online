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
                    <div class="card">

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover mb-0 text-md-nowrap">
                                    <thead>
                                    <tr>
                                        <th>رقم العملية</th>
                                        <th>الاجمالى</th>
                                        <th>الحالة</th>
                                        <th>التاريخ</th>
                                        <th>الإجراءات</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse ($orders as $order)
                                        <tr>
                                            <th>{{$order->ref_id}}</th>
                                            <th>{{$order->total }}</th>
                                            <td>{{$order->order_status}}</td>
                                            <td>{{$order->created_at->format('Y-m-d')}}</td>
                                            <td>
                                                <a class="fa fa-eye fa-fw text-primary"
                                                   href="{{ route('orders.show', setCrypt($order->id) ) }}"></a>
                                                <a class="fa fa-edit fa-fw text-primary"
                                                   href="{{ route('admin.categories.edit', $order->id) }}"></a>
                                                <a href="" class="fa fa-trash fa-fw text-danger ml-1 delete_message"
                                                   data-title="حذف قسم"
                                                   data-description="هل تريد حذف هذا القسم ؟"
                                                   data-toggle="modal" data-target="#exampleModal"
                                                   data-id="{{ $order->id }}"></a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="">لا يوجد طلبات حتى الآن</td>
                                        </tr>

                                    @endforelse

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
