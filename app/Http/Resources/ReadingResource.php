<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReadingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'book_id' => $this['book_id'],
            'book_name' => $this['book_name'],
            'num_of_read_pages' => (int) $this['num_of_read_pages']
        ];
    }
}
