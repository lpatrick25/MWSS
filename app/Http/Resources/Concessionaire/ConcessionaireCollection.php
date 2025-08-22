<?php

namespace App\Http\Resources\Concessionaire;

use App\Http\Resources\PaginatedResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\JsonResponse;

class ConcessionaireCollection extends PaginatedResource
{
    public function data($collection): AnonymousResourceCollection
    {
        return ConcessionaireResource::collection($collection);
    }

    public function toResponse($request): JsonResponse
    {
        return response()->json([
            'rows' => $this->data($this->collection),
            'pagination' => $this->pagination,
        ]);
    }
}
