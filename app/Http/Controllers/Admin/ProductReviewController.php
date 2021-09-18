<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductReview;
use Illuminate\Http\Request;

class ProductReviewController extends Controller
{
    protected $product_review;

    public function __construct(ProductReview $product_review)
    {
        $this->product_review = $product_review;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product_reviews = $this->product_review->paginate(10);
        return view('admin.product_reviews.index', compact('product_reviews'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return redirect()->route('admin.product_reviews.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return redirect()->route('admin.product_reviews.index');
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
        $product_review = $this->product_review->findOrFail($id);
        return view('admin.product_reviews.edit', compact('product_review'));
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
        $product_review = $this->product_review->findOrFail($id);
        $data = $request->except('_token', '_method');
        $data = array_merge($data, ['status' => $request->input('status', 0)]);
        $product_review->update($data);
        return redirect()->route('admin.product_reviews.index')->with('success', 'تم تعديل الكوبون بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product_review = $this->product_review->findOrFail($id);
        $product_review->delete();
        return redirect()->route('admin.product_reviews.index')->with('success', 'تم حذف الكوبون بنجاح');
    }
}
