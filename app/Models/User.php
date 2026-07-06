<?php

namespace App\Models;


use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasApiTokens,Notifiable;

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
