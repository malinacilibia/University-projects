@extends('layouts.app')

@section('title', 'Events')

@section('content')
    <!-- container pentru listarea evenimentelor -->
    <div class="containers mt-4">
        <!-- buton pentru adăugarea unui eveniment nou -->
        <div class="d-flex justify-content-center mb-4">
            <a href="{{ route('events.create') }}" class="btn btn-primary" style="display: block; margin: 0 auto; margin-bottom: 20px; text-align: center;">Add New Event</a>
        </div>

        @if ($events->isEmpty())
            <!-- mesaj afișat dacă nu există evenimente -->
            <p class="alert alert-warning">No events found.</p>
        @else
            <!-- tabel care afișează evenimentele -->
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                <tr>
                    <th>Name</th> <!-- coloana pentru numele evenimentului -->
                    <th>Date</th> <!-- coloana pentru data evenimentului -->
                    <th>Description</th> <!-- coloana pentru descrierea evenimentului -->
                    <th>Actions</th> <!-- coloana pentru acțiuni (editare/ștergere) -->
                </tr>
                </thead>
                <tbody>
                @foreach ($events as $event)
                    <tr>
                        <!-- afișează numele evenimentului -->
                        <td>{{ $event->name }}</td>
                        <!-- afișează data evenimentului, formatată -->
                        <td>{{ $event->event_date->format('d-m-Y H:i') }}</td>
                        <!-- afișează descrierea evenimentului -->
                        <td>{{ $event->description }}</td>
                        <td>
                            <!-- buton pentru editarea evenimentului -->
                            <a href="{{ route('events.edit', $event->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <!-- formular pentru ștergerea evenimentului -->
                            <form action="{{ route('events.destroy', $event->id) }}" method="POST" style="display:inline;"
                                  onsubmit="return confirm('Are you sure you want to delete this event?');">
                                @csrf <!-- token CSRF pentru securitate -->
                                @method('DELETE') <!-- specifică metoda DELETE pentru ștergere -->
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <!-- afișează navigarea pentru paginare -->
            <div class="mt-3">
                {{ $events->links('pagination::bootstrap-4') }}
            </div>
        @endif
    </div>
@endsection
