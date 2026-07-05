<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrow;
use App\Models\User;
use Illuminate\Http\Request;

class BorrowController extends Controller
{
    public function borrow_book(Request $request)
    {
        if(!Book::find($request->book_id)->available_quantity > 0) return response()->json(['message' => 'Book is out-of-stock.']);
        $borrow = Borrow::create([
            'book_id' => $request->book_id,
            'user_id' => $request->user_id,
            'borrow_date' => now(),
        ]);
        $book = Book::find($request->book_id);
        $user = User::find($request->user_id);
        $currentBooks = $user->borrowed_books ?? [];
        if (in_array($book->id, $currentBooks)) {
            return response()->json(['message' => 'User has already borrowed this book.'], 400);
        }
        $currentBooks[] = $book->id;
        $book -> update(['available_quantity' => $book->available_quantity - 1]);
        $user -> update(['borrowed_books' => $currentBooks]);
        return response()->json(['message' => 'Book borrowed.']);
    }
    public function return_book(Request $request){
        $book = Book::find($request->book_id);
        $user = User::find($request->user_id);
        $currentBooks = $user->borrowed_books ?? [];
        if(!in_array($book->id, $currentBooks)) return response()->json(['message' => 'User doesnt have this book.'],400);
        Borrow::where(['book_id' => $request->book_id, 'user_id' => $request->user_id])->delete();
        unset($currentBooks[array_search($book->id, $currentBooks)]);
        $currentBooks = array_values($currentBooks);
        $book -> update(['available_quantity' => $book->available_quantity + 1]);
        $user -> update(['borrowed_books' => $currentBooks]);
        return response()->json(['message' => 'Book returned.']);
    }
}
