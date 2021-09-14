<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\CustomerAddressRequest;
use App\Models\City;
use App\Models\Country;
use App\Models\State;
use App\Models\User;
use App\Models\UserAddress;
use Illuminate\Http\Request;

class CustomerAddressController extends Controller
{
    protected $customer_address;
    protected $country;
    protected $user;
    protected $state;
    protected $city;

    public function __construct(UserAddress $customer_address, Country $country, User $user, State $state, City $city)
    {
        $this->customer_address = $customer_address;
        $this->country = $country;
        $this->user = $user;
        $this->state = $state;
        $this->city = $city;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shipping_companies = $this->user_address->withCount('countries')->paginate(10);
        return view('admin.customer_addresses.index', compact('shipping_companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $customer_address = $this->user->findOrFail($id);
        $countries = $this->country->whereStatus('1')->get(['id', 'name']);
        return view('admin.customer_addresses.create', compact('customer_address', 'countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CustomerAddressRequest $request)
    {
       return $data = $request->except(['_token']);
        $customer_address = $this->customer_address->create($data);
        if($customer_address->default_address)
            $this->customer_address->where('id','<>',$customer_address->id)->update(['default_address' => 0]);
        return redirect()->route('admin.customer_addresses.show', $request->user_id)->with('success', 'تم أضافة العنوان بنجاح');

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $customer_addresses = $this->user->with(['addresses' => function($q){
          $q->with('state','country','city');
      }])->findOrFail($id);
        return view('admin.customer_addresses.show', compact('customer_addresses'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user_address = $this->user_address->with('countries')->findOrFail($id);
        $countries = $this->country->get(['id', 'name']);
        return view('admin.customer_addresses.edit', compact('user_address', 'countries'));
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
        $user_address = $this->user_address->findOrFail($id);
        $data = $request->except(['country_id', '_token', '_method']);
        $data = array_merge($data, ['fast' => $request->input('fast', 0), 'status' => $request->input('status', 0)]);
        $user_address->update($data);
        $user_address->countries()->sync($request->country_id);
        return redirect()->route('admin.customer_addresses.index')->with('success', 'تم تعديل شركة الشحن بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user_address = $this->user_address->findOrFail($id);
        $user_address->delete();
        return redirect()->route('admin.customer_addresses.index')->with('success', 'تم حذف شركة الشحن بنجاح');
    }

    public function get_states(Request $request)
    {
        $states = $this->state->where('country_id', $request->id)->get(['id', 'name'])->toArray();
        return response()->json($states);
    }

    public function get_cities(Request $request)
    {
        $states = $this->city->where('state_id', $request->id)->get(['id', 'name'])->toArray();
        return response()->json($states);
    }
}
