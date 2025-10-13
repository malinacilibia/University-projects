<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuccessStoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('success_stories', function (Blueprint $table) { //creem tabelul success stories
            $table->id(); //cheie primara, autoincrement
            $table->string('title'); //titlul(tip varchar), obligatoriu
            $table->text('story'); //povestea(tip varchar), obligatorie
            $table->foreignId('member_id')->constrained('members')->onDelete('cascade');
            //coloana care reprezinta o cheie straina pt tabelul members, leaga member_id de id din members
            //daca un membru este sters, toate povestile lui vor fi sterse
            $table->timestamps(); // doua coloane speciale, created_at si updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() //sterge tabelul success_stories daca exista
    {
        Schema::dropIfExists('success_stories');
    }
}
