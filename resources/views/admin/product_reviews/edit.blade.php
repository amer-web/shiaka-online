@extends('layouts.master')
@section('css')
    <!-- Internal Select2 css -->
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/pickdate/themes/classic.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/pickdate/themes/classic.date.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/pickdate/themes/rtl.css') }}" rel="stylesheet">
    <style>
        .picker__select--month, .picker__select--year {
            padding: 0 !important;
        }
    </style>
@endsection
@section('title', 'تعديل خصم')
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الخصومات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">>
                   تعديل خصم</span>
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
                    <h4 class="card-title mb-1">بيانات الكوبون</h4>
                </div>
                <div class="card-body pt-0">
                    <form action="{{ route('admin.product_coupons.update',$product_coupon->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="id" value="{{$product_coupon->id}}">
                        <div class="">
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label for="code">الكود</label>
                                    <input type="text" class="form-control code" name="code" id="code"
                                           placeholder="" value="{{old('code',$product_coupon->code)}}">
                                    @error('code')
                                    <span class="text-danger">
                                                {{$message}}
                                            </span>
                                    @enderror
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="value">قيمة الكوبون</label>
                                    <input type="text" class="form-control" name="value" id="value"
                                           placeholder="" value="{{old('value',$product_coupon->value)}}">
                                    @error('value')
                                    <span class="text-danger">
                                                {{$message}}
                                            </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <div class="">
                                        <p class="mg-b-10">نوع الكوبون</p><select class="form-control select2 "
                                                                                  name="type">
                                            <option></option>
                                            <option value="fixed" {{old('type',$product_coupon->type) == 'fixed' ? 'selected' : ''}}>
                                                قيمة ثابتة
                                            </option>
                                            <option value="percentage" {{old('type',$product_coupon->type) == 'percentage' ? 'selected' : ''}}>
                                                نسبة مئوية
                                            </option>
                                        </select>
                                        @error('type')
                                        <span class="text-danger">
                                                {{$message}}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="form-group col-sm-6">
                                    <label for="start_date">تاريخ الاستخدام</label>
                                    <input type="text" class="form-control" name="start_date" id="start_date"
                                           placeholder="" value="{{old('start_date',$product_coupon->start_date)}}">
                                    @error('start_date')
                                    <span class="text-danger">
                                                {{$message}}
                                            </span>
                                    @enderror
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="expire_date">تاريخ الانتهاء</label>
                                    <input type="text" class="form-control" name="expire_date" id="expire_date"
                                           placeholder="" value="{{old('expire_date',$product_coupon->expire_date)}}">
                                    @error('expire_date')
                                    <span class="text-danger">
                                                {{$message}}
                                            </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="">
                                <div class="form-group ">
                                    <label for="description">الوصف</label>
                                    <input type="text" class="form-control" name="description" id="description"
                                           placeholder="" value="{{old('description',$product_coupon->description)}}">
                                    @error('description')
                                    <span class="text-danger">
                                                {{$message}}
                                            </span>
                                    @enderror
                                </div>

                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label for="use_times">عدد مرات الاستخدام</label>
                                    <input type="text" class="form-control" name="use_times" id="use_times"
                                           placeholder="" value="{{old('use_times',$product_coupon->use_times)}}">
                                    @error('use_times')
                                    <span class="text-danger">
                                                {{$message}}
                                            </span>
                                    @enderror
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="greater_than">الشرط</label>
                                    <input type="text" class="form-control" name="greater_than" id="greater_than"
                                           placeholder="" value="{{old('greater_than',$product_coupon->greater_than)}}">
                                    @error('greater_than')
                                    <span class="text-danger">
                                                {{$message}}
                                            </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="custom-control custom-switch mt-3">
                                <input type="checkbox" class="custom-control-input" id="customSwitch1" name="status"
                                       value="1" {{old('status',$product_coupon->status) ? 'checked' : ''}}>
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
    <script src="{{ URL::asset('assets/plugins/pickdate/picker.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/pickdate/picker.date.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/pickdate/translations/ar.js') }}"></script>

    <script>
        $('.select2').select2({
            placeholder: 'اختر نوع الكوبون'
        });
        $('.code').keyup(function () {
            this.value = this.value.toUpperCase();
        });
        $('#start_date').pickadate({
            formatSubmit: '',
            format: 'yyyy-mm-dd',
            selectMonths: true,
            selectYears: true,
            closeOnSelect: true,

        });
        $('#expire_date').pickadate({
            formatSubmit: '',
            format: 'yyyy-mm-dd',
            selectMonths: true,
            selectYears: true,
            closeOnSelect: true,
        });
        var start_date = $('#start_date').pickadate('picker');
        var end_date = $('#expire_date').pickadate('picker');

        $('#start_date').change(function () {
            selected_date = '';
            selected_date = $(this).val();
            selected_end_date = $('#expire_date').val();
            if (selected_date != '') {
                selected_date >= selected_end_date ? $('#expire_date').val('') : selected_end_date;
                var startDate = new Date(selected_date);
                min_date = '';
                min_date = new Date(startDate.getFullYear(), startDate.getMonth(), startDate.getDate() + 1);
                end_date.set('min', min_date);
            }
        });


    </script>
@endsection
