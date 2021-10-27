<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Comment;
use App\Models\AppConst;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Book $book)
    {
        $comments = Comment::where('book_id', $book->id)->orderBy('id','desc')->paginate(AppConst::DEFAULT_PER_COMMENTS);
        $total = Comment::where('book_id', $book->id)->count('id');
        $comments->load('user');
        return response()->json(
            [
                'status' =>201,
                'comments' =>$comments,
                'total' =>$total,
            ]);
    }

    public function averageRating(Book $book){
        $total = Comment::where('book_id', $book->id)->count('id');
        $sum = Comment::where('book_id', $book->id)->sum('rating');
        $average  = $sum / $total;
        return response()->json(
            [
                'status' =>201,
                'average' =>$average,
                'total' =>$total,
            ]);
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
            $comment = new Comment;
            $comment->fill($request->all());
            $comment->user_id = auth()->user()->id;
            if($comment->content == null){
                $comment->content = 'Không để lại bình luận!';
            }
            $comment->save();
            return response()->json(['status' => 201]);
        }catch(\Exception $e){
            return response()->json(['status' => 401, 'e' =>$e]);
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        try{
            $comment->delete();
            return response()->json(['status' =>201]);
        }catch (\Exception $e) {
            return response()->json(['status' =>401]);
        }
    }
}
