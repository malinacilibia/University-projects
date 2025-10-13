@extends('layouts.app')

@section('title', 'Add Event')

@section('content')
    <div class="container mt-4">
        <form action="{{ route('events.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Event Name</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="event_date" class="form-label">Event Date</label>
                <input type="datetime-local" name="event_date" id="event_date" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" id="description" class="form-control"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Save Event</button>
        </form>
    </div>
@endsection
