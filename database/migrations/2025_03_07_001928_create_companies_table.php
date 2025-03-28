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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('packageId')->default(1);
            $table->string('orgIdPrefix', 5)->nullable();
            $table->string('name', 150)->nullable();
            $table->string('domain', 150);
            $table->string('email', 150);
            $table->string('favicon', 150);
            $table->string('logo', 150)->nullable();
            $table->string('theme', 150)->nullable();
            $table->string('skin', 150)->nullable();
            $table->text('detailsinfo')->nullable();
            $table->unsignedInteger('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
