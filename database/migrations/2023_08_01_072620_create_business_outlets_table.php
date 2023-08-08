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
            $table->char('regency_id', 4);
            $table->string('regency_name');
            $table->char('province_id', 2);
            $table->string('province_name');
            $table->string('status')->default('non-active'); // active, non-active
            $table->string('created_by');
            $table->string('updated_by');
            $table->timestamps();
            $table->foreign('business_id')->references('id')->on('user_businesses');
            $table->foreign('province_id')->references('id')->on('provinces');
            $table->foreign('regency_id')->references('id')->on('regencies');
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
