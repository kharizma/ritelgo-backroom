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
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('user_id');
            $table->string('user_name');
            $table->string('user_email');
            $table->string('user_mobile_phone');
            $table->string('package_subscription_id');
            $table->string('package_subscription_name');
            $table->string('price_type');
            $table->integer('package_subscription_price');
            $table->integer('total_amount');
            $table->string('status')->default('unpaid');
            $table->string('xendit_invoice_url')->nullable();
            $table->string('bank_code')->nullable();
            $table->string('payment_invoice')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};
