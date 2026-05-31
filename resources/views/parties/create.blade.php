@extends('layouts.app')

@section('title', 'Ustvari dogodek')

@section('content')

<div class="create-card">

    <div class="create-header">
        <h2 class="create-title">Ustvari nov dogodek</h2>
        <p class="create-subtitle">Deli svojo zabavo in privabi ljudi.</p>
    </div>

    <form method="POST" action="{{ route('parties.store') }}" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label class="form-label">Naslov</label>
            <input type="text" name="title" class="form-control" placeholder="npr. Poletni techno rave" required>
        </div>

        <div class="form-group">
            <label class="form-label">Opis</label>
            <textarea name="description" class="form-control" rows="4" placeholder="opiši dogodek..." required></textarea>
        </div>

        <div class="form-group">
            <label class="form-label">Lokacija</label>
            <input type="text" name="location" class="form-control" placeholder="npr. Cvetličarna, Ljubljana" required>
        </div>

        <div class="form-group">
            <label class="form-label">Datum in ura</label>
            <input type="datetime-local" name="date_time" class="form-control" required>
        </div>

        <div class="form-group">
            <label class="form-label">Kategorija</label>
            <select name="category" class="form-control" required>
                <option value="">Izberi kategorijo</option>
                <option>ZABAVA</option>
                <option>TEHNOLOŠKA</option>
                <option>KONCERT</option>
                <option>RELAX</option>
                <option>ŠTUDENTSKA</option>
            </select>
        </div>

        <div class="form-group">
            <label class="form-label">Slika dogodka</label>
            <input type="file" name="image" class="form-control" accept="image/*">
            <small class="create-hint">Priporočeno: horizontalna slika (1200x600)</small>
        </div>

        <button type="submit" class="btn-primary create-submit">
            Ustvari dogodek
        </button>

    </form>

</div>

@endsection

@push('styles')
<style>
    .create-card {
        max-width: 750px;
        margin: 3rem auto;
        padding: 1.75rem;
        border-radius: var(--radius-xl);
        border: 1px solid var(--border-color);

        background:
            linear-gradient(135deg, rgba(99, 102, 241, 0.06) 0%, rgba(16, 185, 129, 0.06) 100%),
            linear-gradient(180deg, rgba(30, 41, 59, 0.65) 0%, rgba(15, 23, 42, 0.85) 100%);

        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        box-shadow: var(--shadow-xl);
        position: relative;
        overflow: hidden;
    }

    .create-card .form-control::placeholder,
    .create-card textarea.form-control::placeholder {
        color: rgba(241, 245, 249, 0.95) !important;
        opacity: 1; 
    }

    .create-card::before {
        content: "";
        position: absolute;
        inset: -50%;
        background: radial-gradient(circle at 20% 40%, rgba(99, 102, 241, 0.18), transparent 55%);
        pointer-events: none;
        animation: createFloat 7s ease-in-out infinite;
    }

    @keyframes createFloat {
        0%, 100% { transform: translate(0, 0); }
        50% { transform: translate(22px, -16px); }
    }

    .create-card > * {
        position: relative;
        z-index: 1;
    }

    .create-header {
        margin-bottom: 1.5rem;
    }

    .create-title {
        color: var(--text-primary);
        margin: 0 0 0.4rem 0;
        font-weight: 800;
        letter-spacing: -0.8px;
        line-height: 1.2;
        font-size: 1.6rem;
    }

    .create-subtitle {
        color: var(--text-muted);
        margin: 0;
        font-size: 0.95rem;
        line-height: 1.6;
        max-width: 70ch;
    }

    .create-card .form-group {
        margin-bottom: 1rem;
    }

    .create-card .form-label {
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.6px;
        color: var(--text-muted);
        margin-bottom: 0.5rem;
    }

    .create-card textarea.form-control {
        min-height: 140px;
        resize: vertical;
    }

    .create-card input[type="datetime-local"].form-control {
        color-scheme: dark; 
    }

    .create-card input[type="file"].form-control {
        padding: 0.55rem;
        cursor: pointer;
    }

    .create-card input[type="file"].form-control::file-selector-button {
        background: var(--bg-tertiary);
        border: 1px solid var(--border-color-light);
        color: var(--text-primary);
        padding: 0.55rem 0.9rem;
        border-radius: var(--radius-md);
        margin-right: 0.9rem;
        cursor: pointer;
        transition: var(--transition);
        font-weight: 700;
        font-size: 0.85rem;
    }

    .create-card input[type="file"].form-control::file-selector-button:hover {
        border-color: var(--color-primary);
        color: var(--color-primary);
        background: rgba(51, 65, 85, 0.8);
        transform: translateY(-1px);
    }

    .create-hint {
        display: block;
        margin-top: 0.5rem;
        color: var(--text-muted);
        font-size: 0.85rem;
        line-height: 1.4;
    }

    .create-submit {
        width: 100%;
        margin-top: 0.75rem;
    }

    /* Mobile */
    @media (max-width: 768px) {
        .create-card {
            margin: 1.5rem auto;
            padding: 1.25rem;
        }

        .create-title {
            font-size: 1.35rem;
        }
    }
</style>
@endpush