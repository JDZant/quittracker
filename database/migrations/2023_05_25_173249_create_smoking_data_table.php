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
        Schema::create('smoking_data', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quit_attempt_id')
                ->constrained('quit_attempts');
            $table->integer('cigarettes_per_day');
            $table->double('cost_per_pack');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('smoking_data');
    }
};
