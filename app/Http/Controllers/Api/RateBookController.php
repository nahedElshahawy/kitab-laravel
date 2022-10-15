<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\RateBookRequest;
use App\Http\Resources\RateBookResource;
use App\Models\book;
use App\Models\RateBook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RateBookController extends Controller
{

    public function index()
    {
        return  RateBookResource::collection(RateBook::all());
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
        $rataBook = RateBook::where('user_id', auth()->id())->whereBookId($request->book_id)->first();

        if (!$rataBook) {
            $data = RateBook::create([
                'user_id' => auth()->id(),
                'book_id' => $request->book_id,
                'value' => $request->value,
            ]);

            $book = book::findorFail($request->book_id);
            if ($book) {
                $all_book_rates = 0;
                foreach ($book->rateBook as $rate) {
                    $all_book_rates += $rate->value;
                }
                $book->value = $all_book_rates / count($book->rateBook);
                $book->save();
            }
            return new RateBookResource($data);

        } else {
            return response('The User Rating book already', 400);
        }



        // $data = Auth::user()->rateBook()->create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return (new RateBookResource(RateBook::findorfail($id)))->response()->setStatusCode(201);
    }


    public function edit($id)
    {
        //
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
        $data = RateBook::findorfail($id);
        $data->update([
            'user_id' => auth()->id(),
            'book_id' => $request->book_id,
            'value' => $request->value,
        ]);
        return new RateBookResource($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = RateBook::findorfail($id);
        $data->delete();
        return response('Data Deleted Successfully', 200);
    }
}
