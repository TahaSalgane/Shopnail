@extends('home')

@section('dashboard-content')
<div class="container">
    <h2>Edit Family Member</h2>

    <form action="{{ route('families.update', $family->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $family->name }}" required>
            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="relationship">Relationship</label>
            <input type="text" name="relationship" id="relationship" class="form-control" value="{{ $family->relationship }}" required>
            @error('relationship') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="date_of_birth">Date of Birth</label>
            <input type="date" name="date_of_birth" id="date_of_birth" class="form-control" value="{{ $family->date_of_birth }}" required>
            @error('date_of_birth') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="user_id">User</label>
            <select name="user_id" id="user_id" class="form-control" required>
                <option value="">Select a User</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}" {{ $user->id == $family->user_id ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
            @error('user_id') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group mt-3">
            <button type="submit" class="btn btn-primary">Update Family Member</button>
        </div>
    </form>
</div>
@endsection
