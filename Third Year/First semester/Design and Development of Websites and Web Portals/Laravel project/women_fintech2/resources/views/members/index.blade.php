@extends('layouts.app')

<!-- Setează titlul paginii -->
@section('title', 'Members List')

<!-- Include stiluri personalizate dintr-un fișier CSS extern -->
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
@endpush

@section('content')

    <div class="container mt-4">

        <!-- Form pentru filtre -->
        <div class="card">
            <div class="card-body">
                <!-- Formularul este trimis folosind metoda GET pentru a aplica filtre -->
                <!-- Acțiunea formularului este legată de ruta `members.index` -->
                <!-- Valorile filtrelor sunt transmise prin URL ca parametri GET -->
                <form method="GET" action="{{ route('members.index') }}" class="row">
                    <!-- Căutare după profesie -->
                    <div class="col-md-3 mb-3">
                        <label for="profession" class="form-label">Profession</label>
                        <input type="text" name="profession" id="profession" value="{{ request('profession') }}" placeholder="Profession" class="form-control">
                        <!-- Valoarea este preluată din cererea curentă (`request('profession')`) pentru persistența filtrului -->
                    </div>

                    <!-- Căutare după companie -->
                    <div class="col-md-3 mb-3">
                        <label for="company" class="form-label">Company</label>
                        <input type="text" name="company" id="company" value="{{ request('company') }}" placeholder="Company" class="form-control">
                        <!-- Valoarea este preluată din cererea curentă (`request('company')`) pentru persistența filtrului -->
                    </div>

                    <!-- Filtrare după status -->
                    <div class="col-md-3 mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select name="status" id="status" class="form-select">
                            <option value="">All Status</option>
                            <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>

                    <!-- Butoane pentru aplicarea și resetarea filtrelor -->
                    <div class="col-md-3 d-flex align-items-end">
                        <!-- Trimite filtrele aplicate -->
                        <button type="submit" class="btn btn-secondary me-2">Filter</button>
                        <!-- Resetează filtrele -->
                        <a href="{{ route('members.index') }}" class="btn btn-light">Reset</a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Tabel Membri -->
        @if ($members->isEmpty())
            <!-- Afișează mesaj dacă nu există membri -->
            <p class="alert alert-warning mt-4">No members found.</p>
        @else
            <table class="table table-bordered table-striped mt-4">
                <thead class="table-dark">
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Profession</th>
                    <th>Company</th>
                    <th>LinkedIn</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($members as $member)
                    <!-- Iterăm prin lista membrilor și afișăm fiecare membru -->
                    <tr>
                        <!-- Afișează informațiile despre membri -->
                        <td>{{ $member->name }}</td>
                        <td>{{ $member->email }}</td>
                        <td>{{ $member->profession }}</td>
                        <td>{{ $member->company }}</td>
                        <td>
                            <!-- Verifică dacă membrul are un profil LinkedIn -->
                            @if ($member->linkedin_url)
                                <!-- Afișează un link către profilul LinkedIn -->
                                <a href="{{ $member->linkedin_url }}" target="_blank" class="btn btn-link">View Profile</a>
                            @else
                                N/A
                            @endif
                        </td>
                        <td>
                            <!-- Afișează statusul membrului cu un stil diferit folosind Bootsrap -->
                            <span class="badge bg-{{ $member->status === 'active' ? 'success' : 'secondary' }}">
                                {{ ucfirst($member->status) }} <!-- Afișează statusul cu prima literă mare -->
                            </span>
                        </td>
                        <td>
                            <!-- Buton pentru a vedea poveștile de succes -->
                            <a href="{{ route('success_stories.index', $member->id) }}" class="btn btn-info btn-sm">Success Stories</a>
                            <!-- Buton pentru editarea membrului -->
                            <a href="{{ route('members.edit', $member->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <!-- Formular pentru ștergerea membrului -->
                            <form action="{{ route('members.destroy', $member->id) }}" method="POST" style="display:inline;"
                                  onsubmit="return confirm('Are you sure you want to delete this member?');">
                                @csrf <!-- Token CSRF pentru securitate -->
                                @method('DELETE') <!-- Metodă DELETE pentru ștergere -->
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
        <!-- Buton pentru descărcarea unui CSV -->
        <a href="{{ route('members.download.csv') }}" class="btn btn-success">Download CSV</a>

        <!-- Paginare -->
        <div class="mt-3">
            {{ $members->links('pagination::bootstrap-4') }}
        </div>

    </div>

@endsection
