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
        Schema::table('products', function (Blueprint $table) {
            $table->integer('sale_id');
        });

        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->string('sale_name');
            $table->dateTime('sale_from');
            $table->dateTime('sale_to');
            $table->boolean('is_sale_active')->default(false);
            $table->integer('sale_percent')->default(0);
            $table->string('slug');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('sale_id');
        });
    }
};
