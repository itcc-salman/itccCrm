<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCustomerSalespersonFieldToDigitalsalesform extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('digital_sales_forms', function($table) {
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('sales_person_id');

            $table->foreign('customer_id')->references('id')->on('customers');
            $table->foreign('sales_person_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('digital_sales_forms', function($table) {
            $table->dropForeign('digital_sales_forms_customer_id_foreign');
            $table->dropForeign('digital_sales_forms_sales_person_id_foreign');
            $table->dropColumn('customer_id');
            $table->dropColumn('sales_person_id');
        });
    }
}
