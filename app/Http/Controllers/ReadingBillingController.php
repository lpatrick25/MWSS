<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReadingBillingRequest;
use App\Http\Requests\UpdateReadingBillingRequest;
use App\Http\Resources\ReadingBillingCollection;
use App\Http\Resources\ReadingBillingResource;
use App\Models\MeterReading;
use App\Services\BillingServices;
use App\Services\MeterReadingServices;
use App\Services\ReadingBillingServices;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ReadingBillingController extends Controller
{
    protected $meterReadingService, $billingService, $readingBillingServices;

    public function __construct(MeterReadingServices $meterReadingService, BillingServices $billingService, ReadingBillingServices $readingBillingServices, Request $request)
    {
        parent::__construct($request);
        $this->meterReadingService = $meterReadingService;
        $this->billingService = $billingService;
        $this->readingBillingServices = $readingBillingServices;
    }

    public function index(Request $request): ReadingBillingCollection
    {
        $validated = $request->validate([
            'meter_id' => 'nullable|exists:meters,id',
            'reader_id' => 'nullable|exists:users,id',
            'limit' => 'nullable|integer|min:1',
            'page' => 'nullable|integer|min:1',
        ]);

        $query = $this->readingBillingServices->getAllMeterReadings($validated);
        $readingBillings = $query->paginate($this->limit, ['*'], 'page', $this->page);

        return new ReadingBillingCollection($readingBillings);
    }

    public function show(MeterReading $meterReading): JsonResponse
    {
        $meterReading->load('billing');
        return $this->success(new ReadingBillingResource($meterReading));
    }

    public function store(StoreReadingBillingRequest $request): JsonResponse
    {
        // Create the meter reading
        $meterReading = $this->meterReadingService->create($request->validated());
        Log::info('Meter Reading Created: ', ['meter_reading_id' => $meterReading->id, 'data' => $request->validated()]);

        // Merge meter_reading_id into validated data
        $validatedData = array_merge($request->validated(), ['meter_reading_id' => $meterReading->id]);

        // Create the billing record
        $this->billingService->create($validatedData);

        // Load relationships for the response
        $meterReading->load('meter', 'reader');

        return $this->success(new ReadingBillingResource($meterReading), 'Meter reading and billing created', 201);
    }

    public function update(UpdateReadingBillingRequest $request, MeterReading $meterReading): JsonResponse
    {
        $meterReading = $this->meterReadingService->update($meterReading->id, $request->validated());
        $this->billingService->update($meterReading->billing->id, $request->validated());
        $meterReading->load('meter', 'reader');
        return $this->success(new ReadingBillingResource($meterReading), 'Meter reading updated');
    }

    public function destroy(MeterReading $meterReading): JsonResponse
    {
        $meterReading->delete();
        return $this->success(null, 'Meter reading deleted');
    }
}
