<?php

namespace App\Http\Controllers;

use App\Http\Requests\Meter\StoreMeterRequest;
use App\Http\Requests\Meter\UpdateMeterRequest;
use App\Http\Resources\Meter\MeterResource;
use App\Http\Resources\Meter\MeterCollection;
use App\Models\Meter;
use App\Services\MeterServices;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MeterController extends Controller
{
    protected $meterService;

    public function __construct(MeterServices $meterService, Request $request)
    {
        parent::__construct($request);
        $this->meterService = $meterService;
    }

    public function index(Request $request): MeterCollection
    {
        $validated = $request->validate([
            'concessionaire_id' => 'nullable|exists:concessionaires,id',
            'status' => 'nullable|in:Active,Inactive',
            'limit' => 'nullable|integer|min:1',
            'page' => 'nullable|integer|min:1',
        ]);

        $query = $this->meterService->getAllMeters($validated);
        $meters = $query->paginate($this->limit, ['*'], 'page', $this->page);

        return new MeterCollection($meters);
    }

    public function show(Meter $meter): JsonResponse
    {
        $meter->load('concessionaire');
        return $this->success(new MeterResource($meter));
    }

    public function store(StoreMeterRequest $request): JsonResponse
    {
        $meter = $this->meterService->create($request->validated());
        $meter->load('concessionaire');
        return $this->success(new MeterResource($meter), 'Meter created', 201);
    }

    public function update(UpdateMeterRequest $request, Meter $meter): JsonResponse
    {
        $meter = $this->meterService->update($meter->id, $request->validated());
        $meter->load('concessionaire');
        return $this->success(new MeterResource($meter), 'Meter updated');
    }

    public function destroy(Meter $meter): JsonResponse
    {
        $meter->delete();
        return $this->success(null, 'Meter deleted');
    }
}
