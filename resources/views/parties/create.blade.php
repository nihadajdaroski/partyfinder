@extends('layouts.app')

@section('title', 'Ustvari dogodek')

@section('content')

<div class="auth-card" style="max-width: 750px; margin: 3rem auto;">

    <div style="margin-bottom: 1.5rem;">
        <h2 style="color: white; margin-bottom: 0.5rem;">
            Ustvari nov dogodek
        </h2>
        <p style="color: var(--text-muted); font-size: 0.9rem;">
            Deli svojo zabavo in privabi ljudi.
        </p>
    </div>

    <form method="POST" action="{{ route('parties.store') }}" enctype="multipart/form-data">
        @csrf

        <!-- TITLE -->
        <div class="form-group">
            <label class="form-label">Naslov</label>
            <input type="text" name="title" class="form-control" placeholder="npr. Poletni techno rave" required>
        </div>

        <!-- DESCRIPTION -->
        <div class="form-group">
            <label class="form-label">Opis</label>
            <textarea name="description" class="form-control" rows="4" placeholder="opiši dogodek..." required></textarea>
        </div>

        <!-- LOCATION -->
        <div class="form-group">
            <label class="form-label">Lokacija</label>
            <input type="text" name="location" class="form-control" placeholder="npr. Cvetličarna, Ljubljana" required>
        </div>

        <!-- DATE -->
        <div class="form-group">
            <label class="form-label">Datum in ura</label>
            <input type="datetime-local" name="date_time" class="form-control" required>
        </div>

        <!-- CATEGORY -->
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

        <!-- IMAGE UPLOAD -->
        <div class="form-group">
            <label class="form-label">Slika dogodka</label>

            <input 
                type="file" 
                name="image" 
                class="form-control" 
                accept="image/*"
                style="padding: 0.5rem;"
            >

            <small style="color: var(--text-muted); font-size: 0.8rem;">
                Priporočeno: horizontalna slika (1200x600)
            </small>
        </div>

        <!-- SUBMIT -->
        <button type="submit" class="btn btn-primary" style="width: 100%; margin-top: 1rem;">
            Ustvari dogodek
        </button>

    </form>

</div>

@endsection