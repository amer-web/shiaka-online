@extends('layouts.master')
@section('css')
@endsection
@section('title','المنتجات الرئيسية')
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
									<h4 class="card-title mg-b-0">لغات الموقع</h4>
									<i class="mdi mdi-dots-horizontal text-gray"></i>
								</div>
							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table class="table table-hover mb-0 text-md-nowrap">
										<thead>
											<tr>
												<th>الاسم</th>
												<th>الأختصار</th>
												<th>الاتجاه</th>
												<th>الحالة</th>
												<th>الإجراءات</th>
											</tr>
										</thead>
										<tbody>
                                            @forelse ($categories as $category)
                                            <tr>
												<th scope="row">{{$category->name}}</th>
												<td>{{$category->status}}</td>

												<td>
                                                    <a class="btn btn-sm btn-secondary"
                                                href="{{ route('admin.categories.edit', $category) }}">تعديل</a>
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
