<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = ['title', 'author', 'available_quantity'];
    protected function casts(): array
    {        
        return [
            'title' => 'string',
            'author' => 'string',
            'available_quantity' => 'integer',
        ];
    }
    public function borrows()
    {
        return $this->hasMany(Borrow::class);
    }
}
