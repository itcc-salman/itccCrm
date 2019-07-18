<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDigitalSalesFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('digital_sales_forms', function (Blueprint $table) {
            $table->increments('id');
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
            $table->string('project_minimum_agreed_term')->nullable();
            $table->string('project_amount')->nullable();
            $table->string('project_services')->nullable()->comment('1-SEO,2-googleAdwords,3-Re-Marketing,4-SocialMedia');

            $table->string('payment_method')->comment('1-bank cheque,2-cash,3-direct debit,4-credit card,5-via bank');
            $table->string('authorisation_client_name')->nullable();
            $table->string('authorisation_bdm')->nullable()->comment('it is sales person only');
            $table->string('authorisation_date')->nullable();
            $table->text('authorisation_signature')->nullable();

            $table->string('office_use_only_accepted_by')->nullable();
            $table->string('office_use_only_project_manager')->nullable();

            $table->tinyInteger('status')->default('0')->comment('Active - 0, Deactive - 1');
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
        Schema::dropIfExists('digital_sales_forms');
    }
}
