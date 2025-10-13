@extends('layouts.app')

@section('title', 'Edit Success Story')

@section('content')
    <div class="container mt-4">
        <h2>Edit Success Story</h2>

        <form action="{{ route('success_stories.update', ['member' => $memberId, 'success_story' => $successStory->id]) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" name="title" id="title" value="{{ $successStory->title }}" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="story" class="form-label">Story</label>
                <textarea name="story" id="story" rows="5" class="form-control" required>{{ $successStory->story }}</textarea>
            </div>

            <button type="submit" class="btn btn-success">Update Story</button>
        </form>
    </div>
@endsection
