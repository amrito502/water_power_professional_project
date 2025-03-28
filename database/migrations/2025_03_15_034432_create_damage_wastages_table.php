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
        Schema::create('damage_wastages', function (Blueprint $table) {
            $table->id();
            $table->string('dw_no', 250)->nullable(); 
            $table->tinyInteger('type')->nullable();
            $table->foreignId('branch_id')->nullable()->constrained('branches')->onDelete('cascade');
            $table->foreignId('sku_id')->nullable()->constrained('skus')->nullOnDelete();
            $table->dateTime('dam_date')->nullable(); 
            $table->float('qty')->unsigned()->nullable(); 
            $table->decimal('cost_price', 15, 2)->unsigned()->default(0.00);
            $table->decimal('total_amount', 15, 2)->unsigned()->default(0.00);
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
        Schema::dropIfExists('damage_wastages');
    }
};
