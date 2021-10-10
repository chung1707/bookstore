<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateSupplierRequest;
use App\Models\Supplier;
use Illuminate\Support\Facades\DB;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
            if(isset($request->searchName)){
                $name=$request->searchName;
                $suppliers =  Supplier::where('name','like','%'.$name.'%')->get();
                return view('admin.supplierManagement.list_supplier')->with('suppliers',$suppliers)->with('oldsearch',$name);
            }else{
                $suppliers = Supplier::paginate(5)->fragment('suppliers');
                return view('admin.supplierManagement.list_supplier')->with('suppliers',$suppliers);
            }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.supplierManagement.create_supplier');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validated = $request->validate([
            'name' => 'required|unique:suppliers|max:255',
            'address' => 'required|unique:suppliers|max:255',
            'email' => 'required|unique:suppliers|max:255',
            'phone' => 'numeric|unique:suppliers',
            'supplier_fax' => 'numeric|unique:suppliers',
        ]);
        $supplier = new Supplier;
        $supplier->name = $request->name;
        $supplier->address = $request->address;
        $supplier->phone = $request->phone;
        $supplier->email = $request->email;
        $supplier->supplier_fax = $request->supplier_fax;
        $supplier->logo = $request->thumbnails[0];
        $supplier->save();
        return redirect()->route('admin.listSupplier');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show(Supplier $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit(Supplier $supplier)
    {
        //
        return view('admin.supplierManagement.edit_supplier')->with('supplier',$supplier);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSupplierRequest $request, Supplier $supplier)
    {
        //
        $supplier->fill($request->all());
        if(isset( $request->thumbnails[0])){
            $supplier->logo = $request->thumbnails[0];
        }
        $supplier->update();
        return redirect()->route('admin.listSupplier');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supplier $supplier)
    {
        //
        $supplier->delete();
        return redirect()->back();
    }

}
