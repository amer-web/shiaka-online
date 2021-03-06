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

        .tree-container>.tree-item {
            padding-right: 0px;
        }

        .radio .radio-view {
            margin-left: 5px;
        }

    </style>
@endsection
@section('title', 'اضافة قسم رئيسي')
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الاقسام الرئيسية</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">>
                    أضافة قسم جديد</span>
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
                    <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <label>صورة القسم</label>
                        <input type="file" name="photo" id="">
                        @error('photo')
                            <span class="text-danger d-block">
                                {{ $message }}
                            </span>
                        @enderror

                        <div class="">
                            @foreach ($languages as $language)
                                <label class="d-block mt-3" for="exampleInputEmail1">اسم القسم باللغة
                                    {{ __("admin.$language->abbr") }}</label>
                                <input type="text" class="form-control" name="data[{{ $language->abbr }}][name]"
                                    id="exampleInputEmail1" value="{{ old("data.$language->abbr.name") }}">
                                @error("data.$language->abbr.name")
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                                <div class="control-group">
                                    <label class="mt-3">الوصف باللغة {{ __("admin.$language->abbr") }}</label>
                                    <textarea class="control"
                                        name="data[{{ $language->abbr }}][description]">{{ old("data.$language->abbr.description") }}</textarea>
                                </div>
                                @error("data.$language->abbr.description")
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                            @endforeach
                            <tree-view value-field="id" name-field="parent_id" input-type="radio" items='@json($categories)'
                                fallback-locale="{{ config('app.fallback_locale') }}"></tree-view>
                            <div>
                                <label class="d-block mt-3" for="exampleInputEmail1">ترتيبه فى القوائم </label>
                                <input type="text" class="form-control" name="position" id="exampleInputEmail1"
                                    value="{{ old('position') }}">
                                @error('position')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="custom-control custom-switch mt-3">
                                <input type="checkbox" class="custom-control-input" id="customSwitch1" {{old('status') == '1' ? 'checked' : ''}}  name="status"
                                    value="1">
                                <label class="custom-control-label" for="customSwitch1">الحالة</label>
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
    <script src="{{ asset('assets-ui/js/ui.js') }}"></script>
    <script>
        $('.select2-no-search').select2({
            minimumResultsForSearch: Infinity,
        });
        $(document).ready(function() {
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
