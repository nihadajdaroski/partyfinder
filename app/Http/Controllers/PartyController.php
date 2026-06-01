<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Party;
use Carbon\Carbon;

class PartyController extends Controller
{
    public function index(Request $request)
    {
        $search   = trim((string) $request->query('search', ''));
        $location = trim((string) $request->query('location', ''));
        $category = trim((string) $request->query('category', ''));
        $date     = trim((string) $request->query('date', ''));

        $categories = (array) $request->query('categories', []);
        $categories = array_values(array_filter(array_map('trim', $categories)));

        $from = $request->query('from');
        $to   = $request->query('to');

        $query = Party::query()->withCount('attendees');

        $query->when($search !== '', function ($q) use ($search) {
            $q->where(function ($qq) use ($search) {
                $qq->where('title', 'like', "%{$search}%")
                   ->orWhere('description', 'like', "%{$search}%");
            });
        });

        $query->when($location !== '', function ($q) use ($location) {
            $q->where('location', 'like', "%{$location}%");
        });

        $query->when($category !== '', fn($q) => $q->where('category', $category));

        $query->when(!empty($categories), function ($q) use ($categories) {
            $q->whereIn('category', $categories);
        });

        $query->when($date !== '', function ($q) use ($date) {
            $now = Carbon::now();

            switch ($date) {
                case 'today':
                    $q->whereDate('date_time', $now->toDateString());
                    break;
                case 'week':
                    $q->whereBetween('date_time', [$now, $now->copy()->addDays(7)]);
                    break;
                case 'month':
                    $q->whereBetween('date_time', [$now->copy()->startOfMonth(), $now->copy()->endOfMonth()]);
                    break;
                case 'weekend':
                    $start = $now->copy()->startOfDay();
                    while ($start->dayOfWeek !== Carbon::SATURDAY) $start->addDay();
                    $end = $start->copy()->addDay()->endOfDay();
                    $q->whereBetween('date_time', [$start, $end]);
                    break;
            }
        });

        // explicit calendar date overrides presets (if from is set)
        if ($from) {
            $fromDate = Carbon::parse($from)->startOfDay();
            $toDate = $to ? Carbon::parse($to)->endOfDay() : Carbon::parse($from)->endOfDay();
            $query->whereBetween('date_time', [$fromDate, $toDate]);
        }

        $events = $query->orderBy('date_time', 'desc')->get();

        // joined ids for current user (used both in full page and in AJAX partial)
        $joinedPartyIds = [];
        if (auth()->check()) {
            $joinedPartyIds = auth()->user()->parties()->pluck('parties.id')->all();
        }

        if ($request->ajax()) {
            return view('parties._events_grid', compact('events', 'joinedPartyIds'));
        }

        return view('parties.index', compact('events', 'joinedPartyIds'));
    }

    public function create()
    {
        return view('parties.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'date_time' => 'required|date',
            'category' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('parties', 'public');
        }

        Party::create([
            'title' => $request->title,
            'description' => $request->description,
            'location' => $request->location,
            'date_time' => $request->date_time,
            'category' => $request->category,
            'image' => $imagePath ? '/storage/' . $imagePath : null,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('dashboard')->with('success', 'Dogodek uspešno ustvarjen!');
    }


    public function show(Party $party)
    {
        $party->loadCount('attendees');
        return view('parties.show', compact('party'));
    }

    public function join(Party $party, Request $request)
    {
        $party->attendees()->syncWithoutDetaching([auth()->id()]);

        if ($request->ajax()) {
            return response()->json([
                'ok' => true,
                'joined' => true,
                'party_id' => $party->id,
                'attendees_count' => $party->attendees()->count(),
            ]);
        }

        return back()->with('success', 'Prijavljen si na dogodek!');
    }

    public function leave(Party $party, Request $request)
    {
        $party->attendees()->detach(auth()->id());

        if ($request->ajax()) {
            return response()->json([
                'ok' => true,
                'joined' => false,
                'party_id' => $party->id,
                'attendees_count' => $party->attendees()->count(),
            ]);
        }

        return back()->with('success', 'Odjavljen si z dogodka.');
    }

}