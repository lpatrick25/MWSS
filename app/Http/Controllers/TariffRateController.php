<?php

namespace App\Http\Controllers;

use App\Http\Requests\TariffRate\StoreTariffRateRequest;
use App\Http\Requests\TariffRate\UpdateTariffRateRequest;
use App\Http\Resources\TariffRate\TariffRateResource;
use App\Http\Resources\TariffRate\TariffRateCollection;
use App\Models\TariffRate;
use App\Services\TariffRateServices;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TariffRateController extends Controller
{
    protected $tariffRateService;

    public function __construct(TariffRateServices $tariffRateService, Request $request)
    {
        parent::__construct($request);
        $this->tariffRateService = $tariffRateService;
    }

    public function index(Request $request): TariffRateCollection
    {
        $validated = $request->validate([
            'effective_date' => 'nullable|date',
            'limit' => 'nullable|integer|min:1',
            'page' => 'nullable|integer|min:1',
        ]);

        $query = $this->tariffRateService->getAllTariffRates($validated);
        $tariffRates = $query->paginate($this->limit, ['*'], 'page', $this->page);

        return new TariffRateCollection($tariffRates);
    }

    public function show(TariffRate $tariffRate): JsonResponse
    {
        return $this->success(new TariffRateResource($tariffRate));
    }

    public function store(StoreTariffRateRequest $request): JsonResponse
    {
        $tariffRate = $this->tariffRateService->create($request->validated());
        return $this->success(new TariffRateResource($tariffRate), 'Tariff rate created', 201);
    }

    public function update(UpdateTariffRateRequest $request, TariffRate $tariffRate): JsonResponse
    {
        $tariffRate = $this->tariffRateService->update($tariffRate->id, $request->validated());
        return $this->success(new TariffRateResource($tariffRate), 'Tariff rate updated');
    }

    public function destroy(TariffRate $tariffRate): JsonResponse
    {
        $tariffRate->delete();
        return $this->success(null, 'Tariff rate deleted');
    }
}
