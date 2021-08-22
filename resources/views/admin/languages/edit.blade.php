@extends('layouts.master')
@section('css')
<!-- Internal Select2 css -->
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection
@section('title', 'تعديل لغة')
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">لغات الموقع</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">> تعديل لغة جديدة</span>
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
								<h4 class="card-title mb-1">بيانات اللغة</h4>
							</div>
							<div class="card-body pt-0">
								<form action="{{route('admin.languages.update',$language->id)}}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="id" value="{{$language->id}}">
									<div class="">
										<div class="form-group">
											<label for="exampleInputEmail1">أسم اللغة</label>
											<input type="text" class="form-control" name="name" id="exampleInputEmail1" placeholder="مثال العربية" value="{{old('name',$language->name)}}">
                                            @error('name')
                                            <span class="text-danger">
                                                {{$message}}
                                            </span>
                                            @enderror
										</div>
										<div class="form-group">
											<label for="exampleInputPassword1">أختصار اللغة</label>
											<input type="text" class="form-control" name="abbr" id="exampleInputPassword1" placeholder="مثال ar" value="{{old('abbr',$language->abbr)}}">
                                            @error('abbr')
                                            <span class="text-danger">
                                                {{$message}}
                                            </span>
                                            @enderror
										</div>
                                        <div class="row row-sm">
                                            <div class="col-lg-4 mg-b-20 mg-lg-b-0">
                                                <p class="mg-b-10">الاتجاه</p><select class="form-control select2" name="direction">
                                                    <option value="rtl" {{$language->direction == 'rtl'? 'selected' : ''}} >
                                                        من اليمين إلى اليسار
                                                    </option>
                                                    <option value="ltr" {{$language->direction == 'ltr'? 'selected' : ''}}>
                                                        من السيار إلى اليمين
                                                    </option>
                                                </select>
                                                @error('direction')
                                            <span class="text-danger">
                                                {{$message}}
                                            </span>
                                            @enderror
                                            </div>
                                        </div>
                                        <div class="custom-control custom-switch mt-3">
                                            <input type="checkbox" class="custom-control-input" id="customSwitch1" name="status"  value="1" {{$language->status == 1 ? 'checked' :''}}>
                                            <label class="custom-control-label" for="customSwitch1">الحالة</label>
                                          </div>
									</div>
									<button type="submit" class="btn btn-primary mt-3 mb-0">حفظ</button>
									<a href="{{route('admin.languages.index')}}" class="btn btn-warning mt-3 mb-0">الغاء</a>
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
@endsection
