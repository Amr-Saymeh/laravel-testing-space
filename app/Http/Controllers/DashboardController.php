<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\User;   
use App\Models\Borrow;

class DashboardController extends Controller
{
    public function index()
    {
        return response()->json([
            'books' => Book::count(),
            'users' => User::count(),
            'borrows' => Borrow::count()
        ]);
    }
}
