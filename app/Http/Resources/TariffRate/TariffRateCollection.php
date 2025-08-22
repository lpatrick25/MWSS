<?php

namespace App\Http\Resources\TariffRate;

use App\Http\Resources\PaginatedResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\JsonResponse;

class TariffRateCollection extends PaginatedResource
{
    public function data($collection): AnonymousResourceCollection
    {
        return TariffRateResource::collection($collection);
    }

    public function toResponse($request): JsonResponse
    {
        return response()->json([
            'rows' => $this->data($this->collection),
            'pagination' => $this->pagination,
        ]);
    }
}
