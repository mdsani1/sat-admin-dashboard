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
        Schema::table('lesson_histories', function (Blueprint $table) {
            $table->string('title')->nullable()->after('id');
            $table->string('description')->nullable()->after('title');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lesson_histories', function (Blueprint $table) {
            $table->dropColumn(['title', 'description']);
        });
    }
};
