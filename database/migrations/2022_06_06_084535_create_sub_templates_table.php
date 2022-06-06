<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubTemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_templates', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('template_id');
            $table->foreign('template_id')->references('id')->on('templates');
            $table->integer('sort_section');
            $table->text('section_code');
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
        Schema::dropIfExists('sub_templates');
    }
}
