@extends('layouts.app')

@section('title', 'Add New Member')

@section('content')
    <div class="form-container">
        <form action="{{ route('members.store') }}" method="POST" class="styled-form">
            @csrf
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="name" required class="form-control">
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" required class="form-control">
            </div>

            <div class="form-group">
                <label for="profession">Profession:</label>
                <input type="text" name="profession" required class="form-control">
            </div>

            <div class="form-group">
                <label for="company">Company:</label>
                <input type="text" name="company" class="form-control">
            </div>

            <div class="form-group">
                <label for="linkedin_url">LinkedIn URL:</label>
                <input type="url" name="linkedin_url" value="{{ old('linkedin_url') }}" class="form-control">
            </div>

            <div class="form-group">
                <label for="status">Status:</label>
                <select name="status" class="form-control">
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Save Member</button>
        </form>
    </div>
@endsection
