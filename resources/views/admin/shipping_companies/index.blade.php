@extends('layouts.master')
@section('css')
@endsection
@section('title', 'شركات الشحن')
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">لغات الموقع</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">> عرض
                    الكل</span>
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
                        <h4 class="card-title mg-b-0">لغات الموقع</h4>
                        <i class="mdi mdi-dots-horizontal text-gray"></i>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0 text-md-nowrap">
                            <thead>
                            <tr>
                                <th>الاسم</th>
                                <th>الكود</th>
                                <th>الوصف</th>
                                <th>شحن سريع</th>
                                <th>التكلفة</th>
                                <th>عدد الدول</th>
                                <th>الحالة</th>
                                <th>الاجراءات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse ($shipping_companies as $shipping_company)
                                <tr>
                                    <td>
                                    {{ $shipping_company->name }}</th>
                                    <td>{{ $shipping_company->code }}</td>
                                    <td>{{ $shipping_company->description }}</td>
                                    <td>{{ $shipping_company->fast() }}</td>
                                    <td>{{ number_format($shipping_company->cost,2)  }}</td>
                                    <td>{{ $shipping_company->countries_count }}</td>
                                    <td>{{ $shipping_company->status() }}</td>
                                    <td>
                                        <a class="fa fa-edit fa-fw text-primary"
                                           href="{{ route('admin.shipping_companies.edit', $shipping_company->id) }}"></a>
                                        <a href="" class="fa fa-trash fa-fw text-danger ml-1 delete_message" data-title="حذف شركة الشحن"
                                           data-description="هل تريد حذف شركة الشحن ؟"
                                           data-toggle="modal" data-target="#exampleModal"
                                           data-id="{{ $shipping_company->id }}"></a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="">لا يوجد لغات حتى الآن</td>
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
