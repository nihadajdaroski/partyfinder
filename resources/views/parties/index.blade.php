@extends('layouts.app')

@section('title', 'PartyFinder • Odkrij dogodke')

@section('content')

<!-- HERO SECTION -->
<div class="hero">
    <div class="hero-content">
        <h1 class="hero-title">
            Odkrij svojo naslednjo <span class="gradient-text">noč iz</span>
        </h1>
        <p class="hero-subtitle">
            Iskalnik zabav, koncertov in festivalov. Filtriraj po lokaciji, datumu in kategoriji — nato se pušti vleči v vibracijo.
        </p>
    </div>
</div>

<!-- FILTER BAR -->
<div class="filter-bar">
    <div class="filter-group">
        <label class="filter-label">Lokacija</label>
        <select class="form-select">
            <option selected>Ljubljana, Slovenija</option>
            <option>Maribor</option>
            <option>Celje</option>
            <option>Kranj</option>
            <option>Nova Gorica</option>
        </select>
    </div>

    <div class="filter-group">
        <label class="filter-label">Datum</label>
        <select class="form-select">
            <option selected>Ta konec tedna</option>
            <option>Danes</option>
            <option>Naslednji 7 dni</option>
            <option>Ta mesec</option>
        </select>
    </div>

    <div class="filter-group">
        <label class="filter-label">Kategorija</label>
        <select class="form-select">
            <option selected>Tehnologija</option>
            <option>Zabava</option>
            <option>Koncert</option>
            <option>Relax</option>
            <option>Študentske zabave</option>
        </select>
    </div>

    <div class="filter-group" style="justify-content: flex-end;">
        <button class="btn-primary" style="width: 100%; margin-top: 1.5rem;">
            <i class="bi bi-search"></i> Išči dogodke
        </button>
    </div>
</div>

