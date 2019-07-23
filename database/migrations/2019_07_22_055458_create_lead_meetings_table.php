<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeadMeetingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lead_meetings', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('lead_id');
            $table->unsignedBigInteger('sales_person_id');
            $table->string('subject')->nullable();
            $table->text('body')->nullable();
            $table->date('meeting_at')->nullable();
            $table->string('meeting_time')->nullable();
            $table->tinyInteger('meeting_status')->default('0')->comment('0 - Pending,1 - Done,2 - Cancelled');
            $table->text('meeting_summary')->nullable();

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
        Schema::dropIfExists('lead_meetings');
    }
}
