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
        Schema::create('subscription_callbacks', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('subscription_id');
            $table->json('xendit_notification')->nullable();
            $table->string('xendit_callback_id');
            $table->string('xendit_external_id')->nullable();
            $table->string('xendit_user_id')->nullable();
            $table->boolean('xendit_is_high')->nullable();
            $table->string('xendit_status')->nullable();
            $table->string('xendit_merchant_name')->nullable();
            $table->string('xendit_merchant_profile_picture_url')->nullable();
            $table->integer('xendit_amount')->nullable();
            $table->integer('xendit_paid_amount')->nullable();
            $table->string('xendit_bank_code')->nullable();
            $table->timestamp('xendit_paid_at')->nullable();
            $table->string('xendit_payer_email')->nullable();
            $table->text('xendit_description')->nullable();
            $table->timestamp('xendit_expiry_date')->nullable();
            $table->integer('xendit_created')->nullable();
            $table->integer('xendit_updated')->nullable();
            $table->string('xendit_mid_label')->nullable();
            $table->string('xendit_currency')->nullable();
            $table->string('xendit_payment_method')->nullable();
            $table->string('xendit_payment_channel')->nullable();
            $table->string('xendit_payment_destination')->nullable();
            $table->string('xendit_success_redirect_url')->nullable();
            $table->string('xendit_failure_redirect_url')->nullable();
            $table->boolean('xendit_fixed_va')->nullable();
            $table->string('xendit_locale')->nullable();
            $table->integer('xendit_adjusted_received_amount')->nullable();
            $table->integer('xendit_fees_paid_amount')->nullable();
            $table->foreign('subscription_id')->references('id')->on('subscriptions');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('subscription_callbacks', function (Blueprint $table) {
            $table->dropForeign(['subscription_id']);
        });

        Schema::dropIfExists('subscription_callbacks');
    }
};
