<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TariffRate;
use App\Models\Concessionaire;
use App\Models\Meter;
use App\Models\MeterReading;
use Illuminate\Http\Request;

class BillingController extends Controller
{
    public function getMeterDetails($meterNumber)
    {
        $meter = Meter::where('meter_number', $meterNumber)
            ->where('status', 'Active')
            ->first();

        if (!$meter) {
            return response()->json(['message' => 'Active meter not found'], 404);
        }

        $concessionaire = Concessionaire::where('id', $meter->concessionaire_id)
            ->where('status', 'Active')
            ->first();

        if (!$concessionaire) {
            return response()->json(['message' => 'Concessionaire not found'], 404);
        }

        $latestReading = MeterReading::where('meter_id', $meter->id)
            ->orderBy('reading_date', 'desc')
            ->first();

        return response()->json([
            'meter_number' => $meter->meter_number,
            'concessionaire_name' => trim("{$concessionaire->first_name} {$concessionaire->middle_name} {$concessionaire->last_name} {$concessionaire->extension_name}"),
            'account_number' => $concessionaire->account_number,
            'previous_reading' => $latestReading ? $latestReading->present_reading : 0,
        ], 200);
    }

    public function calculateAmountDue(Request $request)
    {
        $validated = $request->validate([
            'previous_reading' => 'required|integer|min:0',
            'present_reading' => 'required|integer|min:0|gte:previous_reading',
            'reading_date' => 'required|date_format:Y-m-d',
        ]);

        $consumption = $validated['present_reading'] - $validated['previous_reading'];

        $tariffs = TariffRate::where('effective_date', '<=', $validated['reading_date'])
            ->orderBy('effective_date', 'desc')
            ->orderBy('min_consumption')
            ->get();

        if ($tariffs->isEmpty()) {
            return response()->json([
                'amount_due' => 0,
                'consumption' => $consumption,
                'message' => 'No applicable tariff rates found for the given date.',
            ], 200);
        }

        $amountDue = 0;
        $remaining = $consumption;

        foreach ($tariffs as $rate) {
            if ($remaining <= 0) {
                break;
            }

            if ($consumption < $rate->min_consumption) {
                continue;
            }

            $blockMin = $rate->min_consumption;
            $blockMax = $rate->max_consumption ?? PHP_INT_MAX;

            if ($consumption >= $blockMin) {
                $blockUsage = min($remaining, $blockMax - $blockMin + 1);
                $blockUsage = max(0, min($blockUsage, $consumption - $blockMin + 1));

                $amountDue += $rate->flat_amount;

                if ($rate->rate_per_cubic_meter > 0) {
                    $amountDue += $blockUsage * $rate->rate_per_cubic_meter;
                }

                $remaining -= $blockUsage;
            }
        }

        if ($remaining > 0) {
            return response()->json([
                'amount_due' => 0,
                'consumption' => $consumption,
                'message' => 'Consumption exceeds available tariff blocks.',
            ], 422);
        }

        return response()->json([
            'consumption' => $consumption,
            'amount_due' => round($amountDue, 2),
            'message' => 'Amount due calculated successfully.',
        ], 200);
    }
}
