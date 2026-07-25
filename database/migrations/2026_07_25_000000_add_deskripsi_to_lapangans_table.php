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
        Schema::table('lapangans', function (Blueprint $table) {
            if (! Schema::hasColumn('lapangans', 'deskripsi')) {
                $table->text('deskripsi')->nullable()->after('harga_per_jam');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lapangans', function (Blueprint $table) {
            if (Schema::hasColumn('lapangans', 'deskripsi')) {
                $table->dropColumn('deskripsi');
            }
        });
    }
};
