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
        Schema::create('developer_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type');
            $table->timestamps();
        });

        DB::table('developer_types')->insert(
            array(
                'type' => 'Frontend Developer',
            )
        );
        DB::table('developer_types')->insert(
            array(
                'type' => 'Backend Developer',
            )
        );

        Schema::create('developers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('developer_type_id')->unsigned();
            $table->string('firstName');
            $table->string('middleName');
            $table->string('lastName');
            $table->string('gitHubHandle');
            $table->timestamps();

            $table->foreign('developer_type_id')
                ->references('id')
                ->on('developer_types');

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
        Schema::drop('developer_types');

    }
}
