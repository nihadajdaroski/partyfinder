@extends('layouts.app')

@section('title', 'PartyFinder • Odkrij dogodke')

@section('content')

<!-- HERO SECTION -->
<div class="hero">
    <div class="hero-content">
        <h1 class="hero-title">
            Odkrij svojo naslednjo <span class="gradient-text">noč</span>
        </h1>
        <p class="hero-subtitle">
            Odkrij zabave, koncerte in festivale v svoji bližini. Filtriraj po lokaciji, datumu in kategoriji ter hitro najdi pravi dogodek zase.
        </p>
    </div>
</div>

<!-- FILTER BAR (GET -> /) -->
<form method="GET" action="{{ url('/') }}" data-filters>
    {{-- ohrani sidebar filtre --}}
    @foreach((array) request('categories', []) as $cat)
        <input type="hidden" name="categories[]" value="{{ $cat }}">
    @endforeach
    <input type="hidden" name="from" value="{{ request('from') }}">
    <input type="hidden" name="to" value="{{ request('to') }}">

    <div class="filter-bar">
        <div class="filter-group">
            <label class="filter-label">Lokacija</label>

            <input
                type="text"
                name="location"
                class="form-control"
                placeholder="npr. Ljubljana"
                value="{{ request('location') }}"
            >
        </div>

        <div class="filter-group">
            <label class="filter-label">Datum</label>
            <select name="date" class="form-select">
                <option value="" {{ request('date') === null || request('date') === '' ? 'selected' : '' }}>Vsi datumi</option>
                <option value="weekend" {{ request('date') === 'weekend' ? 'selected' : '' }}>Ta konec tedna</option>
                <option value="today" {{ request('date') === 'today' ? 'selected' : '' }}>Danes</option>
                <option value="week" {{ request('date') === 'week' ? 'selected' : '' }}>Naslednji 7 dni</option>
                <option value="month" {{ request('date') === 'month' ? 'selected' : '' }}>Ta mesec</option>
            </select>
        </div>

        <div class="filter-group">
            <label class="filter-label">Kategorija</label>
            <select name="category" class="form-select">
                <option value="" {{ request('category') === null || request('category') === '' ? 'selected' : '' }}>Vse kategorije</option>
                <option value="ZABAVA" {{ request('category') === 'ZABAVA' ? 'selected' : '' }}>Zabava</option>
                <option value="TEHNOLOŠKA" {{ request('category') === 'TEHNOLOŠKA' ? 'selected' : '' }}>Tehnološka</option>
                <option value="KONCERT" {{ request('category') === 'KONCERT' ? 'selected' : '' }}>Koncert</option>
                <option value="RELAX" {{ request('category') === 'RELAX' ? 'selected' : '' }}>Relax</option>
                <option value="ŠTUDENTSKA" {{ request('category') === 'ŠTUDENTSKA' ? 'selected' : '' }}>Študentska</option>
            </select>
        </div>

        <div class="filter-group" style="justify-content: flex-end;">
            <button type="submit" class="btn-primary" style="width: 100%; margin-top: 1.5rem;">
                <i class="bi bi-search"></i> Išči dogodke
            </button>
        </div>
    </div>
</form>

<!-- MAIN CONTENT WITH RESPONSIVE GRID -->
<div class="main-grid">

    <!-- EVENTS GRID -->
    <div>
        <div id="eventsGrid">
            @include('parties._events_grid', ['events' => $events, 'joinedPartyIds' => $joinedPartyIds])
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

        {{-- SIDEBAR FILTERS FORM (kategorije + koledar) --}}
        <form method="GET" action="{{ url('/') }}" data-filters>
            {{-- ohrani filter-bar + navbar parametre --}}
            <input type="hidden" name="search" value="{{ request('search') }}">
            <input type="hidden" name="location" value="{{ request('location') }}">
            <input type="hidden" name="category" value="{{ request('category') }}">
            <input type="hidden" name="date" value="{{ request('date') }}">

            {{-- explicit date selection from calendar --}}
            <input type="hidden" name="from" id="from" value="{{ request('from') }}">
            <input type="hidden" name="to" id="to" value="{{ request('to') }}">

            <!-- Categories Filter -->
            <div class="sidebar-panel">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
                    <div class="sidebar-title" style="margin: 0;">Kategorije</div>

                    <button
                        type="button"
                        class="btn-secondary"
                        style="font-size: 0.75rem; padding: 0.375rem 0.75rem;"
                        onclick="
                            const form = this.closest('form[data-filters]');

                            // počisti kategorije
                            form.querySelectorAll('input[name=&quot;categories[]&quot;]').forEach(cb => cb.checked = false);

                            // sproži AJAX submit 
                            form.dispatchEvent(new Event('submit', { cancelable: true }));
                        "
                    >
                        Ponastavi
                    </button>
                </div>

                <div class="sidebar-divider"></div>

                <div class="checkbox-group">
                    @php
                        $categories = [
                            'ZABAVA' => 'Zabava',
                            'TEHNOLOŠKA' => 'Tehnološka',
                            'KONCERT' => 'Koncert',
                            'RELAX' => 'Relax',
                            'ŠTUDENTSKA' => 'Študentska',
                        ];

                        $selectedCategories = (array) request('categories', []);
                    @endphp

                    @foreach($categories as $value => $label)
                        <div class="checkbox-item">
                            <input
                                type="checkbox"
                                name="categories[]"
                                value="{{ $value }}"
                                id="cat-{{ $value }}"
                                {{ in_array($value, $selectedCategories) ? 'checked' : '' }}
                            >
                            <label for="cat-{{ $value }}">{{ $label }}</label>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Date Range Picker (CURRENT MONTH) -->
            <div class="sidebar-panel" style="margin-top: 1.5rem;">
                @php
                    $month = \Carbon\Carbon::now()->startOfMonth();
                    $daysInMonth = $month->daysInMonth;
                    $firstDow = $month->dayOfWeekIso; // 1=Mon ... 7=Sun
                @endphp

                <div class="sidebar-title" style="margin-bottom: 0.75rem;">Izbira datuma</div>
                <p style="font-size: 0.8rem; color: var(--text-muted); margin: 0 0 1rem 0;">
                    {{ $month->translatedFormat('F Y') }}
                </p>

                <div style="display: grid; grid-template-columns: repeat(7, 1fr); gap: 0.5rem; text-align: center; font-size: 0.75rem;">
                    @foreach(['P', 'T', 'S', 'Č', 'P', 'S', 'N'] as $day)
                        <div style="color: var(--text-muted); font-weight: 600; padding: 0.5rem 0;">{{ $day }}</div>
                    @endforeach

                    {{-- empty slots before day 1 --}}
                    @for($i = 1; $i < $firstDow; $i++)
                        <div></div>
                    @endfor

                    @for($d = 1; $d <= $daysInMonth; $d++)
                        @php
                            $dateStr = $month->copy()->day($d)->toDateString();
                        @endphp

                        <button
                            type="button"
                            class="calendar-day"
                            data-date="{{ $dateStr }}"
                            title="{{ \Carbon\Carbon::parse($dateStr)->format('d. m. Y') }}"
                            style="
                                padding: 0.5rem;
                                border-radius: 0.375rem;
                                cursor: pointer;
                                transition: var(--transition);
                                border: 0;
                                width: 100%;
                                background: var(--bg-tertiary);
                                color: var(--text-secondary);
                            "
                            onmouseover="this.style.background='var(--color-primary)'; this.style.color='white';"
                            onmouseout="if(!this.classList.contains('is-selected')){ this.style.background='var(--bg-tertiary)'; this.style.color='var(--text-secondary)'; }"
                        >
                            {{ $d }}
                        </button>
                    @endfor
                </div>
            </div>
        </form>

    </div>

