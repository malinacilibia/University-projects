<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
{
    // afiseaza lista de evenimente
    public function index()
    {
        // preia toate evenimentele din baza de date, ordonate crescator dupa data
        $events = Event::orderBy('event_date', 'asc')->paginate(10);

        // returneaza view-ul pentru lista de evenimente si trimite variabila $events catre el
        return view('events.index', compact('events'));
    }

    // afiseaza formularul pentru crearea unui eveniment nou
    public function create()
    {
        // returneaza view-ul pentru crearea unui eveniment
        return view('events.create');
    }

    // salveaza un nou eveniment in baza de date
    public function store(Request $request)
    {
        // valideaza datele primite din formular
        $request->validate([
            'name' => 'required|string|max:255', // numele este obligatoriu si trebuie sa fie un string cu max 255 caractere
            'event_date' => 'required|date', // data evenimentului este obligatorie si trebuie sa fie in format de data
            'description' => 'nullable|string', // descrierea este optionala, dar daca exista trebuie sa fie un string
        ]);

        // creeaza un nou eveniment si il salveaza in baza de date
        Event::create($request->all());

        // redirectioneaza utilizatorul inapoi la lista de evenimente cu un mesaj de succes
        return redirect()->route('events.index')->with('success', 'Event added successfully!');
    }

    // afiseaza formularul pentru editarea unui eveniment existent
    public function edit(Event $event)
    {
        // returneaza view-ul pentru editarea unui eveniment si trimite evenimentul catre view
        return view('events.edit', compact('event'));
    }

    // actualizeaza un eveniment existent in baza de date
    public function update(Request $request, Event $event)
    {
        // valideaza datele primite din formular
        $request->validate([
            'name' => 'required|string|max:255',  // numele este obligatoriu si trebuie sa fie un string cu max 255 caractere
            'event_date' => 'required|date', // data evenimentului este obligatorie si trebuie sa fie in format de data
            'description' => 'nullable|string',  // descrierea este optionala, dar daca exista trebuie sa fie un string
        ]);

        // actualizeaza evenimentul cu datele primite
        $event->update($request->all());

        // redirectioneaza utilizatorul inapoi la lista de evenimente cu un mesaj de succes
        return redirect()->route('events.index')->with('success', 'Event updated successfully!');
    }

    // sterge un eveniment din baza de date
    public function destroy(Event $event)
    {
        // sterge evenimentul din baza de date
        $event->delete();

        // redirectioneaza utilizatorul inapoi la lista de evenimente cu un mesaj de succes
        return redirect()->route('events.index')->with('success', 'Event deleted successfully!');
    }
}
