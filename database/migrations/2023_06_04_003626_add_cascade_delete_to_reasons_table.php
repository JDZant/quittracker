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
        Schema::table('reasons', function (Blueprint $table) {
            $table->dropForeign(['quit_attempt_id']);
            $table->foreign('quit_attempt_id')
                ->references('id')
                ->on('quit_attempts')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reasons', function (Blueprint $table) {
            $table->dropForeign(['quit_attempt_id']);
            $table->foreign('quit_attempt_id')
                ->references('id')
                ->on('quit_attempts');
        });
    }
};
