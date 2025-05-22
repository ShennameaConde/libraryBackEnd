<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BorrowTransaction extends Model
{
     use HasApiTokens, HasFactory, Notifiable;


    protected $fillable = [
        'user_id',
        'book_id',
        'type',     // e.g., 'borrow' or 'return'
        'date'
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}

