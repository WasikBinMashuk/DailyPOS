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
        Schema::create('sell_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sell_id')->constrained();
            $table->string('payment_method');
            $table->decimal('due', 10, 2);
            $table->decimal('paid', 10, 2);
            $table->decimal('total_price', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sell_payments');
    }
};
