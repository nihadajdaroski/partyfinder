@extends('layouts.auth')

@section('title', 'Pozabljeno geslo • PartyFinder')

@section('content')

<div class="auth-card">

    <!-- Header -->
    <div class="auth-header">
        <h2 class="auth-title">Pozabljeno geslo</h2>
        <p class="auth-subtitle">
            Vnesi svoj email in poslali ti bomo povezavo za ponastavitev gesla.
        </p>
    </div>

    <!-- Status message -->
    @if (session('status'))
        <div style="
            background: rgba(16, 185, 129, 0.1);
            border: 1px solid rgba(16, 185, 129, 0.3);
            color: var(--color-secondary);
            padding: 0.75rem 1rem;
            border-radius: 0.75rem;
            font-size: 0.85rem;
            margin-bottom: 1.5rem;
        ">
            {{ session('status') }}
        </div>
    @endif

    <!-- Form -->
    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email -->
        <div class="form-group">
            <label for="email" class="form-label">Elektronska pošta</label>
            <input
                type="email"
                id="email"
                name="email"
                class="form-control @error('email') is-invalid @enderror"
                value="{{ old('email') }}"
                placeholder="vpisati@example.com"
                required
                autofocus
            >

            @error('email')
                <div class="invalid-feedback">
                    <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                </div>
            @enderror
        </div>

        <!-- Submit button -->
        <button type="submit" class="btn btn-primary w-100">
            <i class="bi bi-envelope me-2"></i>Pošlji povezavo za ponastavitev
        </button>
    </form>

    <!-- Back to login -->
    <div style="margin-top: 1.5rem; text-align: center;">
        <a href="{{ route('login') }}"
           style="color: var(--color-primary); font-weight: 600; text-decoration: none;">
            ← Nazaj na prijavo
        </a>
    </div>

</div>

@endsection