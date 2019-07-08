<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name',50);
            $table->string('last_name',50);
            $table->string('company_name');
            $table->string('abn');
            $table->string('address_line1')->nullable();
            $table->string('address_line2')->nullable();
            $table->string('suburb',100)->nullable();
            $table->string('state',90)->nullable();
            $table->string('post_code',20)->nullable();
            $table->string('country',50)->nullable();
            $table->string('contact_work',50)->nullable();
            $table->string('contact_mobile',50)->nullable();
            $table->string('email')->unique();
            $table->tinyInteger('gender')->nullable()->comment('0-female,1-male');
            $table->string('website_url')->nullable();
            $table->string('no_of_employees')->default('0');
            $table->string('industry')->nullable();
            $table->tinyInteger('status')->comment('Active - 0, Deactive - 1');
            $table->tinyInteger('is_deleted')->default('0')->comment('0 - Not Deleted, 1 - Deleted');
            $table->integer('created_by');
            $table->integer('modified_by');
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
        Schema::dropIfExists('customers');
    }
}
