@extends('layouts.guest')

@section('content')
<div class="d-flex justify-content-center align-items-center vh-100">
    <div class="card shadow-lg" style="width: 30rem;">
        <div class="card-header bg-success text-white text-center">
            <h3>Create an Account</h3>
        </div>
        <div class="card-body">
            {{-- Display success message --}}
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Display validation errors --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="form-group mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus class="form-control">
                </div>
                <div class="form-group mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required class="form-control">
                </div>
                <div class="form-group mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input id="password" type="password" name="password" required class="form-control">
                </div>
                <div class="form-group mb-3">
                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" required class="form-control">
                </div>
                <button type="submit" class="btn btn-success btn-block">REGISTER</button>
            </form>
        </div>
    </div>
</div>
@endsection
