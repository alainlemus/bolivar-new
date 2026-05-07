<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('obituaries', function (Blueprint $table) {
            $table->id();
            $table->string('deceased_name');
            $table->date('date_of_death')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('age')->nullable();
            $table->string('relationship')->nullable();
            $table->string('responsible_name');
            $table->string('responsible_phone');
            $table->string('responsible_email')->nullable();
            $table->text('obituary_text')->nullable();
            $table->string('chapel')->nullable();
            $table->dateTime('velatorio_start')->nullable();
            $table->dateTime('velatorio_end')->nullable();
            $table->string('departure_time')->nullable();
            $table->string('destination')->nullable();
            $table->string('cemetery')->nullable();
            $table->dateTime('burial_date')->nullable();
            $table->string('image')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('obituaries');
    }
};