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
        return redirect()->route('admin.customers.index');
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
        $data = $request->except(['_token']);
        $this->customer_address->first() ? true :$data = array_merge($data,['default_address' => 1]);
        $customer_address = $this->customer_address->create($data);
        if ($customer_address->default_address)
            $this->customer_address->where('id', '<>', $customer_address->id)->update(['default_address' => 0]);
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
        $customer_addresses = $this->user->with(['addresses' => function ($q) {
            $q->with('state', 'country', 'city');
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
        $customer_address = $this->customer_address->findOrFail($id);
        $countries = $this->country->get(['id', 'name']);
        return view('admin.customer_addresses.edit', compact('customer_address', 'countries'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(CustomerAddressRequest $request, $id)
    {
        $customer_address = $this->customer_address->findOrFail($id);
        $data = $request->except(['_token', '_method']);
        $data = array_merge($data, ['default_address' => $request->input('default_address', 0)]);
        $customer_address->update($data);
        if ($customer_address->default_address)
            $this->customer_address->where('id', '<>', $customer_address->id)->update(['default_address' => 0]);
        else
            $this->customer_address->orderBy('created_at', 'desc')->first()->update(['default_address' => 1]);
        return redirect()->route('admin.customer_addresses.show', $request->user_id)->with('success', 'تم تعديل العنوان بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer_address = $this->customer_address->findOrFail($id);
        if ($customer_address->default_address)
        {
            $default_address  = $this->customer_address->where('id', '<>', $customer_address->id)->orderBy('created_at', 'desc')->first();
            $default_address ? $default_address->update(['default_address' => 1]) : false;
        }
        $customer_address->delete();
        return redirect()->back()->with('success', 'تم حذف العنوان بنجاح');
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
