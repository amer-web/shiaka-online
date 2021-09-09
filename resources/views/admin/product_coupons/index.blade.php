@extends('layouts.master')
@section('css')
@endsection
@section('title','الخصومات')
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">الخصومات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">> عرض الكل</span>
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
									<h4 class="card-title mg-b-0">الخصومات</h4>
									<i class="mdi mdi-dots-horizontal text-gray"></i>
								</div>
							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table class="table table-hover mb-0 text-md-nowrap">
										<thead>
											<tr>
												<th>الكود</th>
												<th>النوع</th>
												<th>القيمة</th>
												<th>عدد مرات الاستخدام</th>
												<th>عدد المرات</th>
												<th>تاريخ الخصم</th>
												<th>تاريخ انتهاء الخصم</th>
												<th>الحالة</th>
												<th>الشرط</th>
												<th>الإجراءات</th>
											</tr>
										</thead>
										<tbody>
                                            @forelse ($product_coupons as $coupon)
                                            <tr>
												<th scope="row">{{$coupon->code}}</th>
												<td>{{$coupon->type == 'fixed' ? 'قيمة' : 'نسبة مئوية'}}</td>
												<td>{{$coupon->type == 'fixed' ?'$ ' . $coupon->value : '% ' . $coupon->value}}</td>
												<td>{{$coupon->used_times}}</td>
												<td>{{$coupon->use_times}}</td>
												<td>{{$coupon->start_date}}</td>
												<td>{{$coupon->expire_date}}</td>
												<td>{{$coupon->status ? 'مفعل' : 'غير مفعل'}}</td>
												<td>{{$coupon->greater_than ?? 'ـــ'}}</td>

												<td>
                                                    <a class="btn btn-sm btn-secondary"
                                                href="{{ route('admin.categories.edit', $coupon) }}">تعديل</a>
                                            <a class="btn btn-sm btn-danger">حذف</a>
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
@endsection
