@extends('layouts.app')

@section('title', 'Admin Login')

@section('content')
<div class="container my-auto py-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-4">
            <div class="cute-card p-4 p-md-5">
                <h3 class="fw-bold text-center mb-4">Admin Access 🔐</h3>

                @if($errors->any())
                    <div class="alert alert-danger rounded-4 text-center">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form action="{{ route('admin.login.submit') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Email Address</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}" required autofocus>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold">Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>

                    <div class="mb-4 form-check">
                        <input type="checkbox" name="remember" class="form-check-input" id="remember">
                        <label class="form-check-label" for="remember">Remember Me</label>
                    </div>

                    <button type="submit" class="btn btn-pink w-100">Login to Dashboard</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection 