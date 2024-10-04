@extends('home')

@section('dashboard-content')
<div class="container">
    <h2>Create New Family Member</h2>

    <form action="{{ route('families.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="relationship">Relationship</label>
            <input type="text" name="relationship" id="relationship" class="form-control" value="{{ old('relationship') }}" required>
            @error('relationship') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="date_of_birth">Date of Birth</label>
            <input type="date" name="date_of_birth" id="date_of_birth" class="form-control" value="{{ old('date_of_birth') }}" required>
            @error('date_of_birth') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="user_id">User</label>
            <select name="user_id" id="user_id" class="form-control" required>
                <option value="">Select a User</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
            @error('user_id') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group mt-3">
            <button type="submit" class="btn btn-primary">Create Family Member</button>
        </div>
    </form>
</div>
@endsection
    