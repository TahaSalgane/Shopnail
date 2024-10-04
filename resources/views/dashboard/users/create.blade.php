@extends('home')

@section('dashboard-content')
<div class="container">
    <h2>Create New User</h2>

    <form action="{{ route('users.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
            @error('email') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="form-control" required>
            @error('password') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="phone">Phone</label>
            <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone') }}" required>
            @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="date_of_birth">Date of Birth</label>
            <input type="date" name="date_of_birth" id="date_of_birth" class="form-control" value="{{ old('date_of_birth') }}" required>
            @error('date_of_birth') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <!-- Button to show family member fields -->
        <button type="button" class="btn btn-secondary mt-2" id="show-family-form">Add Family Member</button>

        <!-- Hidden Family Members section -->
        <div id="family-members" style="display:none;">
            <h4>Family Members</h4>

            <div class="family-member">
                <div class="form-group">
                    <label for="family[0][name]">Name</label>
                    <input type="text" name="family[0][name]" class="form-control">
                </div>

                <div class="form-group">
                    <label for="family[0][relationship]">Relationship</label>
                    <input type="text" name="family[0][relationship]" class="form-control">
                </div>

                <div class="form-group">
                    <label for="family[0][date_of_birth]">Date of Birth</label>
                    <input type="date" name="family[0][date_of_birth]" class="form-control">
                </div>
            </div>
        </div>

        <!-- Add more family members -->
        <button type="button" class="btn btn-secondary" id="add-family-member" style="display:none;">Add Another Family Member</button>

        <div class="form-group mt-3">
            <button type="submit" class="btn btn-primary">Create User</button>
        </div>
    </form>
</div>

<script>
    let familyCount = 1;

    // Show family member form when button is clicked
    document.getElementById('show-family-form').addEventListener('click', function() {
        document.getElementById('family-members').style.display = 'block';
        document.getElementById('add-family-member').style.display = 'block';
        this.style.display = 'none'; // Hide the 'Add Family Member' button
    });

    // Add more family member fields dynamically
    document.getElementById('add-family-member').addEventListener('click', function() {
        let familyMembersDiv = document.getElementById('family-members');
        let newFamilyMember = `
            <div class="family-member">
                <div class="form-group">
                    <label for="family[${familyCount}][name]">Name</label>
                    <input type="text" name="family[${familyCount}][name]" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="family[${familyCount}][relationship]">Relationship</label>
                    <input type="text" name="family[${familyCount}][relationship]" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="family[${familyCount}][date_of_birth]">Date of Birth</label>
                    <input type="date" name="family[${familyCount}][date_of_birth]" class="form-control" required>
                </div>
            </div>`;
        familyMembersDiv.insertAdjacentHTML('beforeend', newFamilyMember);
        familyCount++;
    });
</script>
@endsection
