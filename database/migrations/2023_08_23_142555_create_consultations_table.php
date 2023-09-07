<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsultationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consultations_table', function (Blueprint $table) {
            $table->id();
            $table->string('UserId');
            $table->string('Name');
            $table->string('Contact');
            $table->string('Age');
            $table->string('Area');
            $table->string('Service');
            $table->string('Fee');
            $table->string('Question');
            $table->string('Reply');
            $table->string('FeedBack');
            $table->string('Holder1');
            $table->string('Holder2');
            $table->string('Holder3');
            $table->string('Holder4');
            $table->string('Holder5');
            $table->string('Holder6');
            $table->string('Holder7');
            $table->string('Holder8');
            $table->string('Holder9');
            $table->string('Holder10');

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
        Schema::dropIfExists('consultations_table');
    }
}
