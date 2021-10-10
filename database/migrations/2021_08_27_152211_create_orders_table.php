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
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->string('transaction_id');
            $table->string('payment_methods');
            $table->text('note')->nullable();
            $table->double('totalPrice')->default(0);
            $table->boolean('pending')->default(true);
            $table->boolean('processing')->default(false);
            $table->boolean('delivered')->default(false);
            $table->boolean('canceled')->default(false);
            $table->foreignId('transporter_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->integer('discount_code_id')->nullable();
            $table->string('dispatch');
            $table->string('phone_number')->nullable();
            $table->integer('province_id');
            $table->integer('district_id');
            $table->integer('ward_id');
            $table->timestamps();
            $table->softDeletes();
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
