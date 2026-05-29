<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('property_reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('property_id');
            $table->foreignId('user_id');
            $table->string('comment');
            $table->string('rate');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('property_reviews');
    }
};
