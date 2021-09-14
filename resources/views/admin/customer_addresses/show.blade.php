@extends('layouts.master')
@section('css')
@endsection
@section('title')
    عناوين العميل {{$customer_addresses->full_name}}
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">عناوين العملاء</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">> عرض
                    الكل</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <a href="{{route('admin.customer_addresses.create',$customer_addresses->id)}}" class="btn btn-primary">اضافة عنوان
        جديد</a>
    <!-- row opened -->
    <div class="row row-sm">
        <!--div-->
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title mg-b-0">عناوين العميل {{$customer_addresses->full_name}}</h4>
                        <i class="mdi mdi-dots-horizontal text-gray"></i>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0 text-md-nowrap">
                            <thead>
                            <tr>
                                <th>اسم الشركة</th>
                                <th>الدولة</th>
                                <th>المنطقة</th>
                                <th>المدينة</th>
                                <th>عنوان السكن</th>
                                <th>الرمز البريدى</th>
                                <th>العنوان الرئيسي</th>
                                <th>الاجراءات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse ($customer_addresses->addresses as $customer_address)
                                <tr>
                                    <td>
                                    {{ $customer_address->company_name }}</th>
                                    <td>{{ $customer_address->country->name }}</td>
                                    <td>{{ $customer_address->state->name }}</td>
                                    <td>{{ $customer_address->city->name }}</td>
                                    <td>{{$customer_address->address  }}</td>
                                    <td>{{ $customer_address->post_code }}</td>
                                    <td class="text-center">
                                        @if($customer_address->default_address)
                                            <span class="text-success tx-15 tx-bold">نعم</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a class="fa fa-edit fa-fw text-primary"
                                           href="{{ route('admin.shipping_companies.edit', $customer_address->id) }}"></a>
                                        <a href="" class="fa fa-trash fa-fw text-danger ml-1 delete_message"
                                           data-title="حذف شركة الشحن"
                                           data-description="هل تريد حذف شركة الشحن ؟"
                                           data-toggle="modal" data-target="#exampleModal"
                                           data-id="{{ $customer_address->id }}"></a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center">لا يوجد عناوين للعميل حتى الآن</td>
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
                $('#modelDelete').attr('action', 'shipping_companies/' + idMessage + '');
                $("#exampleModalLabel").text($(this).data('title'));
                $(".modal-body").text($(this).data('description'));
            });
        });
    </script>
@endsection
