<?php

namespace App\Http\Controllers;

use App\Models\Concessionaire;
use App\Models\Meter;
use App\Models\TariffRate;
use Illuminate\Http\Request;
use App\Models\Billing;
use App\Models\Payment;
use App\Models\MeterReading;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Summary Card Metrics
        $totalConcessionaires = Concessionaire::count();
        $activeMeters = Meter::where('status', 'Active')->count();
        $totalBillings = Billing::sum('amount_due');
        $overdueBills = Billing::where('status', 'Overdue')->count();

        // Growth/Change Percentages (example: comparing with last month)
        $lastMonthStart = Carbon::now()->subMonth()->startOfMonth();
        $lastMonthEnd = Carbon::now()->subMonth()->endOfMonth();

        $lastMonthConcessionaires = Concessionaire::whereBetween('created_at', [$lastMonthStart, $lastMonthEnd])->count();
        $concessionaireGrowth = $lastMonthConcessionaires > 0
            ? round((($totalConcessionaires - $lastMonthConcessionaires) / $lastMonthConcessionaires) * 100, 2)
            : 0;

        $lastMonthMeters = Meter::whereBetween('created_at', [$lastMonthStart, $lastMonthEnd])
            ->where('status', 'Active')->count();
        $meterGrowth = $lastMonthMeters > 0
            ? round((($activeMeters - $lastMonthMeters) / $lastMonthMeters) * 100, 2)
            : 0;

        $lastMonthBillings = Billing::whereBetween('created_at', [$lastMonthStart, $lastMonthEnd])->sum('amount_due');
        $billingChange = $lastMonthBillings > 0
            ? round((($totalBillings - $lastMonthBillings) / $lastMonthBillings) * 100, 2)
            : 0;

        $lastMonthOverdue = Billing::whereBetween('created_at', [$lastMonthStart, $lastMonthEnd])
            ->where('status', 'Overdue')->count();
        $overdueChange = $lastMonthOverdue > 0
            ? round((($overdueBills - $lastMonthOverdue) / $lastMonthOverdue) * 100, 2)
            : 0;

        // Monthly Consumption Trend (last 6 months)
        $monthlyConsumption = MeterReading::selectRaw('DATE_FORMAT(reading_date, "%Y-%m") as month, SUM(consumption) as total_consumption')
            ->where('reading_date', '>=', Carbon::now()->subMonths(6))
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // Payment Status Distribution
        $paymentStatus = [
            'paid' => Billing::where('status', 'Paid')->count(),
            'pending' => Billing::where('status', 'Pending')->count(),
            'overdue' => Billing::where('status', 'Overdue')->count(),
        ];

        // Recent Payments (last 5)
        $recentPayments = Payment::with(['bill.concessionaire', 'collectedBy'])
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalConcessionaires',
            'activeMeters',
            'totalBillings',
            'overdueBills',
            'concessionaireGrowth',
            'meterGrowth',
            'billingChange',
            'overdueChange',
            'monthlyConsumption',
            'paymentStatus',
            'recentPayments'
        ));
    }

    public function userList()
    {
        return view('admin.user_list');
    }

    public function userManagement()
    {
        return view('admin.user_management');
    }

    public function tariffRates()
    {
        return view('admin.tariff_rates');
    }

    public function concessionaireList()
    {
        return view('admin.concessionaire');
    }

    public function concessionaireMeter()
    {
        $concessionaires = Concessionaire::all();
        return view('admin.concessionaire_meter', compact('concessionaires'));
    }

    public function concessionaireMeterBill()
    {
        $concessionaires = Concessionaire::all();
        return view('admin.concessionaire_meter_bill', compact('concessionaires'));
    }

    public function concessionaireMeters($id)
    {
        $meters = Meter::where('concessionaire_id', $id)->get();

        return response()->json($meters);
    }

    public function concessionaireMeterReading($id)
    {
        $meter = Meter::findOrFail($id)->load('concessionaire', 'meterReadings');

        // Get last reading if exists, else use initial
        $previousReading = $meter->meterReadings()->latest('reading_date')->first();
        $previous = $previousReading ? $previousReading->present_reading : $meter->initial_reading;

        return view('admin.concessionaire_meter_reading', compact('meter', 'previous'));
    }

    public function calculateAmountDue(Request $request)
    {
        $validated = $request->validate([
            'previous_reading' => 'required|integer|min:0',
            'present_reading' => 'required|integer|min:0|gte:previous_reading',
            'reading_date' => 'required|date_format:Y-m-d',
        ]);

        $consumption = $validated['present_reading'] - $validated['previous_reading'];

        // Get active tariffs for the reading date, ordered by min_consumption
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

            // Skip if consumption is below the block's minimum
            if ($consumption < $rate->min_consumption) {
                continue;
            }

            // Define block range
            $blockMin = $rate->min_consumption;
            $blockMax = $rate->max_consumption ?? PHP_INT_MAX; // Use max integer for null (no limit)

            // Calculate usage in this block
            if ($consumption >= $blockMin) {
                $blockUsage = min($remaining, $blockMax - $blockMin + 1);

                // Ensure blockUsage is non-negative and within consumption
                $blockUsage = max(0, min($blockUsage, $consumption - $blockMin + 1));

                // Add flat amount (charged once per block if consumption falls in it)
                $amountDue += $rate->flat_amount;

                // Add per cubic meter charge
                if ($rate->rate_per_cubic_meter > 0) {
                    $amountDue += $blockUsage * $rate->rate_per_cubic_meter;
                }

                $remaining -= $blockUsage;
            }
        }

        // If remaining consumption is not covered by any tariff
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

    public function concessionaireBilling()
    {
        $concessionaires = Concessionaire::all();
        return view('admin.concessionaire_billing', compact('concessionaires'));
    }
}
