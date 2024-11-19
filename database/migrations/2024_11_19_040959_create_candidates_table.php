<?php

use App\Enums\CandidateStatusEnum;
use App\Enums\TypeOfSchoolGraduateFromEnum;
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
        Schema::create('candidates', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->uuid('information_id');

            $table->enum('type_of_school_graduated_from', TypeOfSchoolGraduateFromEnum::values())->default(TypeOfSchoolGraduateFromEnum::PUBLIC());

            $table->string('senior_highschool_strand');

            // Grouping
            $table->boolean('is_first_generation_group');
            $table->boolean('is_indigenous_people_group');
            $table->boolean('is_person_with_disability_group');
            $table->boolean('is_solo_parent_group');
            $table->boolean('is_person_with_special_needs_group');

            $table->string('annual_income_amount');

            $table->string('source_of_family_income');

            // Primary Source of Support for Study
            $table->boolean('source_is_uni_fast');
            $table->boolean('source_is_other_scholarships');
            $table->boolean('source_is_self_financed');
            $table->boolean('source_is_parent');

            // Gadgets owned
            $table->boolean('has_mobile_phone');
            $table->boolean('has_laptop');
            $table->boolean('has_tablet');
            $table->boolean('has_desktop');
            $table->text('other_gadgets');

            $table->enum('candidate_status', CandidateStatusEnum::values())->default(CandidateStatusEnum::APPLICANT());

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('candidates');
    }
};
