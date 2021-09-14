@extends('layouts.master')
@section('css')
    <!-- Internal Select2 css -->
    <link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">

@endsection
@section('title', 'اضافة عنوان جديد')
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">عناوين العملاء</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">> أضافة عنوان جديد للعميل {{$customer_address->full_name}}</span>
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
                    <h4 class="card-title mb-1">بيانات العنوان الجديد</h4>
                </div>
                <div class="card-body pt-0">
                    <form action="{{route('admin.customer_addresses.store')}}" method="POST">
                        @csrf
                        <input type="hidden" name="user_id" value="{{$customer_address->id}}">
                        <div class="">
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label for="exampleInputCompanyName">اسم الشركة</label>
                                    <input type="text" class="form-control" name="company_name"
                                           id="exampleInputCompanyName"
                                           placeholder="" value="{{old('company_name')}}">
                                    @error('company_name')
                                    <span class="text-danger">
                                                {{$message}}
                                            </span>
                                    @enderror
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="exampleInputFirstName">الاسم الأول</label>
                                    <input type="text" class="form-control" name="first_name" id="exampleInputFirstName"
                                           placeholder="" value="{{old('first_name')}}">
                                    @error('first_name')
                                    <span class="text-danger">
                                                {{$message}}
                                            </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label for="exampleInputLastName">اسم العائلة</label>
                                    <input type="text" class="form-control" name="last_name" id="exampleInputLastName"
                                           placeholder="" value="{{old('last_name')}}">
                                    @error('last_name')
                                    <span class="text-danger">
                                                {{$message}}
                                            </span>
                                    @enderror
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="exampleInputMobile">الموبايل</label>
                                    <input type="text" class="form-control" name="mobile" id="exampleInputMobile"
                                           placeholder="" value="{{old('mobile')}}">
                                    @error('mobile')
                                    <span class="text-danger">
                                                {{$message}}
                                            </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="">
                                <div class="mg-b-20 mg-lg-b-0">
                                    <p class="mg-b-10">الدولة</p><select class="form-control select2 country"
                                                                         name="country_id">
                                        <option></option>
                                        @foreach($countries as $country)
                                            <option
                                                value="{{$country->id}}" {{old('country_id') == $country->id? 'selected' : ''}}>
                                                {{$country->name}}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('country_id')
                                    <span class="text-danger">
                                                {{$message}}
                                            </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="form-group col-sm-6">
                                    <p class="mg-b-10">المنطقة</p><select class="form-control select2 state"
                                                                          name="state_id">
                                    </select>
                                    @error('state_id')
                                    <span class="text-danger">
                                                {{$message}}
                                            </span>
                                    @enderror
                                </div>
                                <div class="form-group col-sm-6">
                                    <p class="mg-b-10">المدينة</p>
                                    <select class="form-control select2 city"
                                            name="city_id">

                                    </select>
                                    @error('city_id')
                                    <span class="text-danger">
                                                {{$message}}
                                            </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label for="exampleInputAddress">عنوان السكن</label>
                                    <input type="text" class="form-control" name="address" id="exampleInputAddress"
                                           placeholder="" value="{{old('address')}}">
                                    @error('address')
                                    <span class="text-danger">
                                                {{$message}}
                                            </span>
                                    @enderror
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="exampleInputEmail1">الرمز البريدى</label>
                                    <input type="text" class="form-control" name="post_code" id="exampleInputEmail1"
                                           placeholder="" value="{{old('post_code')}}">
                                    @error('post_code')
                                    <span class="text-danger">
                                                {{$message}}
                                            </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mt-2">
                                <div class="custom-control custom-switch mt-3 col-6">
                                    <input type="checkbox" class="custom-control-input" id="customSwitch1"
                                           name="default_address"
                                           value="1" {{old('default_address') ? 'checked' : ''}}>
                                    <label class="custom-control-label tx-16" for="customSwitch1">العنوان
                                        الافتراضي</label>
                                </div>
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
    <script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
    <script>
        $(function () {
            let pluginSelect2 = function (selector, placeholder) {
                $(selector).select2({
                    placeholder: placeholder,
                });
            }
            pluginSelect2('.country', 'أختر الدولة');
            pluginSelect2('.state', 'أختر المحافظة');
            pluginSelect2('.city', 'أختر المدينة');

            @if(old('country_id'))
            get_state();
            @endif
            @if(old('state_id'))
            get_cities();
            @endif


            function get_state() {
                let id = $('.country').val();
                $.ajax({
                    method: "POST",
                    url: "{{ route('admin.customer_addresses.get_states') }}",
                    data: {
                        '_token': '{{ csrf_token() }}',
                        'id': id
                    },
                    success: function (data, two) {
                        if (two === 'success') {
                            $('.state').children().remove();
                            $('.city').children().remove();
                            $('.state').append('<option></option>');
                            $.each(data, function (val, text) {
                                let selection = text.id == '{{old('state_id')}}' ? 'selected' : '';
                                $('.state').append('<option value="' + text.id + '" ' + selection + '>' + text.name + '</option>');
                            })
                        } else {
                        }
                    }
                });
            }

            function get_cities() {
                let id = $('.state').val()  ?? "{{old('state_id')}}" ;
                $.ajax({
                    method: "POST",
                    url: "{{ route('admin.customer_addresses.get_cities') }}",
                    data: {
                        '_token': '{{ csrf_token() }}',
                        'id': id
                    },
                    success: function (data, two) {
                        if (two === 'success') {
                            $('.city').children().remove();
                            $('.city').append('<option></option>');
                            $.each(data, function (val, text) {
                                let selection = text.id == '{{old('city_id')}}' ? 'selected' : '';
                                $('.city').append('<option value="' + text.id + '" ' + selection + '>' + text.name + '</option>');
                            })
                        } else {
                        }
                    }
                });
            }

            $('.card-body').on('change', '.country', function () {
                get_state();
            });
            $('.card-body').on('change', '.state', function () {
                get_cities();
            });


        });


    </script>
@endsection
