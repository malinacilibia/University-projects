<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [ //definim care coloane din tabela events pot fi completate
        'name',
        'event_date',
        'description',
        //permitem actualizarea numelui, datei s descrierea evenimentului
    ];

    // Cast event_date la un obiect DateTime
    protected $casts = [
        'event_date' => 'datetime', //coloana event_date va fi convertita automat intr un obiect DateTime
    ];
}
