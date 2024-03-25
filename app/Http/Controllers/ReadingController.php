<?php

namespace App\Http\Controllers;

use App\Services\ReadingService;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\ReadingRequest;
use App\Http\Resources\ReadingResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ReadingController extends Controller
{
    public function index(ReadingService $readingService): AnonymousResourceCollection
    {
        return ReadingResource::collection($readingService->getMostFiveBooksReadPages());
    }

    /**
     * Store a new reading record.
     *
     * @param ReadingRequest $request
     * @param ReadingService $readingService
     * @return JsonResponse
     */
    public function store(ReadingRequest $request, ReadingService $readingService): JsonResponse
    {
        $readingService->store($request->validated());

        return response()->json(['message' => 'Created successfully.'], JsonResponse::HTTP_CREATED);
    }
}
