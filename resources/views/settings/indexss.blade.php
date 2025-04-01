@extends('layouts.app')
{{-- @php
dd($admin);
@endphp --}}
@section('contents')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg p-3 mb-5 bg-white rounded">
                <div class="card-header text-center">
                    <h1>Admin Profile</h1>
                </div>

                <div class="card-body d-flex flex-column flex-md-row align-items-center">
                    <!-- Profile Picture -->
                    <div class="profile-image-wrapper text-center mb-3 mb-md-0">
                        <img src="{{ auth()->check() && auth()->user()->img ? asset('storage/' . auth()->user()->img) : 'https://startbootstrap.github.io/startbootstrap-sb-admin-2/img/undraw_profile.svg' }}"
                             class="img-fluid rounded-circle profile-image"
                             alt="Profile Picture">
                    </div>

                    <!-- Admin Details -->
                    <div class="admin-details-wrapper ml-md-4 text-center text-md-left">
                        @if (auth()->check())
                            <h2>{{ auth()->user()->name }}</h2>
                            <p class="text-muted">Email: {{ auth()->user()->email }}</p>
                            <p class="text-muted">Created At: {{ auth()->user()->created_at->format('d M Y') }}</p>
                            <p class="text-muted">Last Updated: {{ auth()->user()->updated_at->format('d M Y') }}</p>
                        @else
                            <p class="text-danger">User is not authenticated.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
