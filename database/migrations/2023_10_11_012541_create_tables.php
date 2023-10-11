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
        Schema::create('subcategories', function (Blueprint $table) {
            $table->id();
            $table->string('subcategory_name');
            $table->bigInteger('category_id');
            $table->string('category_name');
            $table->integer('product_count')->default(0);
            $table->string('slug');
            $table->timestamps();
        });
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('product_name');
            $table->text('product_short_des');
            $table->text('product_long_des');
            $table->integer('price');
            $table->integer('product_category_id');
            $table->string('product_category_name');
            $table->integer('product_subcategory_id');
            $table->string('product_subcategory_name');
            $table->string('product_image');
            $table->string('slug');
            $table->timestamps();
        });
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('subcategory_name');
            $table->bigInteger('category_id');
            $table->string('category_name');
            $table->integer('product_count')->default(0);
            $table->string('slug');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subcategories');
        Schema::dropIfExists('products');
        Schema::dropIfExists('orders');
    }
};
