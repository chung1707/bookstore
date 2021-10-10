<?php

namespace App\Http\Controllers;

use App\Events\BooksCreated;
use App\Models\Book;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\Thumbnail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;



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
        try{
            $books = $request->books;
            foreach ($books as $item) {
                $book = Book::where('book_code', '=', $item['book_code'])->first();
                if($book){
                    $book->quantity += $item['quantity'];
                    $book->update();
                }else{
                    $book = new Book;
                    $book->fill($item);
                    $book->save();
                    if($item['thumbnails']){
                        foreach($item['thumbnails'] as $file)
                        {
                            $thumbnails[]= [
                                'book_id' => $book->id,
                                'img'=>  $file,
                            ];
                        }
                        Thumbnail::insert($thumbnails);
                    }
                }
            }
            BooksCreated::dispatch($request->bill);
            return response()->json(['success' => true, 'status' => 201]);
        }catch(\Exception $e){
            return response()->json(['e' => $e, 'status' => 401]);
        }
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
