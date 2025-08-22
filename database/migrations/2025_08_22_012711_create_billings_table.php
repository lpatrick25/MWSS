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
        Schema::create('billings', function (Blueprint $table) {
            $table->id();
            $table->string('bill_no');
            $table->foreignId('concessionaire_id')->constrained('concessionaires')->cascadeOnDelete('restrict');
            $table->foreignId('meter_reading_id')->constrained('meter_readings')->cascadeOnDelete('restrict');
            $table->string('billing_month');
            $table->date('due_date');
            $table->decimal('amount_due', 10,2);
            $table->enum('status', ['Pending', 'Paid', 'Overdue']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('billings');
    }
};
