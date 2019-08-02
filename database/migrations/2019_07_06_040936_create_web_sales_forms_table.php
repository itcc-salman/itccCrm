<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWebSalesFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('web_sales_forms', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('lead_id')->nullable();
            $table->unsignedBigInteger('sales_person_id');
            $table->string('client_name')->nullable();
            $table->string('client_surname')->nullable();
            $table->string('client_company_name')->nullable();
            $table->string('client_address_line_1')->nullable();
            $table->string('client_suburb')->nullable();
            $table->string('client_state')->nullable();
            $table->string('client_postcode')->nullable();
            $table->string('client_abn')->nullable();
            $table->string('client_contact_work')->nullable();
            $table->string('client_contact_mobile')->nullable();
            $table->string('client_email')->nullable();
            $table->string('client_website')->nullable();

            $table->date('project_start_date')->nullable();
            $table->string('project_amount')->nullable();
            $table->string('project_services')->nullable()->comment('1-graphicDesign,2-webDesign,etc');

            $table->string('sub_total')->nullable();
            $table->string('gst_total')->nullable();
            $table->string('gst_percentage')->default('10')->nullable();
            $table->string('total_amt')->nullable();

            $table->string('payment_type')->comment('1-bank cheque,2-direct debit,3-invoice');
            $table->string('payment_method')->comment('1-upfront,2-30/40/30,3-50/50');
            $table->string('authorisation_date')->nullable();
            $table->text('authorisation_signature')->nullable();

            $table->string('office_use_only_accepted_by')->nullable();
            $table->string('office_use_only_project_manager')->nullable();

            $table->tinyInteger('status')->default('0')->comment('Active - 0, Deactive - 1');
            $table->tinyInteger('is_deleted')->default('0')->comment('0 - Not Deleted, 1 - Deleted');
            $table->integer('created_by');
            $table->integer('modified_by');
            $table->timestamps();

            $table->foreign('lead_id')->references('id')->on('leads');
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
        Schema::dropIfExists('web_sales_forms');
    }
}
