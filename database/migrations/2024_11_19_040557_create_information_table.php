<?php

use App\Enums\CivilStatusEnum;
use App\Enums\SexEnum;
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
        Schema::create('information', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('first_name');
            $table->string('middle_name');
            $table->string('last_name');
            $table->string('suffix')->nullable();
            $table->string('zip_code');
            $table->string('zone');
            $table->string('barangay');
            $table->string('municipality');
            $table->string('province');
            $table->string('date_of_birth');
            $table->string('place_of_birth');

            $table->string('religion');
            $table->string('nationality');
            $table->string('phone');

            $table->enum('sex', SexEnum::values())->index();
            $table->enum('civil_status', CivilStatusEnum::values())->index();

            // for students nullable
            $table->string('father_last_name')->nullable();
            $table->string('father_first_name')->nullable();
            $table->string('father_middle_name')->nullable();
            $table->string('father_suffix')->nullable();
            $table->string('father_occupation')->nullable();

            $table->string('mother_last_name')->nullable();
            $table->string('mother_first_name')->nullable();
            $table->string('mother_middle_name')->nullable();
            $table->string('mother_suffix')->nullable();
            $table->string('mother_occupation')->nullable();

            $table->string('guardian_full_name')->nullable();
            $table->string('guardian_address')->nullable();
            $table->string('guardian_phone')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('information');
    }
};
