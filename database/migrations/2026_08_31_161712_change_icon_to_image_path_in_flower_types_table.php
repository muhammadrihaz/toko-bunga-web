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
        Schema::table('flower_types', function (Blueprint $table) {
            $table->dropColumn('icon');
            $table->string('image_path')->nullable()->after('name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('flower_types', function (Blueprint $table) {
            $table->dropColumn('image_path');
            $table->string('icon')->nullable()->after('name');
        });
    }
};
