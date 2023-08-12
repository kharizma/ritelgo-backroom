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
        Schema::create('package_subscription_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('package_subscription_id');
            $table->string('custom_name')->nullable();
            $table->string('default_name');
            $table->string('variable');
            $table->boolean('is_technical');
            $table->string('value_type');
            $table->string('value');
            $table->integer('order')->default(1);
            $table->timestamps();
            $table->foreign('package_subscription_id')->references('id')->on('package_subscriptions');
            $table->unique(['package_subscription_id','default_name','variable']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('package_subscription_details', function (Blueprint $table) {
            $table->dropForeign(['package_subscription_id']);
        });

        Schema::dropIfExists('package_subscription_details');
    }
};
