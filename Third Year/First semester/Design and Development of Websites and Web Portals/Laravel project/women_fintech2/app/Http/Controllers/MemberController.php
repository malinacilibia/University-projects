<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;

class MemberController extends Controller
{
    /**
     * Afișează lista resurselor (membrii).
     */
    public function index(Request $request)
    {
        // Construiește o interogare pentru filtrare și căutare
        $query = Member::query(); // Pornim cu un query de bază pe modelul Member

        // Filtrare după nume sau email dacă există un parametru `search` în cerere
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%')
                ->orWhere('email', 'like', '%' . $request->search . '%');
        }

        // Filtrare după profesie dacă există un parametru `profession`
        if ($request->filled('profession')) {
            $query->where('profession', $request->profession); // Adaugă condiția de filtrare pentru profesie

        }

        // Filtrare după companie dacă există un parametru `company`
        if ($request->filled('company')) {
            $query->where('company', $request->company); // Adaugă condiția de filtrare pentru companie
        }

        // Filtrare după status (active/inactive) dacă există un parametru `status`
        if ($request->filled('status')) {
            $query->where('status', $request->status);// Adaugă condiția de filtrare pentru status
        }

        // Paginație: returnează 10 membri pe pagină
        $members = $query->paginate(10);

        // Returnează view-ul `members.index` împreună cu lista paginată de membri
        return view('members.index', compact('members'));
    }

    /**
     * Afișează formularul pentru crearea unui membru nou.
     */
    public function create()
    {
        return view('members.create');
    }

    /**
     * Salvează un membru nou în baza de date.
     */
    public function store(Request $request)
    {
        // Validează datele introduse în formular
        $request->validate([
            'name' => 'required|max:255', // numele este obligatoriu
            'email' => 'required|email|unique:members|max:255', // email valid și unic
            'profession' => 'required|max:255', // profesie obligatorie
            'linkedin_url' => 'nullable|url|max:255', // linkedin url valid (opțional)
        ]);

        // Creează un nou membru și salvează-l în baza de date
        Member::create($request->all());

        // Redirecționează utilizatorul înapoi la lista de membri
        return redirect()->route('members.index')->with('success', 'Member added successfully!');
    }

    /**
     * Afișează un membru specific (opțional, dacă e necesar).
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Afișează formularul pentru editarea unui membru existent.
     */
    public function edit($id)
    {
        // Găsește membrul după ID
        $member = Member::findOrFail($id);

        // Returnează view-ul pentru editare
        return view('members.edit', compact('member'));
    }

    /**
     * Actualizează un membru existent în baza de date.
     */
    public function update(Request $request, $id)
    {
        // Validează datele primite din formular
        $request->validate([
            'name' => 'required|max:255', // numele este obligatoriu
            'email' => 'required|email|unique:members,email,' . $id . '|max:255', // email valid și unic
            'profession' => 'required|max:255', // profesie obligatorie
            'linkedin_url' => 'nullable|url|max:255', // linkedin url valid (opțional)
        ]);

        // Găsește membrul după ID și actualizează datele
        $member = Member::findOrFail($id);
        $member->update($request->all());

        // Redirecționează utilizatorul înapoi la lista de membri
        return redirect()->route('members.index')->with('success', 'Member updated successfully!');
    }

    /**
     * Șterge un membru din baza de date.
     */
    public function destroy($id)
    {
        // Găsește membrul după ID
        $member = Member::findOrFail($id);

        // Șterge membrul
        $member->delete();

        // Redirecționează utilizatorul înapoi la lista de membri
        return redirect()->route('members.index')->with('success', 'Member deleted successfully!');
    }

    /**
     * Exportă lista membrilor în format CSV.
     */
    public function downloadCsv()
    {
        // Extrage toți membrii din baza de date
        $members = Member::all();

        // Numele fișierului CSV
        $fileName = 'members.csv';

        // Setează antetele pentru fișierul CSV
        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0",
        ];

        // Setează coloanele fișierului CSV
        $columns = ['Name', 'Email', 'Profession', 'Company', 'Status'];

        // Crează un callback pentru a genera fișierul CSV
        $callback = function () use ($members, $columns) {
            $file = fopen('php://output', 'w'); // deschide un flux pentru output
            fputcsv($file, $columns); // adaugă rândul de antet

            // Iterează prin lista membrilor și adaugă fiecare rând în CSV
            foreach ($members as $member) {
                $row = [
                    $member->name,
                    $member->email,
                    $member->profession,
                    $member->company,
                    $member->status,
                ];
                fputcsv($file, $row);
            }

            fclose($file); // închide fluxul
        };

        // Returnează fișierul CSV ca răspuns
        return response()->stream($callback, 200, $headers);
    }
}
