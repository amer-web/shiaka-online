@extends('layouts.master')
@section('css')
@endsection
@section('title','الطلبات')
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الطلبات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">> عرض الكل</span>
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
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title mg-b-0">الطلبات</h4>
                        <i class="mdi mdi-dots-horizontal text-gray"></i>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0 text-md-nowrap">
                            <thead>
                            <tr>
                                <th>رقم المرجع</th>
                                <th>الاسم</th>
                                <th>الاجمالى</th>
                                <th>الحالة</th>
                                <th>تاريخ </th>
                                <th>الإجراءات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse ($orders as $order)
                                <tr>
                                    <td>{{$order->ref_id}}</td>
                                    <td>{{$order->user->full_name}}</td>
                                    <td>{{$order->total}}</td>
                                    <td>{!! $order->status() !!}</td>
                                    <td>{{$order->created_at->format('Y-m-d')}}</td>

                                    <td>
                                        <a class="fa fa-eye fa-fw fa-1x text-info"
                                           href="{{ route('admin.orders.show', setCrypt($order->id) ) }}"></a>
                                        <a href="" class="fa fa-trash fa-fw text-danger ml-1 delete_message"
                                           data-title="حذف عميل"
                                           data-description="هل تريد حذف هذا العميل ؟"
                                           data-toggle="modal" data-target="#exampleModal"
                                           data-id="{{ $order->id }}"></a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="">لا يوجد طلبات حتى الآن</td>
                                </tr>

                            @endforelse

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
    <script>
        $(function () {
            $('.delete_message').on('click', function () {
                let idMessage = $(this).data('id');
                $('#modelDelete').attr('action', 'orders/' + idMessage + '');
                $("#exampleModalLabel").text($(this).data('title'));
                $(".modal-body").text($(this).data('description'));
            });
        });
    </script>
@endsection
