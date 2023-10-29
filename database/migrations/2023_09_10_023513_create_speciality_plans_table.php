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
        Schema::create('speciality_plans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('students');
            $table->foreignId('specialist_id')->constrained('specialists');
            $table->string('name');
            $table->longText('description');
            $table->date('initial_date');
            $table->date('final_date');
            $table->integer('id_payment')->nullable();
            $table->longText('student_feedback')->nullable();
            $table->foreignId('id_plan_status')->constrained('statuses');
            $table->decimal('amount', 8, 2, false);
            $table->string('color');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('speciality_plans');
    }
};
