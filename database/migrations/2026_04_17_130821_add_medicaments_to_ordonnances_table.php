<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('ordonnances', function (Blueprint $table) {
            if (!Schema::hasColumn('ordonnances', 'medicaments')) {
                $table->text('medicaments')->nullable()->after('consultation_id');
            }
        });
    }

    public function down(): void
    {
        Schema::table('ordonnances', function (Blueprint $table) {
            if (Schema::hasColumn('ordonnances', 'medicaments')) {
                $table->dropColumn('medicaments');
            }
        });
    }
};