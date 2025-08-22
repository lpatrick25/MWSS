<?php

namespace App\Http\Controllers;

use App\Http\Requests\MeterReading\StoreMeterReadingRequest;
use App\Http\Requests\MeterReading\UpdateMeterReadingRequest;
use App\Http\Resources\MeterReading\MeterReadingResource;
use App\Http\Resources\MeterReading\MeterReadingCollection;
use App\Models\MeterReading;
use App\Services\MeterReadingServices;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MeterReadingController extends Controller
{
    protected $meterReadingService;

    public function __construct(MeterReadingServices $meterReadingService, Request $request)
    {
        parent::__construct($request);
        $this->meterReadingService = $meterReadingService;
    }

    public function index(Request $request): MeterReadingCollection
    {
        $validated = $request->validate([
            'meter_id' => 'nullable|exists:meters,id',
            'reader_id' => 'nullable|exists:users,id',
            'limit' => 'nullable|integer|min:1',
            'page' => 'nullable|integer|min:1',
        ]);

        $query = $this->meterReadingService->getAllMeterReadings($validated);
        $meterReadings = $query->paginate($this->limit, ['*'], 'page', $this->page);

        return new MeterReadingCollection($meterReadings);
    }

    public function show(MeterReading $meterReading): JsonResponse
    {
        $meterReading->load('meter', 'reader');
        return $this->success(new MeterReadingResource($meterReading));
    }

    public function store(StoreMeterReadingRequest $request): JsonResponse
    {
        $meterReading = $this->meterReadingService->create($request->validated());
        $meterReading->load('meter', 'reader');
        return $this->success(new MeterReadingResource($meterReading), 'Meter reading created', 201);
    }

    public function update(UpdateMeterReadingRequest $request, MeterReading $meterReading): JsonResponse
    {
        $meterReading = $this->meterReadingService->update($meterReading->id, $request->validated());
        $meterReading->load('meter', 'reader');
        return $this->success(new MeterReadingResource($meterReading), 'Meter reading updated');
    }

    public function destroy(MeterReading $meterReading): JsonResponse
    {
        $meterReading->delete();
        return $this->success(null, 'Meter reading deleted');
    }
}
