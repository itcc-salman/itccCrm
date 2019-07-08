<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWebSalesItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('web_sales_items', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('web_sales_id');
            $table->text('item_descriptions')->nullable();
            $table->string('unit_price')->nullable();
            $table->string('quantity')->nullable();
            $table->string('total')->nullable();

            $table->tinyInteger('status')->default('0')->comment('Active - 0, Deactive - 1');
            $table->tinyInteger('is_deleted')->default('0')->comment('0 - Not Deleted, 1 - Deleted');
            $table->integer('created_by');
            $table->integer('modified_by');
            $table->timestamps();

            $table->foreign('web_sales_id')->references('id')->on('web_sales_forms');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('web_sales_items');
    }
}
