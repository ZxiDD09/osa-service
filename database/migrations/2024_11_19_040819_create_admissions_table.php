<?php

use App\Enums\EnrollmentStatusEnum;
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
        Schema::create('admissions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('semester');
            $table->uuid('candidate_id');
            $table->uuid('school_year_id');
            $table->uuid('course_id');
            $table->uuid('section_id');

            $table->boolean('is_new_student')->default(true);

            $table->enum('enrollment_status', EnrollmentStatusEnum::values())->default(EnrollmentStatusEnum::New());

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admissions');
    }
};
