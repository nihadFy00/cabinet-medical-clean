<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('ordonnances', function (Blueprint $table) {
            if (!Schema::hasColumn('ordonnances', 'date_ordonnance')) {
                $table->date('date_ordonnance')->nullable()->after('instructions');
            }
        });
    }

    public function down(): void
    {
        Schema::table('ordonnances', function (Blueprint $table) {
            if (Schema::hasColumn('ordonnances', 'date_ordonnance')) {
                $table->dropColumn('date_ordonnance');
            }
        });
    }
};