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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('mark_id')->unsigned();
            $table->foreign('mark_id')->references('id')->on('marks');
            $table->integer('version_id')->unsigned();
            $table->foreign('version_id')->references('id')->on('versions');
            $table->integer('generation_id')->unsigned();
            $table->foreign('generation_id')->references('id')->on('generations');
            $table->string('image')->unique()->nullable();
            $table->double('cost', 8, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
