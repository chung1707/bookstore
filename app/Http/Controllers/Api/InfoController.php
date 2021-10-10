<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use App\Models\Supplier;
use App\Models\Transporters;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InfoController extends Controller
{
    public function getSuppliers(){
        $suppliers = Supplier::all();
        return response()->json(['suppliers' => $suppliers]);
    }
    public function getSelectCategories(Request $request){
        $categoriesQuery = Category::query();
        if ($request->keyWord) {
            $categories = $categoriesQuery->where('name', 'like', '%' . $request->keyWord . '%');
        }
        $categories = $categoriesQuery->limit(10)->get();
        return response()->json($categories);
    }
    public function getInfoTransporter(){
        $transporters = Transporters::get();
        return response()->json(['transporters' => $transporters]);

    }
}
