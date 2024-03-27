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
        Schema::table('items', function (Blueprint $table) {
            $table->dropColumn(['mark_id', 'version_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('items', function (Blueprint $table) {
            $table->integer('mark_id')->unsigned();
            $table->foreign('mark_id')->references('id')->on('marks');
            $table->integer('version_id')->unsigned();
            $table->foreign('version_id')->references('id')->on('versions');
        });
    }
};
