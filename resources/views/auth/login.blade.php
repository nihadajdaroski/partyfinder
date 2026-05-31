@extends('layouts.auth')

@section('title', 'Prijava • PartyFinder')

@section('content')

<div class="auth-card">
    <div class="auth-header">
        <h2 class="auth-title">Prijava</h2>
        <p class="auth-subtitle">
            Nemaš računa? <a href="{{ route('register') }}">Registriraj se</a>
        </p>
    </div>

    <!-- Login Form -->
    <form method="POST" action="{{ route('login') }}" novalidate>
        @csrf

        <!-- Email Input -->
        <div class="form-group">
            <label for="email" class="form-label">Elektronska pošta</label>
            <input 
                type="email" 
                id="email" 
                name="email" 
                class="form-control @error('email') is-invalid @enderror"
                placeholder="vpisati@example.com"
                value="{{ old('email') }}"
                required
                autofocus
            >
            @error('email')
                <div class="invalid-feedback">
                    <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                </div>
            @enderror
        </div>

        <!-- Password Input -->
        <div class="form-group">
            <label for="password" class="form-label">Geslo</label>
            <input 
                type="password" 
                id="password" 
                name="password" 
                class="form-control @error('password') is-invalid @enderror"
                placeholder="••••••••"
                required
            >
            @error('password')
                <div class="invalid-feedback">
                    <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                </div>
            @enderror
        </div>

        <!-- Remember Me & Forgot Password -->
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
            <div class="form-check">
                <input 
                    type="checkbox" 
                    id="remember" 
                    name="remember" 
                    class="form-check-input"
                    {{ old('remember') ? 'checked' : '' }}
                >
                <label class="form-check-label" for="remember">
                    Zapomni si me
                </label>
            </div>

            <a href="{{ route('password.request') }}"
               style="font-size: 0.9rem; color: var(--color-primary); text-decoration: none; font-weight: 600;">
                Pozabljeno geslo?
            </a>
        </div>

        <!-- Login Button -->
        <button type="submit" class="btn btn-primary">
            <i class="bi bi-box-arrow-in-right me-2"></i>Prijava
        </button>
    </form>

</div>

@endsection

@push('scripts')
<script>
    document.querySelectorAll('.form-control').forEach(input => {
        input.addEventListener('focus', function() {
            this.parentElement.style.transform = 'scale(1.01)';
            this.parentElement.style.transition = 'transform 0.2s ease';
        });

        input.addEventListener('blur', function() {
            this.parentElement.style.transform = 'scale(1)';
        });
    });

    const style = document.createElement('style');
    style.textContent = `
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
        }
    `;
    document.head.appendChild(style);
</script>
@endpush