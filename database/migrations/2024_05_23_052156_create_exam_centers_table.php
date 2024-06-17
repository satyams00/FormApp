<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('exam_centers', function (Blueprint $table) {
            $table->uuid('id')->primary();
            // $table->uuid('job_id');
            $table->string('name')->unique();
            $table->timestamps();
            $table->softDeletes();

            // $table->foreign('job_id')->references('id')->on('jobs')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exam_centers');
    }
};
