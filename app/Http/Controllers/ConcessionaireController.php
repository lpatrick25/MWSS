<?php

namespace App\Http\Controllers;

use App\Http\Requests\Concessionaire\StoreConcessionaireRequest;
use App\Http\Requests\Concessionaire\UpdateConcessionaireRequest;
use App\Http\Resources\Concessionaire\ConcessionaireResource;
use App\Http\Resources\Concessionaire\ConcessionaireCollection;
use App\Models\Concessionaire;
use App\Services\ConcessionaireServices;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ConcessionaireController extends Controller
{
    protected $concessionaireService;

    public function __construct(ConcessionaireServices $concessionaireService, Request $request)
    {
        parent::__construct($request);
        $this->concessionaireService = $concessionaireService;
    }

    public function index(Request $request): ConcessionaireCollection
    {
        $validated = $request->validate([
            'status' => 'nullable|in:Active,Inactive',
            'limit' => 'nullable|integer|min:1',
            'page' => 'nullable|integer|min:1',
        ]);

        $query = $this->concessionaireService->getAllConcessionaires($validated);
        $concessionaires = $query->paginate($this->limit, ['*'], 'page', $this->page);

        return new ConcessionaireCollection($concessionaires);
    }

    public function show(Concessionaire $concessionaire): JsonResponse
    {
        return $this->success(new ConcessionaireResource($concessionaire));
    }

    public function store(StoreConcessionaireRequest $request): JsonResponse
    {
        $concessionaire = $this->concessionaireService->create($request->validated());
        return $this->success(new ConcessionaireResource($concessionaire), 'Concessionaire created', 201);
    }

    public function update(UpdateConcessionaireRequest $request, Concessionaire $concessionaire): JsonResponse
    {
        $concessionaire = $this->concessionaireService->update($concessionaire->id, $request->validated());
        return $this->success(new ConcessionaireResource($concessionaire), 'Concessionaire updated');
    }

    public function destroy(Concessionaire $concessionaire): JsonResponse
    {
        $concessionaire->delete();
        return $this->success(null, 'Concessionaire deleted');
    }

    public function changeStatus(Concessionaire $concessionaire)
    {
        $concessionaire = $this->concessionaireService->changeStatus($concessionaire->id);
        return $this->success(new ConcessionaireResource($concessionaire), 'Concessionaire status updated');
    }
}
