<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class categoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $c =category::get();
        return response($c);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:2|max:50|unique:categorys',

        ]);
        if ($validator->fails()) {
            return response( $validator->errors())->setStatusCode(400);
            ;
        }else{

       $category= category::create(
           $request->all(),
        );
            return response($category);
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
        $category= category::find($id);
        if ($category){
            return response ($category);
        }else{
            return response("category not found");
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
        $category= category::find($id);
        if(!$category){
            return response( "category not found")->setStatusCode(400);
        }else{
            $category->delete($id);
            return response( "category deleted successfully")->setStatusCode(200);

        }

    }
}
