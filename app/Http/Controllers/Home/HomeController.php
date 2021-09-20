<?php

namespace App\Http\Controllers\Home;

use App\Models\Book;
use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $suppliers = Supplier::get();
        $trendCategories = Category::where('for_books', '=', true)->withCount('books')->orderBy('books_count','desc')->take(3)->get();
        $trendBooks = Book::orderBy('sold','desc')->take(10)->get();
        $newBooks = Book::orderBy('created_at','desc')->take(8)->get();
        $categories = Category::where('for_books', '=', true)->get();
        return view('client.home')
                ->with('trendBooks',$trendBooks)
                ->with('newBooks',$newBooks)
                ->with('suppliers',$suppliers)
                ->with('categories',$categories)
                ->with('trendCategories',$trendCategories);
    }
}
