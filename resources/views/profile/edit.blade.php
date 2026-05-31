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
        <div class="col-lg-4 col-12">

            <div class="card"
                 style="background: rgba(15, 23, 42, 0.7);
                        backdrop-filter: blur(14px);
                        border: 1px solid rgba(16, 185, 129, 0.2);
                        border-radius: 16px;
                        padding: 1.5rem;">

                <h5 style="color: var(--text-primary); margin-bottom: 1rem;">
                    Tvoj račun
                </h5>

                <div style="margin-bottom: 1rem;">
                    <div style="color: var(--text-muted); font-size: 0.85rem;">Ustvarjeni dogodki</div>
                    <div style="color: white; font-size: 1.2rem; font-weight: 600;">0</div>
                </div>

                <div style="margin-bottom: 1rem;">
                    <div style="color: var(--text-muted); font-size: 0.85rem;">Prijavljeni dogodki</div>
                    <div style="color: white; font-size: 1.2rem; font-weight: 600;">0</div>
                </div>

                <div style="margin-top: 1.5rem;">
                    <a href="#" class="btn btn-success w-100">
                        Moji dogodki
                    </a>
                </div>

            </div>
        </div>

    </div>
</div>

@endsection