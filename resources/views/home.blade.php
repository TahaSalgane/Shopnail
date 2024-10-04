@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2">
            <div class="list-group">
                <a href="{{ route('users.index') }}" class="list-group-item list-group-item-action {{ request()->is('users*') ? 'active' : '' }}">
                    Users
                </a>
                <a href="{{ route('families.index') }}" class="list-group-item list-group-item-action {{ request()->is('families*') ? 'active' : '' }}">
                    Families
                </a>
            </div>
        </div>
        
        <div class="col-md-9">
            <div class="card">
                <div class="card-body">
                    @yield('dashboard-content')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
