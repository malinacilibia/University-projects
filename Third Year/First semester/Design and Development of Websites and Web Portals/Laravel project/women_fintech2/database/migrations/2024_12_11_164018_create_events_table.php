<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) //creem tabelul events
        {
            $table->id(); // cheie primara autoincrement
            $table->string('name'); //coloana(varchar) pt numele evenimentului
            $table->dateTime('event_date'); //coloana de tip datetime pt ora si data
            $table->text('description'); //coloana text (varchar)
            $table->timestamps(); // creeaza coloane speciale created_at si updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
}
