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
        Schema::create('user_businesses', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('user_id');
            $table->string('business_type_id');
            $table->string('logo')->nullable();
            $table->string('name');
            $table->char('province_id', 2);
            $table->string('province_name');
            $table->char('regency_id', 4)->nullable();
            $table->string('regency_name')->nullable();
            $table->char('district_id', 7)->nullable();
            $table->string('district_name')->nullable();
            $table->char('village_id', 10)->nullable();
            $table->string('village_name')->nullable();
            $table->char('zip_code',5)->nullable();
            $table->string('created_by');
            $table->string('updated_by');
            $table->timestamps();
            $table->foreign('business_type_id')->references('id')->on('business_types');
            $table->foreign('province_id')->references('id')->on('provinces');
            $table->foreign('regency_id')->references('id')->on('regencies');
            $table->foreign('district_id')->references('id')->on('districts');
            $table->foreign('village_id')->references('id')->on('villages');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_businesses', function (Blueprint $table) {
            $table->dropForeign(['business_type_id']);
            $table->dropForeign(['province_id']);
            $table->dropForeign(['regency_id']);
            $table->dropForeign(['district_id']);
            $table->dropForeign(['village_id']);
        });

        Schema::dropIfExists('user_businesses');
    }
};
