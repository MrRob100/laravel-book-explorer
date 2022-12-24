<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookCSV extends Model
{
    use HasFactory;

    protected $table = 'book_csvs';

    protected $fillable = [
        'book_title',
        'book_author',
        'date_published',
        'unique_identifier',
        'publisher_name',
        'file_name',
    ];
}
