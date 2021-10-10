<?php

namespace App\Http\Controllers\User;

use App\Models\Book;
use App\Models\Cart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CartController extends Controller
{
    public function index()
    {
        return view('client.cart');
    }
    public function getCart()
    {
        $cart = auth()->user()->cart;
        $books = $cart->books()->with('thumbnails')->get();
        $bookTotals = $cart->books->sum('pivot.quantity');
        return response()->json(['books' => $books, 'bookTotals' => $bookTotals]);
    }
    public function store(Request $request)
    {
        if ($request->quantity) {
            $quantitiDetails = $request->quantity;
        } else {
            $quantitiDetails = 1;
        }
        $book = Book::find($request->book_id);
        $cart = auth()->user()->cart;
        $bookInCart = $cart->books()->where('book_id', '=', $book->id)->first();
        if (empty($bookInCart)) {
            $cart->books()->attach($book, ['quantity' => $quantitiDetails]);
        } else {
            $quantity = $bookInCart->pivot->quantity;
            if($quantity+$quantitiDetails > $bookInCart->quantity){
                $cart->books()->updateExistingPivot($book, [
                    'quantity' => $book->quantity,
                ]);
            }
            else{
                $cart->books()->updateExistingPivot($book, [
                    'quantity' => $quantity + $quantitiDetails,
                ]);
            }
        }
    }
    public function deleteBookInCart(Request $request)
    {
        $cart = auth()->user()->cart;
        $book = Book::find($request->book_id);
        $cart->books()->detach($book);
    }
    public function updateQty(Request $request)
    {
        $newQty = $request->newQuanty;
        $cart = auth()->user()->cart;
        $book = $cart->books()->where('book_id', '=', $request->book_id)->first();
        $cart->books()->updateExistingPivot($book, [
            'quantity' => $book->pivot->quantity + ($newQty - $book->pivot->quantity),
        ]);
        return response()->json(['qty' => $book->pivot->quantity]);
    }
    public function clearCart(){
        $cart = auth()->user()->cart;
        $cart->books()->detach();
    }
}
