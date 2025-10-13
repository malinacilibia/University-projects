@extends('layouts.app')

@section('content')

    <form action="{{ route('success_stories.store', $member->id) }}" method="POST">
        @csrf
        <div>
            <label for="title">Title:</label>
            <input type="text" name="title" id="title" required>
        </div>
        <div>
            <label for="story">Story:</label>
            <textarea name="story" id="story" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Add Story</button>
    </form>
@endsection
