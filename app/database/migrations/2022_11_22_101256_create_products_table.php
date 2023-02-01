<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            $table->foreignId('category_id')->constrained('categories', 'id')->cascadeOnDelete();

            // $table->string('name');
            // $table->string('slug');
            // $table->longText('description');
            // $table->longtext('content');

            $table->string('original_price');
            $table->string('selling_price');
            $table->string('image');
            // $table->string('quantity');
            $table->string('tax');

            $table->tinyInteger('status');
            $table->tinyInteger('trending');

            // $table->mediumText('meta_title');
            // $table->mediumText('meta_keyword');
            // $table->mediumText('meta_description');
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
};
