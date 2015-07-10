<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeveloperskillsAndLevelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('skills', function (Blueprint $table) {
            $table->increments('id');
            $table->string('skill');
            $table->timestamps();
        });
        Schema::create('levels', function (Blueprint $table) {
            $table->increments('id');
            $table->string('level');
            $table->timestamps();
        });

        DB::table('levels')->insert(
            array(
                'level' => 'Stagair',
            )
        );
        DB::table('levels')->insert(
            array(
                'level' => 'Junior',
            )
        );
        DB::table('levels')->insert(
            array(
                'level' => 'Medior',
            )
        );
        DB::table('levels')->insert(
            array(
                'level' => 'Senior',
            )
        );

        DB::table('skills')->insert(
            array(
                'skill' => 'Node.js',
            )
        );
        DB::table('skills')->insert(
            array(
                'skill' => 'Laravel',
            )
        );

        Schema::create('developer_level', function (Blueprint $table) {
            $table->integer('developer_id')->unsigned()->index();
            $table->integer('level_id')->unsigned()->index();

            $table->foreign('level_id')->references('id')->on('levels')->onDelete('cascade');
            $table->foreign('developer_id')->references('id')->on('developers')->onDelete('cascade');
        });

        Schema::create('developer_skill', function (Blueprint $table) {
            $table->integer('developer_id')->unsigned();
            $table->integer('skill_id')->unsigned();

            $table->foreign('skill_id')->references('id')->on('skills')->onDelete('cascade');
            $table->foreign('developer_id')->references('id')->on('developers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('developer_skill');
        Schema::drop('skills');
        Schema::drop('developer_level');
        Schema::drop('levels');
    }
}
