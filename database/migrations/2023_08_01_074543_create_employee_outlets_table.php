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
        Schema::create('employee_outlets', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('user_id');
            $table->string('business_id');
            $table->string('business_outlet_id');
            $table->string('created_by');
            $table->string('updated_by');
            $table->timestamps();
            $table->foreign('business_id')->references('id')->on('user_businesses');
            $table->foreign('business_outlet_id')->references('id')->on('business_outlets');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('employee_outlets', function (Blueprint $table) {
            $table->dropForeign(['business_id']);
            $table->dropForeign(['business_outlet_id']);
        });

        Schema::dropIfExists('employee_outlets');
    }
};
