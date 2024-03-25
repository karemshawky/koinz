<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Book;
use App\Models\User;
use App\Notifications\SMS\ThankYou;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Notification;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReadingTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    public function test_list_most_read_five_books(): void
    {
        $this->getJson(route('api.read.list-most-read'))
            ->assertOk()
            ->assertJsonStructure(
                [
                    'data' => [
                        '*' => [
                            'book_id',
                            'book_name',
                            'num_of_read_pages'
                        ],
                    ],
                ]
            );
    }

    /** @test */
    public function test_required_fields_for_submit_read_book_pages()
    {
        $this->actingAs(User::factory()->create())
            ->postJson(route('api.read.store'))
            ->assertUnprocessable()
            ->assertJsonValidationErrors(
                [
                    'book_id' => ['The book id field is required.'],
                    'start_page' => ['The start page field is required.'],
                    'end_page' => ['The end page field is required.']
                ]
            );
    }

    /** @test */
    public function test_submit_read_book_pages_successfully()
    {
        Notification::fake();
        $user = User::factory()->create();

        $pages = [
            'book_id' => Book::factory()->create()->id,
            'start_page' => fake()->numberBetween(1, 50),
            'end_page' => fake()->numberBetween(51, 99)
        ];

        $response = $this->actingAs($user)
            ->postJson(route('api.read.store'), $pages)
            ->assertCreated();

        Notification::assertSentTo(
            [$user],
            ThankYou::class
        );

        $response->assertJsonStructure(['message']);

        $this->assertDatabaseHas('book_user', ['book_id' => $pages['book_id'], 'start_page' => $pages['start_page']]);
    }
}
