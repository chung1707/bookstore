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
    public function index()
    {
        $importBills = ImportBills::orderBy('id','desc')->paginate(AppConst::DEFAULT_PER_PAGE);
        return view('warehouse.import_history')->with('importBills', $importBills);
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
    public function destroy(ImportBills $importBills)
    {
        //
    }
}
