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
        Schema::table('smoking_data', function (Blueprint $table) {
            $table->float('nicotine_per_cigarette')->after('cigarettes_per_day');
            $table->float('tar_per_cigarette')->after('nicotine_per_cigarette');
            $table->integer('cigarettes_per_pack')->after('tar_per_cigarette');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('smoking_data', function (Blueprint $table) {
            $table->dropColumn('nicotine_per_cigarettes');
            $table->dropColumn('tar_per_cigarettes');
            $table->dropColumn('cigarettes_per_pack');
        });
    }
};
