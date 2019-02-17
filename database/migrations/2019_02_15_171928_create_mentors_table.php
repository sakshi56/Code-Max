<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMentorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mentors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('designation');
            $table->string('company');
            $table->string('ph_no');
            $table->string('email');
            $table->string('address');
            $table->timestamps();
        });
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->string('evt_name');
            $table->string('org_startup_id');
            $table->string('prt_strtup_id');
            $table->string('status');
            $table->timestamps();
        });
        Schema::create('complaints', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cp_cat_id');
            $table->string('cp_stmnt');
            $table->string('strtup_id');
            $table->string('status');
            $table->timestamps();
        });
        Schema::create('cmplt_cat', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cat_name');
            $table->timestamps();
        });
        Schema::create('startups', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('ph_no');
            $table->string('email');
            $table->string('ceo_id');
            $table->string('documents');
            $table->string('status');
            $table->timestamps();
        });
        Schema::create('strtup_task', function (Blueprint $table) {
            $table->increments('id');
            $table->string('task_name');
            $table->string('strtup_id');
            $table->string('status');
            $table->timestamps();
        });
        Schema::create('strtup_milestone', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ms_name');
            $table->string('strtup_id');
            $table->string('status');
            $table->timestamps();
        });
        Schema::create('mntr_strtup', function (Blueprint $table) {
            $table->increments('id');
            $table->string('mntr_id');
            $table->string('strtup_id');
            $table->string('status');
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
        Schema::dropIfExists('mentors');
    }
}
