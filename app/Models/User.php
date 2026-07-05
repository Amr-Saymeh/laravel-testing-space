<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $fillable = ['name', 'email', 'role','borrowed_books', 'password'];
    protected $hidden = ['password', 'remember_token'];
    protected function casts(): array
    {        
        return [
            'name' => 'string',
            'email' => 'string',
            'role' => 'string',
            'borrowed_books' => 'json',
            'password' => 'hashed',
        ];
    }
    public function borrows()
    {
        return $this->hasMany(Borrow::class);
    }
}
