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
        Schema::create('datasets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('topik_id');
            $table->foreign('topik_id')->references('id')->on('topiks')->onDelete('CASCADE');
            $table->string('nama_dataset');
            $table->json('meta_data_json');
            $table->string('metadata_info');
            $table->string('files');
            $table->string('last_update')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('datasets');
    }
};
