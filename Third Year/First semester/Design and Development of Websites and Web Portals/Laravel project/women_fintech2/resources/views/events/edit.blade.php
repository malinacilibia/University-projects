@extends('layouts.app')

@section('title', 'Events')

@section('content')
<form action="{{ route('events.update', $event->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="name" class="form-label">Event Name</label>
        <input type="text" name="name" id="name" class="form-control" value="{{ $event->name }}" required>
    </div>
    <div class="mb-3">
        <label for="event_date" class="form-label">Event Date</label>
        <input type="datetime-local" name="event_date" id="event_date" class="form-control" value="{{ $event->event_date->format('Y-m-d\TH:i') }}" required>
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea name="description" id="description" class="form-control">{{ $event->description }}</textarea>
    </div>
    <button type="submit" class="btn btn-success">Update Event</button>
    <a href="{{ route('events.index') }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection

