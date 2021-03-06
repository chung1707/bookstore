<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Order;
use App\Models\AppConst;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\Thumbnail;
use App\Events\BooksCreated;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Requests\Book\UpdateBookRequest;
use PhpOffice\PhpSpreadsheet\Writer\Ods\Thumbnails;

class BookController extends Controller
{

    public function getHeaderBooks()
    {
        $headerBooks = Book::orderBy('sold', 'desc')->with('thumbnails')->take(8)->get();
        return response()->json(['books' => $headerBooks]);
    }

    public function adminBookList(Request $request)
    {
        $books = Book::orderBy('id', 'desc')->paginate(AppConst::DEFAULT_PER_PAGE);
        $books->load('thumbnails');
        $totalBooks = Book::count('id');
        $bestSellingBook = Book::orderBy('sold', 'desc')->first();
        $totalSold = Book::sum('sold');
        $linkDelete = "/admin/book/";
        if(isset($request->tableSearch)){
            $search = $request->tableSearch;
            $books = Book::orderBy('id', 'desc')->where('name','like','%'.$search.'%')
            ->orWhere('book_code','like','%'.$search.'%')
            ->get();
            return view('books.list_book')
            ->with('books', $books)
            ->with('totalBooks', $totalBooks)
            ->with('bestSellingBook', $bestSellingBook)
            ->with('linkDelete', $linkDelete)
            ->with('search', $search)
            ->with('totalSold', $totalSold);
        }else{
            return view('books.list_book')
            ->with('books', $books)
            ->with('totalBooks', $totalBooks)
            ->with('bestSellingBook', $bestSellingBook)
            ->with('linkDelete', $linkDelete)
            ->with('totalSold', $totalSold);
        }

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $SupplierChecked=[];
        $CategoryChecked=[];
        $categories = Category::where('for_books', '=', true)->get();
        $suppliers = Supplier::all();
        $checked = 'checked';
        if(isset($request->SupplierSearch[0])&&isset($request->CategorySearch[0])){
            $books = Book::whereHas('categories', function (Builder $query) use ($request)  {
                $query->whereIn('category_id',$request->CategorySearch);
            })->whereIn('supplier_id',$request->SupplierSearch)->take(9)->get();
            $CategoryChecked=$request->CategorySearch;
            $SupplierChecked=$request->SupplierSearch;
        }else if(!isset($request->SupplierSearch[0])&&isset($request->CategorySearch[0])){
            $books = Book::whereHas('categories', function (Builder $query) use ($request)  {
                $query->whereIn('category_id',$request->CategorySearch);
            })->take(9)->get();
            $CategoryChecked=$request->CategorySearch;
        }else if(isset($request->SupplierSearch[0])&&!isset($request->CategorySearch[0])){
            $books = Book::whereIn('supplier_id',$request->SupplierSearch)->take(9)->get(); 
            $SupplierChecked=$request->SupplierSearch;
        }else{
            $books = Book::paginate(9); 
        }
            return view('client.products')
                ->with('books', $books)
                ->with('categories', $categories)
                ->with('SupplierChecked', $SupplierChecked)
                ->with('CategoryChecked', $CategoryChecked)
                ->with('checked', $checked)
                ->with('suppliers', $suppliers);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $books = $request->books;
            foreach ($books as $item) {
                $book = Book::where('book_code', '=', $item['book_code'])->first();
                if ($book) {
                    $book->quantity += $item['quantity'];
                    $book->update();
                } else {
                    $book = new Book;
                    $book->fill($item);
                    $book->save();
                    if ($item['thumbnails']) {
                        foreach ($item['thumbnails'] as $file) {
                            $thumbnails[] = [
                                'book_id' => $book->id,
                                'img' =>  $file,
                            ];
                        }
                        Thumbnail::insert($thumbnails);
                    }
                    foreach ($item['category_ids'] as $cate) {
                        $category = Category::find($cate);
                        $category->books()->attach($book);
                    }
                }
            }
            BooksCreated::dispatch($request->bill);
            return response()->json(['success' => true, 'status' => 201]);
        } catch (\Exception $e) {
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
        $bought = false;
        if (isset(auth()->user()->id)) {
            $orders = Order::where('user_id', auth()->user()->id)->with('books')->get();
            foreach ($orders as $order) {
                for ($i = 0; $i < count($order->books); $i++) {
                    if ($book->id == $order->books[$i]->id) {
                        $bought = true;
                        break;
                    }
                }
            }
        }
        $relatedCategories = $book->categories;
        $categoryIds = [];
        for ($i = 0; $i < count($relatedCategories); $i++) {
            $categoryIds[] = $relatedCategories[$i]->id;
        }
        $relatedBooks = Book::whereHas('categories', function (Builder $query) use ($categoryIds) {
            $query->whereIn('category_id', $categoryIds);
        })->where('id', '!=', $book->id)->take(8)->get();
        return view('client.product-details')
            ->with('relatedBooks', $relatedBooks)
            ->with('bought', $bought)
            ->with('book', $book);
    }
    public function adminShow(Book $book)
    {
        $linkDelete = "/comment/";
        $book->load('categories', 'thumbnails', 'supplier');
        $book->load('comments');
        return view('books.book_details')
        ->with('linkDelete', $linkDelete)
        ->with('book', $book);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        $book->load('thumbnails', 'categories');
        return view('books.edit_book')->with('book', $book);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBookRequest $request, Book $book)
    {
        // cap nhap thong tin sach
        $book->fill($request->all());
        $book->update();
        // cap nhap anh cho sach
        if (isset($request->newThumbnails[0])) {
            Thumbnail::where('book_id', $book->id)->delete();
            foreach (explode(',', $request->newThumbnails) as $file) {
                $thumbnails[] = [
                    'book_id' => $book->id,
                    'img' =>  $file,
                ];
            }
            Thumbnail::insert($thumbnails);
        }
        // cap nhap danh muc sach
        if (isset($request->category_ids)) {
            $book->categories()->detach();
            $book->categories()->attach($request->category_ids);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        try {
            $book->delete();
            return response()->json(['status' => 201, 'name' => $book->name]);
        } catch (\Exception $e) {
            return response()->json(['status' => 401, 'error' => $e]);
        }
    }
}
