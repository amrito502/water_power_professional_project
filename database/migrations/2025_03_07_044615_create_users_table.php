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
            $table->id();
            $table->unsignedBigInteger('branch_id');
            $table->unsignedBigInteger('zone_id');
            $table->string('name', 100)->nullable()->default('');
            $table->string('username', 128)->nullable()->default('');
            $table->string('password', 128)->nullable();
            $table->string('photo', 255)->nullable()->default('');
            $table->string('mobile', 50)->nullable()->default('');
            $table->string('email', 50)->nullable()->default('');
            $table->string('os', 128)->nullable()->default('');  // OS information
            $table->string('ip_address', 20)->nullable()->default('');  // IP address
            $table->string('browser', 128)->nullable()->default('');  // Browser info
            $table->decimal('offer_commission', 8, 2)->default(0);  // Offer commission
            $table->tinyInteger('logged_in')->default(2);  // Logged in status
            $table->unsignedInteger('status')->nullable();

            // Foreign Key constraints
            $table->foreign('branch_id')->nullable()->references('id')->on('branches')->onDelete('cascade');
            $table->foreign('zone_id')->nullable()->references('id')->on('zones')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
