<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResolvedComplaintsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resolved_complaints', function (Blueprint $table) {
             $table->id();
            $table->string('tracking_code')->unique();
            $table->string('name');
            $table->string('phone_number', 20);
            $table->string('email');
            $table->string('gender');
            $table->string('complaint_status');
            $table->string('complaint');
            $table->string('address');
            $table->string('state')->nullable();
            $table->string('country');
            $table->string('complaint_type');
            $table->string('staff_assigned');
            $table->string('user_id');
            $table->string('affidavit');
            $table->string('passport');
            $table->string('others');
            $table->string('month');
            $table->string('year');
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
        Schema::dropIfExists('resolved_comlplaints');
    }
}
