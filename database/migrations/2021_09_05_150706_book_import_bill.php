<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BookImportBill extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_import_bills', function (Blueprint $table) {
            $table->id();
            $table->foreignId('import_bills_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->integer('book_id');
            $table->integer('quantity')->default(1);
            $table->double('price');
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
        Schema::dropIfExists('book_import_bills');
    }
}