</div>

@endsection

@push('scripts')
<script>
(function () {
  const eventsGrid = document.getElementById('eventsGrid');

  function getFilterForms() {
    return Array.from(document.querySelectorAll('form[data-filters]'));
  }

  function buildQueryFromAllForms() {
    const params = new URLSearchParams();

    getFilterForms().forEach(form => {
      const fd = new FormData(form);
      for (const [key, value] of fd.entries()) {
        const v = (value ?? '').toString().trim();
        if (v !== '') params.append(key, v);
      }
    });

    return params.toString();
  }

  function getParam(name) {
    return new URLSearchParams(window.location.search).get(name);
  }

  function syncCalendarSelection() {
    const selected = getParam('from'); // YYYY-MM-DD or null

    document.querySelectorAll('.calendar-day').forEach(btn => {
      const isSel = selected && btn.dataset.date === selected;
      btn.classList.toggle('is-selected', !!isSel);

      if (isSel) {
        btn.style.background = 'var(--color-primary)';
        btn.style.color = 'white';
      } else {
        btn.style.background = 'var(--bg-tertiary)';
        btn.style.color = 'var(--text-secondary)';
      }
    });
  }

  function wireCalendarClicks() {
    document.addEventListener('click', (e) => {
      const btn = e.target.closest('.calendar-day');
      if (!btn) return;

      const form = btn.closest('form[data-filters]');
      if (!form) return;

      const from = form.querySelector('#from');
      const to = form.querySelector('#to');
      if (!from || !to) return;

      const clickedDate = btn.dataset.date;
      const currentlySelected = from.value && from.value === clickedDate;

      if (currentlySelected) {
        // deselect
        from.value = '';
        to.value = '';
      } else {
        // select
        from.value = clickedDate;
        to.value = clickedDate;
      }

      // trigger AJAX submit (submit handler will intercept)
      form.dispatchEvent(new Event('submit', { cancelable: true }));
    }, { passive: true });
  }

  async function applyFilters({ pushUrl = true } = {}) {
    const qs = buildQueryFromAllForms();
    const url = `${window.location.pathname}${qs ? '?' + qs : ''}`;

    eventsGrid.style.opacity = '0.6';
    eventsGrid.style.pointerEvents = 'none';

    try {
      const res = await fetch(url, {
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
      });

      if (!res.ok) throw new Error('Request failed: ' + res.status);

      const html = await res.text();
      eventsGrid.innerHTML = html;

      if (pushUrl) window.history.pushState({}, '', url);

      // sidebar isn't rerendered -> keep calendar highlight in sync with URL
      syncCalendarSelection();
    } finally {
      eventsGrid.style.opacity = '1';
      eventsGrid.style.pointerEvents = 'auto';
    }
  }

  function wireUp() {
    getFilterForms().forEach(form => {
      form.addEventListener('submit', (e) => {
        e.preventDefault();
        applyFilters({ pushUrl: true });
      });

      form.querySelectorAll('input, select, textarea').forEach(el => {
        // search naj se ne proži na vsak keypress, samo ob change/enter
        if (el.name === 'search') {
          el.addEventListener('change', () => applyFilters({ pushUrl: true }));
          return;
        }
        el.addEventListener('change', () => applyFilters({ pushUrl: true }));
      });
    });
  }

  window.addEventListener('popstate', () => {
    applyFilters({ pushUrl: false });
    syncCalendarSelection();
  });

  window.addEventListener('pageshow', (e) => {
    if (e.persisted) {
        applyFilters({ pushUrl: false });
    }
  });

  wireCalendarClicks();
  wireUp();
  syncCalendarSelection();
})();
</script>
@endpush