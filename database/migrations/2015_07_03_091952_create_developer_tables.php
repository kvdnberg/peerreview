<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeveloperTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type');
            $table->timestamps();
        });

        DB::table('types')->insert(
            array(
                'type' => 'Frontend Developer',
            )
        );
        DB::table('types')->insert(
            array(
                'type' => 'Backend Developer',
            )
        );

        Schema::create('developers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('type_id')->unsigned();
            $table->string('firstName');
            $table->string('middleName');
            $table->string('lastName');
            $table->string('gitHubHandle');
            $table->timestamps();

            $table->foreign('type_id')
                ->references('id')
                ->on('types');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('developers');
        Schema::drop('types');

    }
}
