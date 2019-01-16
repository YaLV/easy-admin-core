<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Attribute Sets
        Schema::create('attribute_sets', function($table) {
            $table->increments('id');
            $table->string('slug');
            $table->string('name');
            $table->timestamps();
        });

        // Attributes
        Schema::create('attributes', function($table) {
            $table->increments('id');
            $table->integer('attribute_set_id')->references('id')->on('attribute_sets');
            $table->string('slug');
            $table->string('name');
            $table->string('class');
            $table->string('type');
            $table->timestamps();
        });


        // Attribute Values
        Schema::create('attribute_values', function($table) {
            $table->increments('id');
            $table->string('slug');
            $table->string('name');
            $table->integer('attribute_id')->references('id')->on('attributes');
            $table->timestamps();
        });

        // Products
        Schema::create('products', function ($table) {
            $table->increments('id');
            $table->string('sku')->unique();
            $table->integer('attribute_set_id')->references('id')->on('attribute_sets');
            $table->boolean('active')->default(false);
            $table->timestamps();
        });

        // Product Prices
        Schema::create('product_prices', function($table) {
            $table->increments('id');
            $table->string('product_id')->references('id')->on('products');
            $table->string('attribute_id')->references('id')->on('attributes');
            $table->decimal('price', 10, 2);
            $table->timestamp('sale_from')->nullable();
            $table->timestamp('sale_to')->nullable();
            $table->decimal('sale_price', 10, 2);
            $table->timestamps();
        });


        // Product Names
        Schema::create('product_names', function($table) {
            $table->increments('id');
            $table->string('product_id')->references('id')->on('products');
            $table->string('name');
            $table->string('language');
            $table->timestamps();
            $table->unique(['product_id', 'language']);
        });

        // Slug table (for languages)
        Schema::create('product_slugs', function($table) {
            $table->increments('id');
            $table->integer('product_id')->references('id')->on('products');
            $table->string('slug');
            $table->string('language');
            $table->timestamps();
            $table->unique(['product_id', 'language']);
        });

        // Excerpt table (for languages)
        Schema::create('product_excerpts', function($table) {
            $table->increments('id');
            $table->integer('product_id')->references('id')->on('products');
            $table->text('excerpt');
            $table->string('language');
            $table->timestamps();
            $table->unique(['product_id', 'language']);
        });

        // Description table (for languages)
        Schema::create('product_descriptions', function($table) {
            $table->increments('id');
            $table->integer('product_id')->references('id')->on('products');
            $table->text('description');
            $table->string('language');
            $table->timestamps();
            $table->unique(['product_id', 'language']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_prices');
        Schema::dropIfExists('product_excerpts');
        Schema::dropIfExists('product_descriptions');
        Schema::dropIfExists('product_slugs');
        Schema::dropIfExists('product_names');
        Schema::dropIfExists('products');
        Schema::dropIfExists('attribute_values');
        Schema::dropIfExists('attribute_attribute_set');
        Schema::dropIfExists('attributes');
        Schema::dropIfExists('attribute_sets');
    }
}
