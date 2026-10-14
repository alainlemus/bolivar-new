<?php

use App\Models\SiteInfo;
use App\Support\LegalDocuments;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('site_infos', function (Blueprint $table) {
            $table->longText('terms_conditions')->nullable()->after('privacy_notice');
        });

        // Actualiza el aviso de privacidad a la LFPDPPP vigente (DOF 20-03-2025) y agrega los términos.
        if ($site = SiteInfo::first()) {
            $site->update([
                'privacy_notice' => LegalDocuments::privacyNotice($site),
                'terms_conditions' => LegalDocuments::terms($site),
            ]);
        }
    }

    public function down(): void
    {
        Schema::table('site_infos', function (Blueprint $table) {
            $table->dropColumn('terms_conditions');
        });
    }
};
