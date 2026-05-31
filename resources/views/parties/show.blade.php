@extends('layouts.app')

@section('title', $party->title)

@section('content')

<div class="container mt-5">

    <!-- HERO CARD -->
    <div class="card" style="border-radius: 18px; overflow: hidden;">

        <!-- IMAGE -->
        @if($party->image)
            <div style="height: 320px; overflow: hidden;">
                <img 
                    src="{{ $party->image }}" 
                    alt="{{ $party->title }}"
                    style="width: 100%; height: 100%; object-fit: cover;"
                >
            </div>
        @endif

        <div style="padding: 2.5rem;">

            <!-- TITLE + BADGE -->
            <div style="display: flex; justify-content: space-between; align-items: flex-start; gap: 1rem;">

                <h1 style="color: white; margin: 0;">
                    {{ $party->title }}
                </h1>

                <span class="badge" style="background: var(--color-primary); padding: 0.5rem 0.75rem;">
                    {{ $party->category ?? 'EVENT' }}
                </span>

            </div>

            <!-- META -->
            <div style="margin-top: 1.25rem; display: flex; flex-direction: column; gap: 0.5rem; color: var(--text-muted);">

                <div>
                    <i class="bi bi-geo-alt"></i>
                    {{ $party->location }}
                </div>

                <div>
                    <i class="bi bi-calendar3"></i>
                    {{ $party->date_time->format('d.m.Y H:i') }}
                </div>

            </div>

            <!-- DESCRIPTION -->
            <div style="margin-top: 2rem;">
                <h5 style="color: white; margin-bottom: 0.75rem;">Opis dogodka</h5>

                <p style="color: var(--text-muted); line-height: 1.6;">
                    {{ $party->description }}
                </p>
            </div>

            <!-- ACTIONS -->
            <div style="margin-top: 2.5rem; display: flex; gap: 1rem; flex-wrap: wrap;">

                <a href="{{ url()->previous() }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Nazaj
                </a>

                @auth
                    <button class="btn btn-success">
                        <i class="bi bi-check-circle"></i> Grem na dogodek
                    </button>

                    <button class="btn btn-primary">
                        <i class="bi bi-share"></i> Deli
                    </button>
                @else
                    <a href="{{ route('login') }}" class="btn btn-primary">
                        Prijavi se za udeležbo
                    </a>
                @endauth

            </div>

        </div>
    </div>

</div>

@endsection