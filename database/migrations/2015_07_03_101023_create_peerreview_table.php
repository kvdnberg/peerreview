<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePeerreviewTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peerreview', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('reviewer_id')->unsigned();
            $table->integer('author_id')->unsigned();
            $table->timestamps();

            $table->foreign('reviewer_id')
                ->references('id')
                ->on('developers');

            $table->foreign('author_id')
                ->references('id')
                ->on('developers');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('peerreview');
    }
}
