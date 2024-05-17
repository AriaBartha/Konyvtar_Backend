<?php

namespace App\Http\Controllers\API;

use App\Models\Book;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBookRequest;
use App\Models\Rental;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::all();
       return response()->json(["data" => $books]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookRequest $request)
    {
        $book = new Book($request->all());
        $book->save();
        return response()->json($book, 201);
    }

    public function rent(Request $request, string $id){
        $book = Book::find($id);
        if (is_null($book)){
            return response()-> json(["message" => "Book not found with id: $id"], 404);
        }
        $rentals = Rental::where([
            ["book_id", $id],
            ["start_date", "<=", date("Y-m-d")],
            ["end_date", ">", date("Y-m-d")],
        ])->get();

        if(!$rentals->isEmpty()){
            return response()->json(["message" => "The book is currently rented"], 409);
        }

        $rental = new Rental();
        $rental->book_id = $id;
        $rental->start_date = date("Y-m-d");
        $rental->end_date = date("Y-m-d", strtotime("+1 week"));
        $rental->save();

        return response()->json($rental, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
