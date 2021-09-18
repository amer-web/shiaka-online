<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\ProductCouponRequest;
use App\Http\Requests\LanguageRequest;
use App\Models\ProductCoupon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductCouponController extends Controller
{
    protected $product_coupon;

    public function __construct(ProductCoupon $product_coupon)
    {
        $this->product_coupon = $product_coupon;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product_coupons = $this->product_coupon->paginate(10);
        return view('admin.product_coupons.index', compact('product_coupons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.product_coupons.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductCouponRequest $request)
    {
        $data = $request->except('_token');
        $this->product_coupon->create($data);
        return redirect()->route('admin.product_coupons.index')->with('success', 'تم اضافة الكوبون بنجاح');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product_coupon = $this->product_coupon->findOrFail($id);
        return view('admin.product_coupons.edit', compact('product_coupon'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductCouponRequest $request, $id)
    {
        $product_coupon = $this->product_coupon->findOrFail($id);
        $data = $request->except('_token', '_method');
        $data = array_merge($data, ['status' => $request->input('status', 0)]);
        $product_coupon->update($data);
        return redirect()->route('admin.product_coupons.index')->with('success', 'تم تعديل الكوبون بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product_coupon = $this->product_coupon->findOrFail($id);
        $product_coupon->delete();
        return redirect()->route('admin.product_coupons.index')->with('success', 'تم حذف الكوبون بنجاح');
    }
}
