@extends('layouts.master')
@section('css')
    <!-- Internal Select2 css -->
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/plugins/fileinput/css/fileinput.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/fileinput/css/fileinput-rtl.min.css') }}">


@endsection
@section('title', 'اضافة منتج جديد')
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">المنتجات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">>
                   اضافة منتج جديد</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row row-sm">
        <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
            <div class="card  box-shadow-0 ">
                <div class="card-header">
                    <h4 class="card-title mb-1">بيانات المنتج</h4>
                </div>
                <div class="card-body pt-0">
                    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="">
                            @foreach ($languages as $language)
                                <label class="d-block mt-3" for="exampleInputEmail1">اسم المنتج باللغة
                                    {{ __("admin.$language->abbr") }}</label>
                                <input type="text" class="form-control" name="data[{{ $language->abbr }}][name]"
                                       id="exampleInputEmail1" value="{{ old("data.$language->abbr.name") }}">
                                @error("data.$language->abbr.name")
                                <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                                <div class="control-group">
                                    <label class="mt-3">وصف المنتج باللغة {{ __("admin.$language->abbr") }}</label>
                                    <textarea class="control"
                                              name="data[{{ $language->abbr }}][description]">{{ old("data.$language->abbr.description") }}</textarea>
                                </div>
                                @error("data.$language->abbr.description")
                                <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                            @endforeach
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label for="price">السعر</label>
                                    <input type="text" class="form-control" name="price" id="price"
                                           placeholder="" value="{{old('price')}}">
                                    @error('price')
                                    <span class="text-danger">
                                                {{$message}}
                                            </span>
                                    @enderror
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="quantity">الكمية</label>
                                    <input type="text" class="form-control" name="quantity" id="quantity"
                                           placeholder="" value="{{old('quantity')}}">
                                    @error('quantity')
                                    <span class="text-danger">
                                                {{$message}}
                                            </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="custom-control custom-switch mt-3 col-6">
                                    <input type="checkbox" class="custom-control-input" id="featured" name="featured"
                                           value="1" {{old('featured') ? 'checked' : ''}}>
                                    <label class="custom-control-label tx-16" for="featured">مميز</label>
                                </div>
                                <div class="custom-control custom-switch mt-3 col-6">
                                    <input type="checkbox" class="custom-control-input" id="customSwitch2" name="status"
                                           value="1" {{old('status') ? 'checked' : ''}}>
                                    <label class="custom-control-label tx-16" for="customSwitch2">الحالة</label>
                                </div>
                            </div>
                        </div>
                        <div class="mg-b-20 mg-lg-b-0 mt-4">
                            <p class="mg-b-10">الاقسام</p><select class="form-control select2 " name="category_id">
                                <option></option>
                                @foreach($categories as $category)
                                    <option
                                        value="{{$category->id}}" {{old('category_id') ==  $category->id? 'selected' : ''}}>
                                        {{$category->name}}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                            <span class="text-danger">
                                                {{$message}}
                                            </span>
                            @enderror
                        </div>
                        <div class="form-group mt-3">
                            <label for="images">صور المنتج</label>

                            <div class="file-loading">
                                <input id="images" name="images[]" type="file" multiple>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3 mb-0">حفظ</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- row -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')

    <!-- Internal Select2.min js -->
    <script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/tinyMCE/tinymce.min.js') }}"></script>

    <script src="{{ asset('assets/plugins/fileinput/js/plugins/piexif.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/fileinput/js/plugins/sortable.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/fileinput/js/fileinput.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/fileinput/themes/fa/theme.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/fileinput/js/locales/ar.js') }}"></script>
    <script>
        $(function () {
            $('.select2').select2({
                placeholder: "اختر القسم"
            });
            $(document).ready(function () {
                tinymce.init({
                    selector: 'textarea',
                    height: 150,
                    width: "100%",
                    plugins: 'image imagetools media wordcount save fullscreen code table lists link hr',
                    toolbar1: 'formatselect | bold italic strikethrough forecolor backcolor link hr | alignleft aligncenter alignright alignjustify | numlist bullist outdent indent  | removeformat | code | table',
                    image_advtab: true
                });
            });
            $("#images").fileinput({
                theme: 'fa',
                maxFileCount: 5,
                allowedFileTypes: ['image'],
                rtl: true,
                overwriteInitial: false,
                showRemove: true,
                showUpload:false,
                showCancel: true,
                language: "ar"
            });

        });
    </script>
@endsection
