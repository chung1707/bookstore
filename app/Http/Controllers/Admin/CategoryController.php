<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Http\Requests\UpdateCategoryRequest ;



class CategoryController extends Controller
{

    public function getHotCategories(){
        $categories = Category::where('for_books', '=', true)->with('books')->withCount('books')->orderBy('books_count','desc')->take(10)->get();
        $fisrtIncategories = Category::find($categories[0]->id);
        $book = $fisrtIncategories->books[0];
        $book->load('thumbnails');
        return response()->json(['categories' => $categories, 'book' => $book]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(isset($request->searchName)){
            $name=$request->searchName;
            $categories =  Category::where('name','like','%'.$name.'%')->where('for_books', '=', true)->get();
            return view('admin.categoryManagement.listDMS')->with('categories',$categories)->with('oldsearch',$name);
        }else{
            $categories = Category::paginate(9);
            $categories = Category::where('for_books', '=', true)->get();
            return view('admin.categoryManagement.listDMS')->with('categories',$categories);
        }

    }
    public function listdmbv(Request $request){
        if(isset($request->searchName)){
            $name=$request->searchName;
            $categories =  Category::where('name','like','%'.$name.'%')->where('for_books', '=', false)->get();
            return view('admin.categoryManagement.listDMBV')->with('categories',$categories)->with('oldsearch',$name);
        }else{
            $categories = Category::paginate(9);
            $categories = Category::where('for_books', '=', false)->get();
            return view('admin.categoryManagement.listDMBV')->with('categories',$categories);
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categoryManagement.create_category');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //dd($request);
        $validated = $request->validate([
            'name' => 'required|unique:categories|max:255',
            'description' => 'required|max:1000',

        ]);
        $category = new Category;
        $category->name = $request->name;
        $category->description = $request->description;
        $category->for_books = $request->for_books;
        $category->save();
        return redirect()->route('category.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
        return view('admin.categoryManagement.show_category')->with('category',$category);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('admin.categoryManagement.edit_categorry')->with('category',$category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        //
        // $category->fill($request->all());
        // $category->update();
        // return redirect()->route('category.index');
        dd('$request');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->back();
    }
    public function updateDM(UpdateCategoryRequest $request, Category $category)
    {
         $category->fill($request->all());
        $category->update();
        return redirect()->route('category.index');
    // dd('$request');
    }
}
