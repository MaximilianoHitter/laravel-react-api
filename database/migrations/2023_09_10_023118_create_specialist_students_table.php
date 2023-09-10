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
        Schema::create('specialist_students', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_student')->constrained('students');
            $table->foreignId('id_specialist')->constrained('specialists');
            $table->varchar('status');
            $table->date('date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('specialist_students');
    }
};
