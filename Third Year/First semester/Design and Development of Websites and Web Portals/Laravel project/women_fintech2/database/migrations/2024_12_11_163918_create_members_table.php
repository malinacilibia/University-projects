<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) // creem un tabel nou
        {
            $table->id(); //cheie primara
            $table->string('name'); //coloana text(varchar) pt nume
            $table->string('email')->unique(); //coloana text pt email unic
            $table->string('profession'); //coloana text pt profesia membrului, obligatorie
            $table->string('company')->nullable(); //coloana text pt compania membrului, optionala
            $table->string('linkedin_url')->nullable(); //coloana text pt linkedin
            $table->enum('status', ['active', 'inactive'])->default('active'); //coloana enum(valori predefinite) care poate avea valorile active inactive
            $table->timestamps();//doua coloane speciale, created_at si updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('members'); // sterge tabelul members daca exista
    }
}
