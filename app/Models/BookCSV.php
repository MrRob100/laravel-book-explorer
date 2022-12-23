<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookCSV extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'author',
        'date_published',
        'unique_identifier',
        'publisher',
        'file_url',
    ];
}
