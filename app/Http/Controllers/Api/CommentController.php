<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\commentResource;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Schema;
class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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

       $validator = Validator::make($request->all(),[
             'comment_text' => ['required','min:11'
    //
             ]
        ]);

         if($validator->fails()){
             return response()->json($validator->errors());
         }

        $comment=Comment::create([
            'comment_text' => $request->comment_text,
            'user_id' => Auth::id(),
            'book_id' => $request->book_id
         ]);

        return response()->json(['comment added successfully.', new commentResource($comment)]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $comment =Comment::join('users', 'users.id', '=', 'comments.user_id')
        ->select('users.name', 'comments.comment_text','comments.id','comments.created_at','comments.user_id')->where('comments.book_id',$id)
        ->get();



        if (is_null($comment)) {
            return response()->json('Data not found', 404);
        }



       return response()->json(commentResource::collection($comment));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {

        $validator = Validator::make($request->all(),[
            'comment_text' => ['required','min:5'

            ]
       ]);

        if($validator->fails()){
            return response()->json($validator->errors());
        }

       $comment->update([
           'comment_text' => $request->comment_text
        ]);

       return response()->json(['comment added successfully.', new commentResource($comment)]);









    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {


            $comment->delete();
            return 'deleted done';

    }
}
