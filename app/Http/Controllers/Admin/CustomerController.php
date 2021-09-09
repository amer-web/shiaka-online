<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

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
        $customers = $this->customer->whereRoleIs('customer')->get();
        return view('admin.customers.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers = $this->customer->get()->toTree();
        return view('admin.customers.create', compact('customers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(customerRequest $request)
    {
        try {
            $data = $request->data;
            DB::beginTransaction();
            foreach ($data as $code => $val) {
                $data[$code]['slug'] = Str::slug($val['name']);
            }
            $data['status'] = $request->input('status', 0);
            $data['position'] = $request->input('position');
            $customer = $this->customer->create($data);
            $parent = $this->customer->find($request->parent_id);
            $parent->appendNode($customer);
            $this->upload_image($customer);
            DB::commit();
            return redirect()->route('admin.customers.index')->with('success', 'تم اضافة القسم بنجاح');
        } catch (\Exception $ex) {
            return $ex;
            DB::rollback();
            return redirect()->route('admin.customers.index')->with('warning', 'هناك خطأ ما حاول فيما بعد');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $editcustomer = $this->customer->findOrFail($id);
        if (!$editcustomer->parent_id)
            return redirect()->route('admin.customers.index')->with('warning', 'لايمكن التعديل على هذا القسم');
        $customers = $this->customer->where('id', '!=', $id)->whereNotDescendantOf($id)->get()->toTree();
        return view('admin.customers.edit', compact('editcustomer', 'customers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(customerRequest $request, $id)
    {

        try {
            $customer = $this->customer->findOrFail($id);
            $data = $request->data;
            DB::beginTransaction();
            foreach ($data as $code => $val) {
                $data[$code]['slug'] = Str::slug($val['name']);
            }
            $data['status'] = $request->input('status', 0);
            $data['position'] = $request->input('position');
            $customer->update($data);
            $parent = $this->customer->find($request->parent_id);
            $parent->appendNode($customer);
            $this->upload_image($customer);
            DB::commit();
            return redirect()->route('admin.customers.index')->with('success', trans('admin.success', ['name' => trans('admin.customer')]));
        } catch (\Exception $ex) {
            return $ex;
            DB::rollback();
            return redirect()->route('admin.customers.index')->with('warning', 'هناك خطأ ما حاول فيما بعد');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function upload_image($customer)
    {
        if (request()->file()) {
            foreach ($customer->Filledimages as $name) {
                if ($customer->{$name}) {
                    $deleteImage = public_path($customer->{$name});
                    unlink($deleteImage);
                }
                $image = request()->file($name)->store('customers', 'images');
                $path = 'images/'  . $image;
                $customer->{$name} = $path;
                $customer->save();
            }
        }
    }
}
