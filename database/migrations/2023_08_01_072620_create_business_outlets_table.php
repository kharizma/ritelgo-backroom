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
        Schema::create('business_outlets', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('business_id');
            $table->string('name');
            $table->text('address')->nullable();
            $table->char('province_id', 2)->nullable();
            $table->string('province_name')->nullable();
            $table->char('regency_id', 4)->nullable();
            $table->string('regency_name')->nullable();
            $table->char('district_id', 6)->nullable();
            $table->string('district_name')->nullable();
            $table->char('village_id', 10)->nullable();
            $table->string('village_name')->nullable();
            $table->char('zip_code',5)->nullable();
            $table->string('status')->default('active'); // active, non-active
            $table->string('created_by');
            $table->string('updated_by');
            $table->timestamps();
            $table->foreign('business_id')->references('id')->on('user_businesses');
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
        Schema::table('business_outlets', function (Blueprint $table) {
            $table->dropForeign(['business_id']);
            $table->dropForeign(['province_id']);
            $table->dropForeign(['regency_id']);
        });

        Schema::dropIfExists('business_outlets');
    }
};
