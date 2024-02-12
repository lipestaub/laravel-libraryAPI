<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, mixed>
     */
    protected $fillable = [
        'title',
        'genre_id',
        'author',
        'number_of_pages',
        'release_date'
    ];

    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }
}
