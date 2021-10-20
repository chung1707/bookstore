<?php

namespace App\Http\Controllers\Warehouse;

use App\Models\Book;
use App\Models\AdminCart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminCartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('warehouse.sell_offline.admin_cart');
    }
    public function getCart()
    {
        $cart = auth()->user()->adminCart;
        $books = $cart->books()->with('thumbnails')->get();
        $bookTotals = $cart->books->sum('pivot.quantity');
        return response()->json(['books' => $books, 'bookTotals' => $bookTotals]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $extraQuantity = 1;
        $book = Book::find($request->book_id);
        $adminCart = auth()->user()->adminCart;
        $bookInCart = $adminCart->books()->where('book_id', '=', $book->id)->first();
        if (empty($bookInCart)) {
            $adminCart->books()->attach($book, ['quantity' => $extraQuantity]);
        } else {
            $quantity = $bookInCart->pivot->quantity;
            if($quantity+$extraQuantity > $bookInCart->quantity){
                $adminCart->books()->updateExistingPivot($book, [
                    'quantity' => $book->quantity,
                ]);
            }
            else{
                $adminCart->books()->updateExistingPivot($book, [
                    'quantity' => $quantity + $extraQuantity,
                ]);
            }
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AdminCart  $adminCart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $newQty = $request->newQuanty;
        $cart = auth()->user()->adminCart;
        $book = $cart->books()->where('book_id', '=', $request->book_id)->first();
        $cart->books()->updateExistingPivot($book, [
            'quantity' => $book->pivot->quantity + ($newQty - $book->pivot->quantity),
        ]);
        return response()->json(['qty' => $book->pivot->quantity]);
    }
    public function deleteBookInCart(Request $request)
    {
        $cart = auth()->user()->adminCart;
        $book = Book::find($request->book_id);
        $cart->books()->detach($book);
    }
    public function clearCart(){
        $cart = auth()->user()->adminCart;
        $cart->books()->detach();
    }
}
