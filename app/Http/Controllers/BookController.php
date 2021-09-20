<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;



class BookController extends Controller
{

    public function getHeaderBooks(){
        $headerBooks = Book::orderBy('sold','desc')->with('thumbnails')->take(8)->get();
        return response()->json(['books' => $headerBooks]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::paginate(9);
        $categories = Category::where('for_books', '=', true)->get();
        $suppliers = Supplier::all();
        return view('client.products')
                ->with('books',$books)
                ->with('categories',$categories)
                ->with('suppliers',$suppliers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        $relatedCategories = $book->categories;
        $categoryIds = [];
        for($i = 0; $i < count($relatedCategories); $i++){
            $categoryIds[] = $relatedCategories[$i]->id;
        }
        $relatedBooks = Book::whereHas('categories', function(Builder $query)use ($categoryIds){
                $query->whereIn('category_id',$categoryIds);
        })->where('id','!=',$book->id)->take(8)->get();
        return view('client.product-details')
                ->with('relatedBooks',$relatedBooks)
                ->with('book',$book);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        //
    }
}
