<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tariff_rates', function (Blueprint $table) {
            $table->id();
            $table->date('effective_date'); // when this tariff takes effect
            $table->integer('min_consumption'); // starting cubic meter of block
            $table->integer('max_consumption')->nullable(); // null = no limit
            $table->decimal('flat_amount', 8, 2)->default(0); // fixed block charge
            $table->decimal('rate_per_cubic_meter', 8, 2)->default(0); // per cu.m. charge for this block
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tariff_rates');
    }
};
