<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string("name", 255);
            $table->string("code", 20);
            $table->string("thumb", 200);
            $table->integer("star_votes")->nullable();
            $table->string("thumb1", 200)->nullable();
            $table->string("thumb2", 200)->nullable();
            $table->string("thumb3", 200)->nullable();
            $table->enum("status", ["active", "trash"]);
            $table->enum("category_product", ["skirt","shirt","trouser", "sales_good_product", "hot_product"]);
            $table->string("color", 200);
            $table->string("price_new", 20);
            $table->string("price_old", 20)->nullable();
            $table->text("desc", 6000)->nullable();
            $table->text("content", 6000);
            $table->string("fabric_material", 300);
            $table->string("trandmake", 300);
            $table->string("author", 300);
            $table->string("qty", 150);
            $table->string("S", 10)->nullable();
            $table->string("M", 10)->nullable();
            $table->string("L", 10)->nullable();
            $table->string("XL", 10)->nullable();
            $table->string("XXL", 10)->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
