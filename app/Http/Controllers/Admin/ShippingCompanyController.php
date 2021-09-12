<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\ShippingCompanyRequest;
use App\Models\Country;
use App\Models\ShippingCompany;
use Illuminate\Http\Request;

class ShippingCompanyController extends Controller
{
    protected $shipping_company;
    protected $country;

    public function __construct(ShippingCompany $shipping_company, Country $country)
    {
        $this->shipping_company = $shipping_company;
        $this->country = $country;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shipping_companies = $this->shipping_company->withCount('countries')->paginate(10);
        return view('admin.shipping_companies.index', compact('shipping_companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = $this->country->get(['id', 'name']);
        return view('admin.shipping_companies.create', compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ShippingCompanyRequest $request)
    {
        $data = $request->except(['country_id', '_token']);
        $shipping_company = $this->shipping_company->create($data);
        $shipping_company->countries()->attach($request->country_id);
        return redirect()->route('admin.shipping_companies.index')->with('success', 'تم أضافة شركة الشحن بنجاح');

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
        $shipping_company = $this->shipping_company->with('countries')->findOrFail($id);
        $countries = $this->country->get(['id', 'name']);
        return view('admin.shipping_companies.edit', compact('shipping_company', 'countries'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(ShippingCompanyRequest $request, $id)
    {
        $shipping_company = $this->shipping_company->findOrFail($id);
        $data = $request->except(['country_id', '_token', '_method']);
        $data = array_merge($data, ['fast' => $request->input('fast', 0),'status' => $request->input('status', 0)]);
        $shipping_company->update($data);
        $shipping_company->countries()->sync($request->country_id);
        return redirect()->route('admin.shipping_companies.index')->with('success', 'تم تعديل شركة الشحن بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $shipping_company = $this->shipping_company->findOrFail($id);
        $shipping_company->delete();
        return redirect()->route('admin.shipping_companies.index')->with('success', 'تم حذف شركة الشحن بنجاح');
    }
}
