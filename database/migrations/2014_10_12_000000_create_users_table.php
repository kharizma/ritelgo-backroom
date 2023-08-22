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
        Schema::create('users', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('role'); // superadmin, owner, manager-outlet, cashier
            $table->string('name');
            $table->string('initial_name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('mobile_phone')->unique();
            $table->timestamp('mobile_phone_verified_at')->nullable();
            $table->string('package_subscription_id')->nullable();
            $table->string('package_subscription_name')->nullable();
            $table->date('valid_until')->nullable();
            $table->date('last_payment_date')->nullable();
            $table->string('timezone')->default('Asia/Jakarta');
            $table->boolean('is_subscribe')->default(true);
            $table->boolean('is_complete_registration')->nullable();
            $table->string('status')->default('non-active'); //active,non-active,suspend,block
            $table->rememberToken();
            $table->string('created_by');
            $table->string('updated_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
