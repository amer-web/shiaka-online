@extends('layouts.master')
@section('css')
    <!-- Internal Select2 css -->
    <link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">

@endsection
@section('title', 'تعديل شركة شحن')
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">شركات الشحن</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">> تعديل شركة شحن</span>
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
                    <h4 class="card-title mb-1">بيانات شركة الشحن</h4>
                </div>
                <div class="card-body pt-0">
                    <form action="{{route('admin.shipping_companies.update',$shipping_company->id)}}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="id" value="{{$shipping_company->id}}">
                        <div class="">
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label for="exampleInputEmail1">اسم شركة الشحن</label>
                                    <input type="text" class="form-control" name="name" id="exampleInputEmail1"
                                           placeholder="" value="{{old('name',$shipping_company->name)}}">
                                    @error('name')
                                    <span class="text-danger">
                                                {{$message}}
                                            </span>
                                    @enderror
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="exampleInputEmail1">الكود</label>
                                    <input type="text" class="form-control" name="code" id="exampleInputEmail1"
                                           placeholder="" value="{{old('code',$shipping_company->code)}}">
                                    @error('code')
                                    <span class="text-danger">
                                                {{$message}}
                                            </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">التكلفة</label>
                                <input type="text" class="form-control" name="cost" id="exampleInputPassword1" value="{{old('cost',$shipping_company->cost)}}"
                                >
                                @error('cost')
                                <span class="text-danger">
                                                {{$message}}
                                            </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">الوصف</label>
                                <input type="text" class="form-control" name="description" id="exampleInputPassword1" value="{{old('description',$shipping_company->description)}}"
                                >
                                @error('description')
                                <span class="text-danger">
                                                {{$message}}
                                            </span>
                                @enderror
                            </div>
                            <div class="">
                                <div class="mg-b-20 mg-lg-b-0">
                                    <p class="mg-b-10">الدول</p><select class="form-control select2 " name="country_id[]" multiple="multiple" >
                                        @foreach($countries as $country)
                                            <option
                                                value="{{$country->id}}" {{in_array($country->id,old('country_id',$shipping_company->countries->pluck('id')->toArray())) ? 'selected' : ''}}>
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
                            <div class="row mt-2">
                                <div class="custom-control custom-switch mt-3 col-6">
                                    <input type="checkbox" class="custom-control-input" id="customSwitch1" name="fast"
                                           value="1" {{old('fast',$shipping_company->fast) ? 'checked' : ''}}>
                                    <label class="custom-control-label tx-16" for="customSwitch1">سريع الشحن</label>
                                </div>
                                <div class="custom-control custom-switch mt-3 col-6">
                                    <input type="checkbox" class="custom-control-input" id="customSwitch2" name="status"
                                           value="1" {{old('status',$shipping_company->status) ? 'checked' : ''}}>
                                    <label class="custom-control-label tx-16" for="customSwitch2">الحالة</label>
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
            $('.select2').select2();
        });
    </script>
@endsection
