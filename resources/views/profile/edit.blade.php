@extends('layouts.app')

@section('title', 'Profil • PartyFinder')

@section('content')

<div class="container" style="max-width: 900px; margin-top: 3rem; margin-bottom: 3rem;">

    <div class="row g-4 align-items-start">

        <!-- PROFILE CARD -->
        <div class="col-lg-8 col-12">

            <div class="card"
                 style="background: rgba(15, 23, 42, 0.7);
                        backdrop-filter: blur(14px);
                        border: 1px solid rgba(99, 102, 241, 0.2);
                        border-radius: 16px;
                        padding: 2rem;">

                <!-- HEADER -->
                <div style="margin-bottom: 2rem;">
                    <h2 style="color: var(--text-primary); margin-bottom: 0.5rem;">
                        Uredi profil
                    </h2>
                    <p style="color: var(--text-muted); margin: 0;">
                        Posodobi svoje osebne podatke
                    </p>
                </div>

                <!-- AVATAR -->
                <div style="display: flex; align-items: center; gap: 1.5rem; margin-bottom: 2rem;">
                    <div style="width: 80px; height: 80px; border-radius: 50%;
                                background: linear-gradient(135deg, var(--color-primary), var(--color-secondary));
                                display: flex; align-items: center; justify-content: center;
                                color: white; font-size: 1.8rem; font-weight: bold;">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>

                    <div>
                        <div style="color: var(--text-primary); font-weight: 600;">
                            {{ auth()->user()->name }}
                        </div>
                        <div style="color: var(--text-muted); font-size: 0.85rem;">
                            {{ auth()->user()->email }}
                        </div>

                        <button class="btn btn-secondary btn-sm mt-2">
                            Spremeni sliko
                        </button>
                    </div>
                </div>

                <!-- FORM -->
                <form method="POST" action="{{ route('profile.update') }}">
                    @csrf
                    @method('PATCH')

                    <!-- NAME -->
                    <div class="mb-3">
                        <label class="form-label">Ime</label>
                        <input type="text"
                               name="name"
                               value="{{ old('name', auth()->user()->name) }}"
                               class="form-control"
                               style="background: var(--bg-tertiary); border: 1px solid rgba(255,255,255,0.1); color: white;">
                    </div>

                    <!-- EMAIL -->
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email"
                               name="email"
                               value="{{ old('email', auth()->user()->email) }}"
                               class="form-control"
                               style="background: var(--bg-tertiary); border: 1px solid rgba(255,255,255,0.1); color: white;">
                    </div>

                    <!-- PASSWORD -->
                    <div class="mb-3">
                        <label class="form-label">Novo geslo (opcijsko)</label>
                        <input type="password"
                               name="password"
                               class="form-control"
                               style="background: var(--bg-tertiary); border: 1px solid rgba(255,255,255,0.1); color: white;">
                    </div>

                    <!-- CONFIRM PASSWORD -->
                    <div class="mb-4">
                        <label class="form-label">Potrdi geslo</label>
                        <input type="password"
                               name="password_confirmation"
                               class="form-control"
                               style="background: var(--bg-tertiary); border: 1px solid rgba(255,255,255,0.1); color: white;">
                    </div>

                    <!-- ACTIONS -->
                    <div style="display: flex; gap: 1rem;">
                        <button type="submit" class="btn btn-primary">
                            Shrani spremembe
                        </button>

                        <a class="btn btn-secondary">
                            Prekliči
                        </a>
                    </div>

                </form>
            </div>
        </div>

        <!-- SIDEBAR STATS -->
        <div class="card mt-4"
            style="background: rgba(15, 23, 42, 0.7);
                    backdrop-filter: blur(14px);
                    border: 1px solid rgba(99, 102, 241, 0.2);
                    border-radius: 16px;
                    padding: 2rem;">
            <h4 style="color: var(--text-primary); margin-bottom: 1rem;">Moji dogodki</h4>

            @php
                $myParties = auth()->user()
                    ->parties()
                    ->orderBy('date_time')
                    ->get();
            @endphp

            @if($myParties->isEmpty())
                <p style="color: var(--text-muted); margin: 0;">Trenutno nisi prijavljen na noben dogodek.</p>
            @else
                <div class="events-container">
                    @foreach($myParties as $event)
                        <div class="card">
                            @if($event->image)
                                <img src="{{ $event->image }}" alt="{{ $event->title }}" class="card-image">
                            @else
                                <div class="card-image"></div>
                            @endif

                            <div class="card-body">
                                <div class="card-header">
                                    <h3 class="card-title">{{ $event->title }}</h3>
                                    <span class="card-badge">{{ $event->category ?? 'EVENT' }}</span>
                                </div>

                                <div class="card-meta">
                                    <div class="card-meta-item">
                                        <i class="bi bi-calendar3"></i>
                                        <span>{{ \Carbon\Carbon::parse($event->date_time)->format('d. m. Y H:i') }}</span>
                                    </div>
                                    <div class="card-meta-item">
                                        <i class="bi bi-geo-alt"></i>
                                        <span>{{ $event->location }}</span>
                                    </div>
                                </div>

                                <div class="card-actions">
                                    <a href="{{ route('parties.show', $event->id) }}" class="btn btn-secondary">
                                        Več podrobnosti
                                    </a>

                                    <form method="POST" action="{{ route('parties.leave', $event) }}" style="margin:0;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Ne grem več</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

    </div>
</div>

@endsection