<div class="events-container">
    @forelse($events as $event)
        @php
            $joined = auth()->check() ? in_array($event->id, $joinedPartyIds ?? []) : false;
        @endphp

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

                    @auth
                        @if(!$joined)
                            <form method="POST" action="{{ route('parties.join', $event) }}" style="margin:0;">
                                @csrf
                                <button type="submit" class="btn btn-success">Grem</button>
                            </form>
                        @else
                            <form method="POST" action="{{ route('parties.leave', $event) }}" style="margin:0;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Ne grem več</button>
                            </form>
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="btn btn-success">Grem</a>
                    @endauth
                </div>
            </div>
        </div>
    @empty
        <div class="sidebar-panel" style="grid-column: 1 / -1;">
            <div class="sidebar-title" style="margin-bottom: 0.5rem;">Ni zadetkov</div>
            <p style="margin: 0; color: var(--text-secondary);">
                Poskusi spremeniti iskanje ali filtre.
            </p>
        </div>
    @endforelse
</div>