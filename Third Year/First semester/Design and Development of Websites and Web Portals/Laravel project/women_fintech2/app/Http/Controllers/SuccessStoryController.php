<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\SuccessStory;
use Illuminate\Http\Request;

class SuccessStoryController extends Controller
{
    // afișează lista poveștilor de succes pentru un membru specific
    public function index(Member $member)
    {
        // obține toate poveștile de succes asociate membrului
        $stories = $member->successStories;

        // returnează view-ul cu lista poveștilor de succes
        return view('success_stories.index', compact('member', 'stories'));
    }

    // afișează formularul pentru crearea unei noi povești de succes
    public function create(Member $member)
    {
        // returnează view-ul pentru adăugarea unei povești de succes
        return view('success_stories.create', compact('member'));
    }

    // salvează o nouă poveste de succes în baza de date
    public function store(Request $request, Member $member)
    {
        // validează datele primite din formular
        $request->validate([
            'title' => 'required', // titlul este obligatoriu
            'story' => 'required', // povestea este obligatorie
        ]);

        // creează povestea de succes și o asociază cu membrul
        $member->successStories()->create($request->all());

        // redirecționează utilizatorul înapoi la lista poveștilor de succes
        return redirect()->route('success_stories.index', $member)
            ->with('success', 'Success story added successfully!');
    }

    // afișează formularul pentru editarea unei povești de succes
    public function edit($memberId, $successStoryId)
    {
        // găsește povestea de succes după ID
        $successStory = SuccessStory::findOrFail($successStoryId);

        // returnează view-ul pentru editarea poveștii
        return view('success_stories.edit', compact('successStory', 'memberId'));
    }

    // actualizează o poveste de succes existentă în baza de date
    public function update(Request $request, $memberId, $successStoryId)
    {
        // validează datele primite din formular
        $request->validate([
            'title' => 'required|max:255', // titlul este obligatoriu și are max. 255 caractere
            'story' => 'required', // povestea este obligatorie
        ]);

        // găsește povestea de succes după ID și o actualizează
        $successStory = SuccessStory::findOrFail($successStoryId);
        $successStory->update($request->all());

        // redirecționează utilizatorul înapoi la lista poveștilor de succes
        return redirect()->route('success_stories.index', ['member' => $memberId])
            ->with('success', 'Success story updated successfully!');
    }

    // șterge o poveste de succes din baza de date
    public function destroy($memberId, $successStoryId)
    {
        // găsește povestea de succes după ID și o șterge
        $successStory = SuccessStory::findOrFail($successStoryId);
        $successStory->delete();

        // redirecționează utilizatorul înapoi la lista poveștilor de succes
        return redirect()->route('success_stories.index', ['member' => $memberId])
            ->with('success', 'Success story deleted successfully!');
    }
}
