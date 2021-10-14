@extends('layouts.master')
@section('css')

@endsection
@section('title', 'تعديل بيانات عميل')
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">العملاء</h4><span
                    class="text-muted mt-1 tx-13 mr-2 mb-0">>
                    تعديل عميل</span>
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
                    <h4 class="card-title mb-1">بيانات العميل</h4>
                </div>
                <div class="card-body pt-0">
                    <form action="{{ route('admin.customers.update',$customer->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" value="{{$customer->id}}" name="id">
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label for="exampleInputEmail1">الاسم الأول</label>
                                <input type="text" class="form-control" name="first_name" id="exampleInputEmail1"
                                       placeholder="" value="{{old('first_name',$customer->first_name)}}">
                                @error('first_name')
                                <span class="text-danger">
                                        {{$message}}
                                </span>
                                @enderror
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="exampleInputEmail1">اسم العائلة</label>
                                <input type="text" class="form-control" name="last_name" id="exampleInputEmail1"
                                       placeholder="" value="{{old('last_name',$customer->last_name)}}">
                                @error('last_name')
                                <span class="text-danger">
                                                {{$message}}
                                            </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label for="exampleInputEmail1">اسم المستخدم</label>
                                <input type="text" class="form-control" name="username" id="exampleInputEmail1"
                                       placeholder="" value="{{old('username',$customer->username)}}">
                                @error('username')
                                <span class="text-danger">
                                        {{$message}}
                                </span>
                                @enderror
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="exampleInputEmail1">  البريد الإلكترونى <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="email" id="exampleInputEmail1"
                                       placeholder="" value="{{old('email',$customer->email)}}">
                                @error('email')
                                <span class="text-danger">
                                                {{$message}}
                                            </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label for="exampleInputEmail1">الموبايل</label>
                                <input type="text" class="form-control" name="mobile" id="exampleInputEmail1"
                                       placeholder="" value="{{old('mobile',$customer->mobile)}}">
                                @error('mobile')
                                <span class="text-danger">
                                        {{$message}}
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="custom-control custom-switch mt-3">
                            <input type="checkbox" class="custom-control-input" id="customSwitch2" name="status"
                                   value="1" {{old('status',$customer->status) ? 'checked' : ''}}>
                            <label class="custom-control-label tx-16" for="customSwitch2">الحالة</label>
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
@endsection
