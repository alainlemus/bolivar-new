<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('map_places', function (Blueprint $table) {
            $table->id();
            $table->string('type', 20)->index();          // panteon | crematorio
            $table->string('name');
            $table->string('address')->nullable();
            $table->string('alcaldia', 60)->nullable()->index();
            $table->decimal('lat', 10, 7);
            $table->decimal('lng', 10, 7);
            $table->string('phone', 40)->nullable();
            $table->string('sector', 20)->nullable();     // publico | privado
            $table->string('source')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('map_places');
    }
};
