@extends('layouts.app')

@section('title', 'Edit Member')

@section('content')
    <div class="form-container">
        <form action="{{ route('members.update', $member->id) }}" method="POST" class="styled-form">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="name" value="{{ $member->name }}" required class="form-control">
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" value="{{ $member->email }}" required class="form-control">
            </div>

            <div class="form-group">
                <label for="profession">Profession:</label>
                <input type="text" name="profession" value="{{ $member->profession }}" required class="form-control">
            </div>

            <div class="form-group">
                <label for="company">Company:</label>
                <input type="text" name="company" value="{{ $member->company }}" class="form-control">
            </div>

            <div class="form-group">
                <label for="linkedin_url">LinkedIn URL:</label>
                <input type="url" name="linkedin_url" value="{{ old('linkedin_url', $member->linkedin_url) }}" class="form-control">
            </div>

            <div class="form-group">
                <label for="status">Status:</label>
                <select name="status" class="form-control">
                    <option value="active" {{ $member->status == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ $member->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Update Member</button>
        </form>
    </div>
@endsection
