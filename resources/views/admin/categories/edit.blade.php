@extends('layouts.master')
@section('css')
    <!-- Internal Select2 css -->
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets-ui/css/ui.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets-ui/css/admin.css') }}" rel="stylesheet">
    <style>
        .tree-container .tree-item {
            padding-right: 30px;

        .expand-icon,
        .folder-icon {
            margin-left: 10px;
            margin-right: 0px;
        }

        }

        .tree-container > .tree-item {
            padding-right: 0px;
        }

        .radio .radio-view {
            margin-left: 5px;
        }

    </style>
@endsection
@section('title', 'تعديل قسم ')
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الاقسام الرئيسية</h4><span
                    class="text-muted mt-1 tx-13 mr-2 mb-0">>
                    تعديل قسم</span>
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
                    <h4 class="card-title mb-1">بيانات القسم</h4>
                </div>
                <div class="card-body pt-0">
                    <form action="{{ route('admin.categories.update', $editCategory->id) }}" method="POST"
                          enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="text-center mb-3">
                            <img src="{{ asset($editCategory->photo) }}" alt="" srcset="" width="35%" height="35%">
                        </div>
                        <input type="file" name="photo" id="">
                        @error('photo')
                        <span class="text-danger d-block">
                                {{ $message }}
                            </span>
                        @enderror
                        <input type="hidden" name="category_id" value="{{ $editCategory->id }}">
                        <div class="">
                            @foreach ($editCategory->translations as $editCategoryTrans)
                                <label for="exampleInputEmail1" class="d-block mt-3">
                                    {{ __('admin.title-category', ['code' => __('admin.' . $editCategoryTrans->locale)]) }}</label>
                                <input type="text" class="form-control"
                                       name="data[{{ $editCategoryTrans->locale }}][name]"
                                       id="exampleInputEmail1"
                                       value="{{ old("data.$editCategoryTrans->locale.name", $editCategoryTrans->name) }}">
                                @error("data.$editCategoryTrans->locale.name")
                                <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                                <div class="control-group">
                                    <label class="mt-3">الوصف
                                        باللغة {{ __("admin.$editCategoryTrans->locale") }}</label>
                                    <textarea class="control"
                                              name="data[{{ $editCategoryTrans->locale }}][description]">{{ old("data.$editCategoryTrans->locale.description", $editCategoryTrans->description) }}</textarea>
                                </div>
                                @error("data.$editCategoryTrans->locale.description")
                                <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                            @endforeach
                            {{-- <div class="row row-sm mt-4">
                                <div class="col-sm-7">
                                    <select class="form-control select2-no-search" name="parent_id">
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ $category->id == $editCategory->parent_id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div> --}}
                            <tree-view value-field="id" name-field="parent_id" input-type="radio"
                                       items='@json($categories)' value='@json($editCategory->parent_id)'
                                       fallback-locale="{{ config('app.fallback_locale') }}"></tree-view>
                            <div>
                                <label class="d-block mt-3" for="exampleInputEmail1">ترتيبه فى القوائم </label>
                                <input type="text" class="form-control" name="position" id="exampleInputEmail1"
                                       value="{{ old('position', $editCategory->position) }}">
                                @error('position')
                                <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="custom-control custom-switch mt-3">
                                <input type="checkbox" class="custom-control-input" id="customSwitch1" name="status"
                                       value="1" {{ $editCategory->status == 1 ? 'checked' : '' }}>
                                <label class="custom-control-label" for="customSwitch1">الحالة</label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3 mb-0">حفظ</button>
                        <a href="{{route('admin.categories.index')}}" class="btn btn-warning mt-3 mb-0">الغاء</a>
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
    <script src="{{ asset('assets-ui/js/ui.js') }}"></script>
    <script>
        $('.select2-no-search').select2({
            minimumResultsForSearch: Infinity,
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
    </script>
@endsection
