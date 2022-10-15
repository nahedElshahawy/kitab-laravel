<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\book;

class orderbyController extends Controller
{
//    public function averrage(){


//    }


  public function order($type){

if($type=='update'){
    $books =book::orderBy('created_at')->get();
    return response($books);


}

elseif($type=='rate'){


    $books = book::leftJoin('rate_books','rate_books.book_id', '=', 'books.id')
    ->select('books.*')
   ->orderBy('rate_books.value','desc') ->get();
    
    return response($books);
}

else return 'not valid filter';
    
   }



public function filterby ($id){


$books=book::where('category_id',$id)->get();

return($books);
}


}