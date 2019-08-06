<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDirectDebitFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('direct_debit_forms', function (Blueprint $table) {
            $table->increments('id');
            $table->string('header_business_name')->nullable();
            $table->string('header_state')->nullable();
            $table->string('header_ref_no')->nullable();
            $table->string('header_staff_ref')->nullable();
            $table->tinyInteger('header_customer_req')->comment('0-New Customer,1-Renewal of existing customer ,2-change of details');

            $table->string('main_company_name')->nullable();
            $table->string('main_customer_name')->nullable();
            $table->string('main_customer_surname')->nullable();
            $table->date('main_customer_dob')->nullable();
            $table->date('main_customer_driver_licence_no')->nullable();
            $table->string('main_customer_address_line_1')->nullable();
            $table->string('main_customer_suburb')->nullable();
            $table->string('main_customer_state')->nullable();
            $table->string('main_customer_postcode')->nullable();
            $table->string('main_customer_email')->nullable();
            $table->string('main_customer_contact_home')->nullable();
            $table->string('main_customer_contact_work')->nullable();
            $table->string('main_customer_contact_mobile')->nullable();

            $table->string('payment_details_regular_debit_amt')->nullable();
            $table->date('payment_details_commencing_on')->nullable();
            $table->string('payment_details_until_further_notice')->nullable();
            $table->string('payment_details_for_payments')->nullable();
            $table->string('payment_details_contract_value')->nullable();

            $table->string('payment_details_plus_approp')->nullable()->comment('1-weekly,2-fortnightly,3-monthly,4-quarterly');

            $table->string('payment_details_variation_amt')->nullable();
            $table->text('payment_details_special_condition')->nullable();

            $table->string('direct_debit_bank_bank_name')->nullable();
            $table->string('direct_debit_bank_branch_account')->nullable();
            $table->string('direct_debit_bank_bsb_number')->nullable();
            $table->string('direct_debit_bank_account_number')->nullable();
            $table->string('direct_debit_bank_account_holder_name')->nullable();
            $table->string('direct_debit_bank_account_holder_surname')->nullable();
            $table->string('direct_debit_bank_verified_by')->nullable();


            $table->string('debit_credit_card_card_type')->nullable()->comment('1-Visa,2-Mastercard,3-Amex,4-Diners');
            $table->string('debit_credit_card_name')->nullable();
            $table->string('debit_credit_card_surname')->nullable();
            $table->string('debit_credit_card_number')->nullable();
            $table->string('debit_credit_card_expiry_date')->nullable();

            $table->text('authorisation_signature_first');
            $table->text('authorisation_signature_second')->nullable();
            $table->date('authorisation_date')->nullable();

            $table->string('commission')->nullable();

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
        Schema::dropIfExists('direct_debit_forms');
    }
}
