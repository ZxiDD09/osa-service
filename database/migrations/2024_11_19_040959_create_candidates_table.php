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

            $table->uuid('information_id')->index();

            $table->enum('type_of_school_graduated_from', TypeOfSchoolGraduateFromEnum::values())->default(TypeOfSchoolGraduateFromEnum::PUBLIC())->index();

            $table->string('senior_highschool_strand')->index();

            // Grouping
            $table->boolean('is_first_generation_group')->index();
            $table->boolean('is_indigenous_people_group')->index();
            $table->boolean('is_person_with_disability_group')->index();
            $table->boolean('is_solo_parent_group')->index();
            $table->boolean('is_person_with_special_needs_group')->index();

            $table->string('annual_income_amount')->index();

            $table->string('source_of_family_income')->index();

            // Primary Source of Support for Study
            $table->boolean('source_is_uni_fast')->index();
            $table->boolean('source_is_other_scholarships')->index();
            $table->boolean('source_is_self_financed')->index();
            $table->boolean('source_is_parent')->index();

            // Gadgets owned
            $table->boolean('has_mobile_phone')->index();
            $table->boolean('has_laptop')->index();
            $table->boolean('has_tablet')->index();
            $table->boolean('has_desktop')->index();
            $table->text('other_gadgets');

            $table->enum('candidate_status', CandidateStatusEnum::values())->default(CandidateStatusEnum::APPLICANT())->index();

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
