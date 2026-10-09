<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('obituaries', function (Blueprint $table) {
            $table->json('gallery')->nullable()->after('image');
            $table->unsignedInteger('candles')->default(0)->after('gallery');
        });
    }

    public function down(): void
    {
        Schema::table('obituaries', function (Blueprint $table) {
            $table->dropColumn(['gallery', 'candles']);
        });
    }
};
