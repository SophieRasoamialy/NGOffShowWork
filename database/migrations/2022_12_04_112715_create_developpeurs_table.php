<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Query\Expression;


class CreateDeveloppeursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('developpeurs', function (Blueprint $table) {
            $table->id(); 
            $table->unsignedBigInteger('user_id');
            $table->string('developpeur_a_propos')->default("");
            $table->json('developpeur_competence')->default(new Expression('(JSON_ARRAY())'));
            $table->json('developpeur_experience')->default(new Expression('(JSON_ARRAY())'));
            $table->json('developpeur_education')->default(new Expression('(JSON_ARRAY())'));
            $table->json('developpeur_qualification')->default(new Expression('(JSON_ARRAY())'));
            $table->string('developpeur_contact');
            $table->boolean('premium')->default(false);
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('developpeurs');
    }
}
