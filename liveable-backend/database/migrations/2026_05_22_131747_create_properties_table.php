<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('local');
            $table->string('type');
            $table->integer('beds_qtd');
            $table->integer('toilette');
            $table->integer('area');
            $table->string('owner_contact');
            $table->string('property_title');
            $table->boolean('wifi');
            $table->boolean('tv');
            $table->boolean('cooler');
            $table->boolean('air_conditioning');
            $table->boolean('washer');
            $table->boolean('microwave');
            $table->string('contract');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('properties');
    }
};
