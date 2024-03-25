<?php

namespace App\Services;

use App\Models\Book;
use App\Http\Requests\ReadingRequest;
use App\Notifications\SMS\ThankYou;

class ReadingService
{
    /**
     * Store a new reading record.
     *
     * @param ReadingRequest $request
     * @return void
     */
    public function store(array $data): void
    {
        auth()->user()->books()->attach($data['book_id'], ['start_page' => $data['start_page'], 'end_page' => $data['end_page']]);

        auth()->user()->notify(new ThankYou());
    }

    /**
     * Retrieves the most five books and their read pages.
     *
     * @return array
     */
    public function getMostFiveBooksReadPages(): array
    {
        // 1- get array group by book id
        // 2- get read pages number from start_page to end_page in array
        // 3- get unique numbers of pages and remove duplicated numbers
        // 4- merge range of numbers and sum all the total number of read page

        // get array group by book id
        $books = Book::getReadBooks();

        $result = [];

        foreach ($books as $bookId => $pages) {
            $numOfReadPages = [];

            foreach ($pages as $page) {
                $range = range($page['start_page'], $page['end_page']);
                $numOfReadPages[$page['name']] = array_merge($numOfReadPages[$page['name']] ?? [], $range);
            }

            foreach ($numOfReadPages as &$numbers) {
                sort($numbers);
                $numbers = array_unique($numbers);
            }

            foreach ($numOfReadPages as $bookName => $readPages) {
                $result[] = [
                    'book_id' => $bookId,
                    'num_of_read_pages' => count($readPages),
                    'book_name' => $bookName
                ];
            }
        }

        return $result;
    }
}
