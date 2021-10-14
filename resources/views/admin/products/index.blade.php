@extends('layouts.master')
@section('css')
@endsection
@section('title','المنتجات ')
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">المنتجات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">> عرض الكل</span>
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
                        <h4 class="card-title mg-b-0">المنتجات</h4>
                        <i class="mdi mdi-dots-horizontal text-gray"></i>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0 text-md-nowrap tx-center">
                            <thead>
                            <tr>
                                <th>الصورة</th>
                                <th>اسم المنتج</th>
                                <th>الكمية</th>
                                <th>السعر</th>
                                <th>مميز</th>
                                <th>الحالة</th>
                                <th>الإجراءات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse ($products as $product)
                                <tr>
                                    <td>
                                        @if($product->media->count() > 0)
                                            <img width="50" height="50" src="{{asset($product->get_image())}}">
                                        @else
                                            ------
                                        @endif
                                    </td>
                                    <td>{{$product->name}}</td>
                                    <td>{{$product->quantity}}</td>
                                    <td>{{$product->price}}</td>
                                    <td>
                                        @if($product->featured)
                                            <span class="badge badge-success"
                                                  style="font-size: 12px !important;">{{$product->featured()}}</span>
                                        @endif
                                    </td>
                                    <td>{{$product->status()}}</td>
                                    <td>
                                        <a class="fa fa-edit fa-fw text-primary"
                                           href="{{ route('admin.products.edit', $product->id) }}"></a>
                                        <a href="" class="fa fa-trash fa-fw text-danger ml-1 delete_message"
                                           data-title="حذف منتج"
                                           data-description="هل تريد حذف هذا المنتج ؟"
                                           data-toggle="modal" data-target="#exampleModal"
                                           data-id="{{ $product->id }}"></a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">لا يوجد منتجات حتى الآن</td>
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
                $('#modelDelete').attr('action', 'products/' + idMessage + '');
                $("#exampleModalLabel").text($(this).data('title'));
                $(".modal-body").text($(this).data('description'));
            });
        });
    </script>
@endsection
