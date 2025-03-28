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
        Schema::create('share_holders', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255)->nullable();
            $table->string('gender', 255)->nullable()->comment('Male or Female');
            $table->string('addressline', 255)->nullable();
            $table->string('city', 255)->nullable();
            $table->string('phone', 255)->nullable();
            $table->string('email', 255)->nullable();
            $table->unsignedTinyInteger('sharePercent')->nullable();
            $table->decimal('opening_balance', 15, 2)->default(0.00)->comment('Initial investment');
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
        Schema::dropIfExists('share_holders');
    }
};
