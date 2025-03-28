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
        Schema::create('sku_prices', function (Blueprint $table) {
            $table->id();
            $table->string('sku_code', 250)->nullable();
            $table->foreignId('branch_id')->constrained('branches')->onDelete('cascade');
            $table->foreignId('sku_id')->nullable()->constrained('skus')->onDelete('set null'); 

            $table->decimal('cost_price', 15, 2)->default(0.00);
            $table->decimal('sell_price', 15, 2)->default(0.00);

            $table->unsignedInteger('status')->nullable();
            $table->timestamp('change_date')->nullable();
            $table->unsignedInteger('rank')->default(5);
            $table->timestamps(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sku_prices');
    }
};
