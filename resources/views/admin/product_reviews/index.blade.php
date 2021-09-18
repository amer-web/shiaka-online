@extends('layouts.master')
@section('css')
@endsection
@section('title','تعليقات المنتجات')
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">تعليقات المنتجات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">> عرض الكل</span>
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
                        <h4 class="card-title mg-b-0">الخصومات</h4>
                        <i class="mdi mdi-dots-horizontal text-gray"></i>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0 text-md-nowrap">
                            <thead>
                            <tr>
                                <th>الاسم</th>
                                <th>المعدل</th>
                                <th>التعليق</th>
                                <th>المنتج</th>
                                <th>الحالة</th>
                                <th>التاريخ</th>
                                <th>الإجراءات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse ($product_reviews as $review)
                                <tr>
                                    <th scope="row">{{$review->name}}</th>
                                    <td> <span class="badge badge-success">{{$review->rating}}</span> </td>
                                    <td>{{$review->comment}}</td>
                                    <td>{{$review->product_id}}</td>
                                    <td>{{$review->status}}</td>
                                    <td>{{$review->created_at}}</td>
                                    <td>
                                        <a class="fa fa-edit fa-fw text-primary"
                                           href="{{ route('admin.product_reviews.edit', $review->id) }}"></a>
                                        <a href="" class="fa fa-trash fa-fw text-danger ml-1 delete_message"
                                           data-title="حذف كوبون"
                                           data-description="هل تريد حذف هذا الكوبون ؟"
                                           data-toggle="modal" data-target="#exampleModal"
                                           data-id="{{ $review->id }}"></a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">لا يوجد تعليقات حتى الآن</td>
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
                $('#modelDelete').attr('action', 'product_reviews/' + idMessage + '');
                $("#exampleModalLabel").text($(this).data('title'));
                $(".modal-body").text($(this).data('description'));
            });
        });
    </script>
@endsection
