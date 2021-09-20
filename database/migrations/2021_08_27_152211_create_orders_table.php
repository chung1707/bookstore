<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained();
            $table->string('transaction_id');
            $table->text('note')->nullable();
            $table->float('totalPrice')->default(0);
            $table->boolean('pending')->default(true);
            $table->boolean('processing')->default(false);
            $table->boolean('complete')->default(false);
            $table->boolean('Canceled')->default(false);
            $table->foreignId('transporter_id')->constrained();
            $table->integer('discount_code_id')->nullable();
            $table->string('dispatch');
            $table->integer('province_id');
            $table->integer('district_id');
            $table->integer('ward_id');
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
        Schema::dropIfExists('orders');
    }
}
