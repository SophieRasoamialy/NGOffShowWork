<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projets', function (Blueprint $table) {
            $table->unsignedBigInteger('projet_id')->autoIncrement();
            $table->unsignedBigInteger('categorie_id');
            $table->string('projet_titre');
            $table->text('projet_description');
            $table->integer('projet_budget');
            $table->integer('projet_duree');
            $table->timestamp('projet_date_fin');
            $table->boolean('projet_proclame')->default(false);
            $table->timestamps();
            $table->unsignedBigInteger('created_by');
            $table->foreign('categorie_id')->references('categorie_id')->on('categories')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projets');
    }
}
