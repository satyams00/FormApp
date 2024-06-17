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
        Schema::create('jobs', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id');
            $table->string('title');
            $table->string('post');
            $table->date('registrationStartDate');
            $table->date('registrationEndDate');
            $table->integer('minimumAge');
            $table->integer('maximumAge');
            $table->integer('minimumHeight');
            // $table->string('jobLocation');
            // $table->string('examCenter');
            $table->string('jobDescription');
            $table->date('examDate');
            $table->integer('minimumHighSchoolPercentage');
            $table->integer('minimumIntermediatePercentage');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
};
