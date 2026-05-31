@extends('layouts.app')

@section('title', $party->title)

@section('content')

<div class="container mt-5">

    <div class="card" style="border-radius: 18px; overflow: hidden;">

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

            <div style="display: flex; justify-content: space-between; align-items: flex-start; gap: 1rem;">

                <h1 style="color: white; margin: 0;">
                    {{ $party->title }}
                </h1>

                <span class="badge" style="background: var(--color-primary); padding: 0.5rem 0.75rem;">
                    {{ $party->category ?? 'EVENT' }}
                </span>

            </div>

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

            <div style="margin-top: 2rem;">
                <h5 style="color: white; margin-bottom: 0.75rem;">Opis dogodka</h5>

                <p style="color: var(--text-muted); line-height: 1.6;">
                    {{ $party->description }}
                </p>
            </div>

            <div style="margin-top: 2.5rem; display: flex; gap: 1rem; flex-wrap: wrap;">

                <a href="{{ url('/') }}" class="btn btn-secondary"
                   onclick="event.preventDefault(); if (window.history.length > 1) { window.history.back(); } else { window.location.href='{{ url('/') }}'; }">
                    <i class="bi bi-arrow-left"></i> Nazaj
                </a>

                @auth
                    @php
                        $joined = auth()->user()->parties()->where('party_id', $party->id)->exists();
                    @endphp

                    <form
                        id="rsvpForm"
                        method="POST"
                        action="{{ $joined ? route('parties.leave', $party) : route('parties.join', $party) }}"
                        style="margin:0;"
                    >
                        @csrf
                        @if($joined)
                            @method('DELETE')
                        @endif

                        <button type="submit" class="btn {{ $joined ? 'btn-danger' : 'btn-success' }}">
                            @if(!$joined)
                                <i class="bi bi-check-circle"></i> Grem na dogodek
                            @else
                                <i class="bi bi-x-circle"></i> Ne grem več
                            @endif
                        </button>
                    </form>

                    <button class="btn btn-primary" type="button">
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

@push('scripts')
<script>
(function () {
  const form = document.getElementById('rsvpForm');
  if (!form) return;

  form.addEventListener('submit', async (e) => {
    e.preventDefault();

    const token = form.querySelector('input[name="_token"]')?.value;
    const methodOverride = form.querySelector('input[name="_method"]')?.value;
    const method = methodOverride ? methodOverride.toUpperCase() : 'POST';

    const btn = form.querySelector('button[type="submit"]');
    const oldHtml = btn ? btn.innerHTML : null;

    if (btn) {
      btn.disabled = true;
      btn.style.opacity = '0.75';
      btn.innerHTML = '...';
    }

    try {
      const res = await fetch(form.action, {
        method,
        headers: {
          'X-Requested-With': 'XMLHttpRequest',
          'X-CSRF-TOKEN': token,
          'Accept': 'application/json'
        }
      });

      if (!res.ok) {
        form.submit();
        return;
      }

      window.location.replace(window.location.href);

    } catch (err) {
      form.submit();
    } finally {
      if (btn) {
        btn.disabled = false;
        btn.style.opacity = '1';
        if (oldHtml !== null) btn.innerHTML = oldHtml;
      }
    }
  });
})();
</script>
@endpush