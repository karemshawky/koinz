<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\User;
use Illuminate\Database\Seeder;

class BookUserSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $firstUser = User::factory()->create();
        $secondUser = User::factory()->create();
        $thirdUser = User::factory()->create();

        $firstBook = Book::factory()->create()->id;
        $secondBook  = Book::factory()->create()->id;

        $firstUser->books()->attach(['book_id' => $firstBook], ['start_page' => 10, 'end_page' => 30]);
        $secondUser->books()->attach(['book_id' => $firstBook], ['start_page' => 2, 'end_page' => 25]);
        $firstUser->books()->attach(['book_id' => $secondBook], ['start_page' => 40, 'end_page' => 50]);
        $thirdUser->books()->attach(['book_id' => $secondBook], ['start_page' => 1, 'end_page' => 10]);
    }
}
