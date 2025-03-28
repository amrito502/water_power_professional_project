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
        Schema::create('branches', function (Blueprint $table) {
            $table->id();
            $table->string('branchIdPrefix', 5)->nullable();
            $table->string('name', 255)->nullable();
            $table->string('addressline', 255)->nullable();
            $table->string('city', 150)->nullable();
            $table->string('postalcode', 150)->nullable();
            $table->string('phone', 155)->nullable();
            $table->string('fax', 155)->nullable();
            $table->string('email', 155)->nullable();
            $table->string('vatrn', 150)->nullable();
            $table->unsignedInteger('status')->nullable();
            $table->unsignedTinyInteger('isDefault')->default(0);
            $table->unsignedTinyInteger('isDueInvoice')->default(0);
            $table->unsignedTinyInteger('isSpecialDiscount')->default(0);
            $table->unsignedTinyInteger('isInstantDiscount')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('branches');
    }
};
