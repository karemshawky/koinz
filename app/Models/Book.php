<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Book extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * The users that belong to the Book
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot(['start_page', 'end_page'])->withTimestamps();
    }

    /**
     * Get the list of read books with specific details.
     *
     * @return Collection
     */
    public static function getReadBooks(): Collection
    {
        return self::select('books.id', 'books.name', 'book_user.start_page', 'book_user.end_page', 'book_user.book_id')
            ->join('book_user', 'books.id', '=', 'book_user.book_id')
            ->get()
            ->groupBy('book_id');
    }
}
