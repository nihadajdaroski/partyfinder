@extends('layouts.auth')

@section('title', 'Registracija • PartyFinder')

@section('content')

<div class="auth-card">
    <div class="auth-header">
        <h2 class="auth-title">Registracija</h2>
        <p class="auth-subtitle">
            Že imaš račun? <a href="{{ route('login') }}">Prijavi se</a>
        </p>
    </div>

    <!-- Registration Form -->
    <form method="POST" action="{{ route('register') }}" novalidate>
        @csrf

        <!-- Name Input -->
        <div class="form-group">
            <label for="name" class="form-label">Polno ime</label>
            <input 
                type="text" 
                id="name" 
                name="name" 
                class="form-control @error('name') is-invalid @enderror"
                placeholder="Marko Novak"
                value="{{ old('name') }}"
                required
                autofocus
            >
            @error('name')
                <div class="invalid-feedback">
                    <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                </div>
            @enderror
        </div>

        <!-- Email Input -->
        <div class="form-group">
            <label for="email" class="form-label">Elektronska pošta</label>
            <input 
                type="email" 
                id="email" 
                name="email" 
                class="form-control @error('email') is-invalid @enderror"
                placeholder="marko@example.com"
                value="{{ old('email') }}"
                required
            >
            @error('email')
                <div class="invalid-feedback">
                    <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                </div>
            @enderror
        </div>

        <!-- Password -->
        <div class="form-group">
            <label for="password" class="form-label">Geslo</label>
            <input 
                type="password" 
                id="password" 
                name="password" 
                class="form-control @error('password') is-invalid @enderror"
                placeholder="••••••••"
                required
                minlength="8"
            >
            @error('password')
                <div class="invalid-feedback">
                    <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                </div>
            @enderror
        </div>

        <!-- Confirm Password -->
        <div class="form-group">
            <label for="password_confirmation" class="form-label">Potrdi geslo</label>
            <input 
                type="password" 
                id="password_confirmation" 
                name="password_confirmation" 
                class="form-control"
                placeholder="••••••••"
                required
                minlength="8"
            >
        </div>

        <!-- Terms -->
        <div class="form-check" style="margin-bottom: 1.5rem;">
            <input 
                type="checkbox" 
                id="terms" 
                name="terms" 
                class="form-check-input"
                required
                {{ old('terms') ? 'checked' : '' }}
            >
            <label class="form-check-label" for="terms">
                Strinjam se s <a href="#">pogoji rabe</a> in <a href="#">politiko zasebnosti</a>
            </label>
        </div>

        <!-- Newsletter -->
        <div class="form-check" style="margin-bottom: 1.5rem;">
            <input 
                type="checkbox" 
                id="newsletter" 
                name="newsletter" 
                class="form-check-input"
                {{ old('newsletter') ? 'checked' : '' }}
            >
            <label class="form-check-label" for="newsletter">
                Pošlji mi obvestila o dogodkih
            </label>
        </div>

        <!-- Submit -->
        <button type="submit" class="btn btn-primary">
            <i class="bi bi-person-plus me-2"></i>Ustvari račun
        </button>
    </form>

</div>

@endsection