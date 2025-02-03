<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompetenceRequisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('competence_requises', function (Blueprint $table) {
            $table->id(); 
            $table->unsignedBigInteger('competence_id');
            $table->foreign('competence_id')->references('competence_id')->on('competences')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('categorie_id');
            $table->foreign('categorie_id')->references('categorie_id')->on('categories')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('competence_requises');
    }
}
