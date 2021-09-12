<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\CustomerRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    protected $customer;

    public function __construct(User $customer)
    {
        $this->customer = $customer;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = $this->customer->whereRoleIs('customer')->paginate(10);
        return view('admin.customers.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.customers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CustomerRequest $request)
    {
        try {
            $data = $request->except(['_token', 'password']);
            $data = array_merge($data, ['password' => bcrypt($request->password)]);
            DB::beginTransaction();
            $customer = $this->customer->create($data);
            $customerRole = Role::whereName('customer')->first();
            $customer->attachRole($customerRole);
            DB::commit();
            return redirect()->route('admin.customers.index')->with('success', 'تم اضافة العميل بنجاح');
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->route('admin.customers.index')->with('warning', 'هناك خطأ ما حاول فيما بعد');
        }
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
        $customer = $this->customer->findOrFail($id);
        return view('admin.customers.edit', compact( 'customer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(CustomerRequest $request, $id)
    {
        try {
            $customer = $this->customer->findOrFail($id);
            $data = $request->except(['_token', '_method']);
            $data = array_merge($data, ['status' => $request->input('status',0)]);
            DB::beginTransaction();
            $customer->update($data);
            DB::commit();
            return redirect()->route('admin.customers.index')->with('success', 'تم تحديث العميل بنجاح');
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->route('admin.customers.index')->with('warning', 'هناك خطأ ما حاول فيما بعد');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer = $this->customer->findOrFail($id);
        $customer->delete();
        return redirect()->route('admin.customers.index')->with('success', 'تم حذف العميل بنجاح');
    }

}
