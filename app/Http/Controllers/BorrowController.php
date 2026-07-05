<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrow;
use App\Models\User;
use Illuminate\Http\Request;

class BorrowController extends Controller
{
    public function store(Request $request)
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
}
