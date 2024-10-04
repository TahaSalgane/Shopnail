@extends('home')

@section('dashboard-content')
<div class="container">
    <h2>Families List</h2>

    <a href="{{ route('families.create') }}" class="btn btn-primary mb-2">Add Family Member</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Relationship</th>
                <th>Date of Birth</th>
                <th>User</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($families as $family)
                <tr>
                    <td>{{ $family->name }}</td>
                    <td>{{ $family->relationship }}</td>
                    <td>{{ $family->date_of_birth }}</td>
                    <td>{{ $family->user->name }}</td>
                    <td>
                        <a href="{{ route('families.edit', $family->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('families.destroy', $family->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{-- Links if for pagination --}}
    {{ $families->links() }}
</div>
@endsection
