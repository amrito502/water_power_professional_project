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
        Schema::create('sku_sub_departments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sku_department_id')->nullable()->constrained('sku_departments')->nullOnDelete(); 
            $table->string('name', 50)->nullable();
            $table->unsignedInteger('status')->nullable();
            $table->unsignedInteger('rank')->default(5);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sku_sub_departments');
    }
};
