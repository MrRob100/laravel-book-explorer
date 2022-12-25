<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BookCSV extends Model
{
    use HasFactory;

    protected $table = 'book_csvs';

    protected $fillable = [
        'user_id',
        'book_title',
        'book_author',
        'date_published',
        'unique_identifier',
        'publisher_name',
        'file_name',
    ];

    public function getURLAttribute(): string
    {
        return env('AWS_BUCKET_ENDPOINT') . $this->file_name;
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
