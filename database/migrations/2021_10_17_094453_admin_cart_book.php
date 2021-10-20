<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AdminCartBook extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_cart_book', function (Blueprint $table) {
            $table->id();
            $table->foreignId('admin_cart_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('book_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->integer('quantity')->default(1);
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
        Schema::dropIfExists('admin_cart_book');
    }
}
