<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\book;
use Illuminate\Http\Request;
use App\Http\Resources\bookResource;
use Illuminate\Support\Facades\Validator;

class bookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books =book::get();
        return response($books);
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

        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|max:50|unique:books',
            'description' => 'required',
        ]);
        if ($validator->fails()) {
            return response( $validator->errors())->setStatusCode(400);
            ;
        }else{

       $book= book::create(
           $request->all(),
        );
            return new bookResource($book);
    }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $books= book::find($id);
        if ($books){
            return new bookResource($books);
        }else{
            return response("post not found");
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|max:50|unique:books',
            'description' => 'required',
        ]);
        if ($validator->fails()) {
            return response( $validator->errors())->setStatusCode(400);
            ;
        }else{

        $books= book::find($id);
        $books->update([
            'name' => $request->name,
            'description' => $request->description,
            ]
        );
         return new bookResource($books);
    }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book= book::findorfail($id);
        if(!$book){
            return response( "post not found")->setStatusCode(400);
        }else{
            $book->delete($id);
            return response( "post deleted successfully")->setStatusCode(200);

        }
    }
}
