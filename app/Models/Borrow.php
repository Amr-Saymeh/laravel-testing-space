<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Borrow extends Model
{
    protected $fillable = ['user_id', 'book_id',  'borrow_date', 'return_date',];
    protected function casts(): array
    {        
        return [
            'user_id' => 'integer',
            'book_id' => 'integer',
            'borrow_date' => 'datetime',
            'return_date' => 'datetime',
        ];
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
