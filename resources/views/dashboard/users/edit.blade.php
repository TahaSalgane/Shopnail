@extends('home')

@section('dashboard-content')
<div class="container">
    <h2>Edit User</h2>

    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}" required>
            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ $user->email }}" required>
            @error('email') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="phone">Phone</label>
            <input type="text" name="phone" id="phone" class="form-control" value="{{ $user->phone }}" required>
            @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="date_of_birth">Date of Birth</label>
            <input type="date" name="date_of_birth" id="date_of_birth" class="form-control" value="{{ $user->date_of_birth }}" required>
            @error('date_of_birth') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <h4>Family Members</h4>

        <div id="family-members">
            @foreach ($user->familyMembers as $index => $family)
                <div class="family-member">
                    <div class="form-group">
                        <label for="family[{{ $index }}][name]">Name</label>
                        <input type="text" name="family[{{ $index }}][name]" class="form-control" value="{{ $family->name }}" required>
                    </div>

                    <div class="form-group">
                        <label for="family[{{ $index }}][relationship]">Relationship</label>
                        <input type="text" name="family[{{ $index }}][relationship]" class="form-control" value="{{ $family->relationship }}" required>
                    </div>

                    <div class="form-group">
                        <label for="family[{{ $index }}][date_of_birth]">Date of Birth</label>
                        <input type="date" name="family[{{ $index }}][date_of_birth]" class="form-control" value="{{ $family->date_of_birth }}" required>
                    </div>
                </div>
            @endforeach
        </div>

        <button type="button" id="add-family-member" class="btn btn-secondary mt-2">Add Family Member</button>

        <div class="form-group mt-3">
            <button type="submit" class="btn btn-primary">Update User</button>
        </div>
    </form>
</div>

<script>
    document.getElementById('add-family-member').addEventListener('click', function() {
        var index = document.querySelectorAll('.family-member').length;
        var familyMembersDiv = document.getElementById('family-members');

        var newMemberHtml = `
            <div class="family-member">
                <div class="form-group">
                    <label for="family[${index}][name]">Name</label>
                    <input type="text" name="family[${index}][name]" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="family[${index}][relationship]">Relationship</label>
                    <input type="text" name="family[${index}][relationship]" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="family[${index}][date_of_birth]">Date of Birth</label>
                    <input type="date" name="family[${index}][date_of_birth]" class="form-control" required>
                </div>
            </div>
        `;

        familyMembersDiv.insertAdjacentHTML('beforeend', newMemberHtml);
    });
</script>
@endsection
