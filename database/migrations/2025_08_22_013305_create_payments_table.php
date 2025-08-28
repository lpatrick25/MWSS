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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bill_id')->constrained('billings')->cascadeOnDelete('restrict');
            $table->date('payment_date');
            $table->decimal('amount_paid');
            $table->decimal('amount_change');
            $table->enum('payment_method', ['Cash', 'Online']);
            $table->string('payment_reference')->nullable();
            $table->foreignId('collected_by')->nullable()->constrained('users')->cascadeOnDelete('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
