@extends('layouts.master')
@section('css')
@endsection
@section('title','الاقسام الرئيسية')
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الأقسام الرئيسية</h4><span
                    class="text-muted mt-1 tx-13 mr-2 mb-0">> عرض الكل</span>
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
                        <h4 class="card-title mg-b-0">الاقسام</h4>
                        <i class="mdi mdi-dots-horizontal text-gray"></i>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0 text-md-nowrap">
                            <thead>
                            <tr>
                                <th>اسم القسم</th>
                                <th>عدد المنتجات</th>
                                <th>القسم التابع</th>
                                <th>الحالة</th>
                                <th>تاريخ الانشاء</th>
                                <th>الإجراءات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse ($categories as $category)
                                <tr>
                                    <th>{{$category->name}}</th>
                                    <th>{{$category->products_count}}</th>
                                    <td>{{$category->parent->name}}</td>
                                    <td>{{$category->status()}}</td>
                                    <td>{{$category->created_at->format('Y-m-d')}}</td>
                                    <td>
                                        <a class="fa fa-edit fa-fw text-primary"
                                           href="{{ route('admin.categories.edit', $category->id) }}"></a>
                                        <a href="" class="fa fa-trash fa-fw text-danger ml-1 delete_message"
                                           data-title="حذف قسم"
                                           data-description="هل تريد حذف هذا القسم ؟"
                                           data-toggle="modal" data-target="#exampleModal"
                                           data-id="{{ $category->id }}"></a>
                                    </td>


                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="">لا يوجد اقسام حتى الآن</td>
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
                $('#modelDelete').attr('action', 'categories/' + idMessage + '');
                $("#exampleModalLabel").text($(this).data('title'));
                $(".modal-body").text($(this).data('description'));
            });
        });
    </script>
@endsection
