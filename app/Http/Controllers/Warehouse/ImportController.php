<?php

namespace App\Http\Controllers\Warehouse;

use App\Models\AppConst;
use App\Models\ImportBills;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ImportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
<<<<<<< HEAD
        if(isset($request->tableSearch)){
            $search = $request->tableSearch;
            $importBills = ImportBills::orderBy('id','desc')->where('transaction_id','like','%'.$search.'%')->get();
            return view('warehouse.import_history')->with('importBills', $importBills)->with('search', $search);
        }else{
            $importBills = ImportBills::orderBy('id','desc')->paginate(AppConst::DEFAULT_PER_PAGE);
            return view('warehouse.import_history')->with('importBills', $importBills);
        }

=======
        $linkDelete = '/admin/importBill/';
        $importBills = ImportBills::orderBy('id','desc')->paginate(AppConst::DEFAULT_PER_PAGE);
        return view('warehouse.import_history')
        ->with('linkDelete', $linkDelete)
        ->with('importBills', $importBills);
>>>>>>> df4ed080677125dc671635879ddc727c146b93de
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('warehouse.create_import');
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ImportBills  $importBills
     * @return \Illuminate\Http\Response
     */
    public function show(ImportBills $importBill)
    {
        $importBill->load('user','supplier','books');
        return view('warehouse.import_bill_details')->with('importBill', $importBill);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ImportBills  $importBills
     * @return \Illuminate\Http\Response
     */
    public function edit(ImportBills $importBills)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ImportBills  $importBills
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ImportBills $importBills)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ImportBills  $importBills
     * @return \Illuminate\Http\Response
     */
    public function destroy( Request  $request)
    {
        try{
            ImportBills::find($request->item_id)->delete();
            return response()->json(['status' => 201, 'name' => 'hóa đơn nhập']);
        }catch(\Exception $e){
            return response()->json(['status' => 401, 'error' =>$e]);
        }
    }
}
