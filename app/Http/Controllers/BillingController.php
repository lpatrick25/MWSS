<?php

namespace App\Http\Controllers;

use App\Http\Requests\Billing\StoreBillingRequest;
use App\Http\Requests\Billing\UpdateBillingRequest;
use App\Http\Resources\Billing\BillingResource;
use App\Http\Resources\Billing\BillingCollection;
use App\Models\Billing;
use App\Services\BillingServices;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BillingController extends Controller
{
    protected $billingService;

    public function __construct(BillingServices $billingService, Request $request)
    {
        parent::__construct($request);
        $this->billingService = $billingService;
    }

    public function index(Request $request): BillingCollection
    {
        $validated = $request->validate([
            'concessionaire_id' => 'nullable|exists:concessionaires,id',
            'meter_reading_id' => 'nullable|exists:meter_readings,id',
            'status' => 'nullable|in:Pending,Paid,Overdue',
            'limit' => 'nullable|integer|min:1',
            'page' => 'nullable|integer|min:1',
        ]);

        $query = $this->billingService->getAllBillings($validated);
        $billings = $query->paginate($this->limit, ['*'], 'page', $this->page);

        return new BillingCollection($billings);
    }

    public function show(Billing $billing): JsonResponse
    {
        $billing->load('concessionaire', 'meterReading');
        return $this->success(new BillingResource($billing));
    }

    public function store(StoreBillingRequest $request): JsonResponse
    {
        Log::info('Creating billing record', $request->validated());
        $billing = $this->billingService->create($request->validated());
        $billing->load('concessionaire', 'meterReading');
        return $this->success(new BillingResource($billing), 'Billing created', 201);
    }

    public function update(UpdateBillingRequest $request, Billing $billing): JsonResponse
    {
        $billing = $this->billingService->update($billing->id, $request->validated());
        $billing->load('concessionaire', 'meterReading');
        return $this->success(new BillingResource($billing), 'Billing updated');
    }

    public function destroy(Billing $billing): JsonResponse
    {
        $billing->delete();
        return $this->success(null, 'Billing deleted');
    }
}
