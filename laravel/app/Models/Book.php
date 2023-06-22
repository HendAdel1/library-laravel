<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'image',
        'description',
        'author_id',
        'num_books'
    ];

    public function author()
    {
        return $this->belongsTo(Author::class);
    }
}
