<?php

namespace App\Http\Controllers\Warehouse;

use Exception;
use App\Models\Book;
use App\Models\AppConst;
use App\Models\SaleBill;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Events\SaleBillCreated;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateSaleBillRequest;

class ExportController extends Controller
{
    public function createExportBill(CreateSaleBillRequest $request){
        try{
            //lap hoa don
            $bill = new SaleBill;
            $bill->user_id = auth()->user()->id;
            $bill->transaction_id = Str::random(AppConst::TRANSACTION_CODE);
            $bill->name = $request->name;
            $bill->phone = $request->phone;
            $bill->totalPrice = $request->bill['totalPrice'];
            $bill->discount_code_id	 = $request->bill['discount_code_id'];
            $bill->save();
            // gan sach vao hoa don va cap nhap so luong sach con lai
            $books = $request->bill['books'];
            foreach($books as $item){
                // $item->saleBills()->attach(json_encode($bill),['quantity' => $item['pivot']['quantity'], 'price' => $item['price']]);
                $book = Book::find($item['id']);
                $bill->books()->attach($book,['quantity' => $item['pivot']['quantity'], 'price' => $item['price']]);
                $book->quantity -= $item['pivot']['quantity'];
                $book->sold += $item['pivot']['quantity'];
                $book->save();
            }
            return response()->json(['status' => 201, 'bill_id' => $bill->id]);
        }catch(Exception $e){
            return response()->json(['e' => $e,'status' => 401, 'success' => false]);
        }
    }
    public function history(){
        $saleBills = SaleBill::orderBy('id','desc')->paginate(AppConst::DEFAULT_PER_PAGE);
        return view('warehouse.sell_offline.sale_bill_history')->with('saleBills',$saleBills);
    }
    public function deleteBill(Request $request){
        SaleBill::find($request->bill)->delete();
        return redirect()->back();
    }
    public function show(SaleBill $bill){
        $bill->load('user','books');
        return view('Warehouse.sell_offline.bill_details')->with('bill',$bill);
    }
}
