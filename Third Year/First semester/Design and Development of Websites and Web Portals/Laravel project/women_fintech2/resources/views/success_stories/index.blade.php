@extends('layouts.app')

@section('content')
    <!-- titlul paginii afișează poveștile de succes ale unui membru -->
    <h2>Success Stories for {{ $member->name }}</h2>

    <!-- buton pentru a adăuga o nouă poveste de succes -->
    <a href="{{ route('success_stories.create', $member->id) }}" class="btn-add-story">Add Success Story</a>

    @if ($stories->isEmpty())
        <!-- mesaj afișat dacă nu există povești de succes -->
        <p style="text-align: center; color: #6a1b9a;">No success stories found.</p>
    @else
        @foreach ($stories as $story)
            <!-- card care afișează o poveste de succes -->
            <div class="success-story-card" style="padding: 15px; border: 1px solid #ddd; border-radius: 5px; margin-bottom: 100px; background-color: #fff; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); position: relative;">
                <!-- titlul poveștii -->
                <h3>{{ $story->title }}</h3>
                <!-- conținutul poveștii -->
                <p>{{ $story->story }}</p>
                <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 10px;">
                    <!-- buton pentru editarea poveștii -->
                    <a href="{{ route('success_stories.edit', ['member' => $member->id, 'success_story' => $story->id]) }}"
                       class="btn btn-primary btn-sm" style="flex: 1; margin-right: 5px; text-align: center;">Edit</a>

                    <!-- formular pentru ștergerea poveștii -->
                    <form action="{{ route('success_stories.destroy', ['member' => $member->id, 'success_story' => $story->id]) }}"
                          method="POST" style="flex: 1; margin-left: 5px;"
                          onsubmit="return confirm('Are you sure you want to delete this success story?');">
                        @csrf <!-- token CSRF pentru securitate -->
                        @method('DELETE') <!-- specifică metoda DELETE pentru ștergere -->
                        <!-- buton pentru ștergerea poveștii -->
                        <button type="submit" class="btn btn-danger btn-sm" style="width: 100%; text-align: center;">Delete</button>
                    </form>
                </div>
            </div>
        @endforeach
    @endif
@endsection