<!-- MAIN CONTENT WITH RESPONSIVE GRID -->
<div class="main-grid">

    <!-- EVENTS GRID -->
    <div>
        <div class="events-container">
            
            @php
                $events = [
                    [
                        'title' => 'Petek Nočna Priprava',
                        'date' => '15. julij, 21:00',
                        'location' => 'Klub Metamorfoza, Ljubljana',
                        'category' => 'TEHNOLOŠKA',
                        'img' => 'https://images.unsplash.com/photo-1506157786151-b8491531f063?auto=format&fit=crop&w=1200&q=70',
                    ],
                    [
                        'title' => 'Nedeljska Strešna Sprostitev',
                        'date' => '16. julij, 17:00',
                        'location' => 'Skyline Bar, Maribor',
                        'category' => 'RELAX',
                        'img' => 'https://images.unsplash.com/photo-1520975958225-3f61d39a4a46?auto=format&fit=crop&w=1200&q=70',
                    ],
                    [
                        'title' => 'Podzemna Študentska Noč',
                        'date' => '16. julij, 22:30',
                        'location' => 'Vault Club, Ljubljana',
                        'category' => 'ZABAVA',
                        'img' => 'https://images.unsplash.com/photo-1516450360452-9312f5e86fc7?auto=format&fit=crop&w=1200&q=70',
                    ],
                    [
                        'title' => 'Luči Mesta Koncert',
                        'date' => '17. julij, 20:00',
                        'location' => 'Areno Hall, Ljubljana',
                        'category' => 'KONCERT',
                        'img' => 'https://images.unsplash.com/photo-1459749411175-04bf5292ceea?auto=format&fit=crop&w=1200&q=70',
                    ],
                    [
                        'title' => 'Sončni Spust Domača Seje',
                        'date' => '18. julij, 19:00',
                        'location' => 'Riverside Deck, Ljubljana',
                        'category' => 'RELAX',
                        'img' => 'https://images.unsplash.com/photo-1470225620780-dba8ba36b745?auto=format&fit=crop&w=1200&q=70',
                    ],
                    [
                        'title' => 'Skladiščna Tehnološka Noč',
                        'date' => '19. julij, 23:00',
                        'location' => 'Distrikт 9, Ljubljana',
                        'category' => 'TEHNOLOŠKA',
                        'img' => 'https://images.unsplash.com/photo-1533174072545-7a4b6ad7a6c3?auto=format&fit=crop&w=1200&q=70',
                    ],
                ];
            @endphp

            @foreach($events as $event)
                <div class="card">
                    <img src="{{ $event['img'] }}" alt="{{ $event['title'] }}" class="card-image">
                    
                    <div class="card-body">
                        <div class="card-header">
                            <h3 class="card-title">{{ $event['title'] }}</h3>
                            <span class="card-badge">{{ $event['category'] }}</span>
                        </div>

                        <div class="card-meta">
                            <div class="card-meta-item">
                                <i class="bi bi-calendar3"></i>
                                <span>{{ $event['date'] }}</span>
                            </div>
                            <div class="card-meta-item">
                                <i class="bi bi-geo-alt"></i>
                                <span>{{ $event['location'] }}</span>
                            </div>
                        </div>

                        <div class="card-actions">
                            <a href="#" class="btn btn-secondary">Več podrobnosti</a>
                            @if(auth()->check())
                                <button class="btn btn-success">Grem</button>
                            @else
                                
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>

    <!-- SIDEBAR -->
    <div class="sidebar">

        <!-- Create Event CTA -->
        <div class="sidebar-panel"
     style="background: linear-gradient(135deg, rgba(99, 102, 241, 0.1) 0%, rgba(16, 185, 129, 0.05) 100%);
            border: 1px solid rgba(99, 102, 241, 0.2);">

        <div style="display: flex; gap: 1rem; align-items: center; justify-content: space-between;">

            <div>
                <div class="sidebar-title" style="margin: 0; font-size: 0.95rem;">
                    Ustvari dogodek
                </div>

                <p style="font-size: 0.8rem; color: var(--text-muted); margin: 0.5rem 0 0 0;">
                    Deli svojo zabavo z mestom.
                </p>
            </div>

            @auth
                <a href="{{ route('parties.create') }}" class="btn-icon" style="flex-shrink: 0;">
                    <i class="bi bi-plus-lg" style="font-size: 1.25rem;"></i>
                </a>
            @else
                <a href="{{ route('login') }}" class="btn-icon" style="flex-shrink: 0;" title="Prijavi se za ustvarjanje dogodkov">
                    <i class="bi bi-lock" style="font-size: 1.25rem;"></i>
                </a>
            @endauth

        </div>
    </div>

        <!-- Categories Filter -->
        <div class="sidebar-panel">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
                <div class="sidebar-title" style="margin: 0;">Kategorije</div>
                <button class="btn-secondary" style="font-size: 0.75rem; padding: 0.375rem 0.75rem;">Ponastavi</button>
            </div>

            <div class="sidebar-divider"></div>

            <div class="checkbox-group">
                @php
                    $categories = ['Zabava', 'Koncert', 'Tehnološka', 'Relax', 'Študentske zabave'];
                @endphp

                @foreach($categories as $idx => $category)
                    <div class="checkbox-item">
                        <input 
                            type="checkbox" 
                            id="cat-{{ $idx }}" 
                            {{ $idx === 2 ? 'checked' : '' }}
                        >
                        <label for="cat-{{ $idx }}">{{ $category }}</label>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Date Range Picker -->
        <div class="sidebar-panel">
            <div class="sidebar-title" style="margin-bottom: 0.75rem;">Izbira datuma</div>
            <p style="font-size: 0.8rem; color: var(--text-muted); margin: 0 0 1rem 0;">Julij 2026</p>

            <!-- Simple Calendar Grid -->
            <div style="display: grid; grid-template-columns: repeat(7, 1fr); gap: 0.5rem; text-align: center; font-size: 0.75rem;">
                @foreach(['P', 'T', 'S', 'Č', 'P', 'S', 'N'] as $day)
                    <div style="color: var(--text-muted); font-weight: 600; padding: 0.5rem 0;">{{ $day }}</div>
                @endforeach

                @for($i = 1; $i <= 31; $i++)
                    <div 
                        style="
                            padding: 0.5rem;
                            border-radius: 0.375rem;
                            cursor: pointer;
                            transition: var(--transition);
                            background: var(--bg-tertiary);
                            color: var(--text-secondary);
                        "
                        onmouseover="this.style.background='var(--color-primary)'; this.style.color='white';"
                        onmouseout="this.style.background='var(--bg-tertiary)'; this.style.color='var(--text-secondary)';"
                    >
                        {{ $i }}
                    </div>
                @endfor
            </div>
        </div>

        <!-- Location Radius -->
        <div class="sidebar-panel">
            <div class="sidebar-title" style="margin-bottom: 1.25rem;">Radij lokacije</div>

            <div style="display: flex; justify-content: space-between; font-size: 0.8rem; color: var(--text-muted); margin-bottom: 0.75rem;">
                <span>0 km</span>
                <span>50 km</span>
            </div>

            <input type="range" min="0" max="50" value="30" class="slider" style="margin-bottom: 1.5rem;">

            <button class="btn-primary" style="width: 100%; justify-content: center;">
                Uporabi filtre
            </button>
        </div>

    </div>

</div>

@endsection