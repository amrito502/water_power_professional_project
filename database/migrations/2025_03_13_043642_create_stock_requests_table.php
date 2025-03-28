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
        Schema::create('stock_requests', function (Blueprint $table) {
            $table->id();
            $table->string('po_no', 250)->nullable();
            $table->string('grn_no', 250)->nullable();
            $table->dateTime('grn_date')->nullable();
            $table->dateTime('po_date')->nullable();

            $table->float('total_qty')->unsigned()->nullable();
            $table->decimal('total_price', 15, 2)->unsigned()->default(0.00);
            $table->decimal('total_discount', 15, 2)->unsigned()->default(0.00);
            $table->decimal('grand_total', 15, 2)->unsigned()->default(0.00);
            $table->decimal('disc_percent', 5, 2)->unsigned()->default(0.00);
            $table->float('total_weight')->unsigned()->default(0);
            $table->string('remarks', 250)->nullable();
            $table->string('message', 250)->nullable();
            $table->integer('status')->unsigned()->default(0);
            $table->foreignId('supplier_id')->nullable()->constrained('suppliers')->nullOnDelete();
            $table->foreignId('sku_id')->nullable()->constrained('skus')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_requests');
    }
};
