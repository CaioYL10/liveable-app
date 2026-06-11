<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rent_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();   // solicitador
            $table->foreignId('property_id')->constrained()->cascadeOnDelete();

            // Dados da cobrança AbacatePay
            $table->string('abacatepay_id')->nullable();       // ID retornado pela API
            $table->string('br_code', 1000)->nullable();       // copia-e-cola PIX
            $table->string('br_code_base64', 5000)->nullable();// imagem QR base64

            // Valores
            $table->integer('amount');                         // em centavos

            // Status: pending_payment | paid | expired | cancelled
            $table->string('status')->default('pending_payment');

            // Prazo de pagamento (24h após aceite)
            $table->timestamp('expires_at')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
