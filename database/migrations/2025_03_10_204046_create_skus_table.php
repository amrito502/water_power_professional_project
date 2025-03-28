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
        Schema::create('skus', function (Blueprint $table) {
            $table->id();
            $table->string('sku_code', 150)->nullable();
            $table->string('bar_code', 150)->default('0');
            $table->string('sku_name', 200)->nullable();

            $table->decimal('cost_price', 15, 2)->default(0.00);
            $table->decimal('sell_price', 15, 2)->default(0.00);
            $table->string('image', 255)->nullable();

            $table->foreignId('sku_department_id')->nullable()->constrained('sku_departments')->nullOnDelete();
            $table->foreignId('sku_sub_department_id')->nullable()->constrained('sku_sub_departments')->nullOnDelete();

            $table->foreignId('categorie_id')->nullable()->constrained('categories')->nullOnDelete();
            $table->foreignId('brand_id')->nullable()->constrained('brands')->nullOnDelete();
            $table->unsignedInteger('supplier_id')->default(0);
            $table->foreignId('tax_id')->nullable()->constrained('taxes')->nullOnDelete();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();

            $table->enum('negative_stock', ['yes', 'no'])->nullable();
            $table->enum('is_weighted', ['yes', 'no'])->default('no');

            $table->unsignedTinyInteger('case_count')->nullable();
            $table->unsignedTinyInteger('is_ecommerce')->default(2);
            $table->unsignedTinyInteger('is_featured')->default(2);
            $table->unsignedTinyInteger('is_sales')->default(2);
            $table->unsignedTinyInteger('is_parent')->default(2);
            $table->longText('specification')->nullable();
            $table->longText('shipping_payment')->nullable();
            $table->longText('description')->nullable();
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
        Schema::dropIfExists('skus');
    }
};
