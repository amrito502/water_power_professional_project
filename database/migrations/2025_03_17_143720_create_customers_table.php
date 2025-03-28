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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('customer_code', 255)->nullable();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('shop_name', 255)->nullable();
            $table->string('full_name', 255)->nullable();
            $table->string('gender', 255)->nullable()->comment('Male or Female');
            $table->string('address', 255)->nullable();
            $table->string('postal_code')->nullable();
            $table->string('thana', 255)->nullable();
            $table->string('city', 255)->nullable();
            $table->string('phone', 255)->nullable();
            $table->string('email', 255)->nullable();
            $table->string('v_card', 255)->nullable();
            $table->date('date_of_birth')->nullable();
            $table->decimal('opening_balance', 15, 2)->default(0.00)->comment('owner get from customer');
            $table->unsignedInteger('status')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
