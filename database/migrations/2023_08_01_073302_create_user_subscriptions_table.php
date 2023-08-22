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
        Schema::create('user_subscriptions', function (Blueprint $table) {
            $table->id();
            $table->string('subscription_id');
            $table->date('valid_date');
            $table->string('user_id');
            $table->foreignId('package_subscription_detail_id');
            $table->string('custom_name')->nullable();
            $table->string('default_name');
            $table->string('variable');
            $table->boolean('is_technical');
            $table->string('value_type');
            $table->string('value');
            $table->timestamps();
            $table->foreign('subscription_id')->references('id')->on('subscriptions');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('package_subscription_detail_id')->references('id')->on('package_subscription_details');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_subscriptions', function (Blueprint $table) {
            $table->dropForeign(['package_subscription_detail_id']);
        });

        Schema::dropIfExists('user_subscriptions');
    }
};
