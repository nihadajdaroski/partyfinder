<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Party;

class PartyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Party::latest()->get();

        return view('parties.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     */
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
            'image' => 'nullable|url',
        ]);

        Party::create([
            'title' => $request->title,
            'description' => $request->description,
            'location' => $request->location,
            'date_time' => $request->date_time,
            'category' => $request->category,
            'image' => $request->image ?? 'https://images.unsplash.com/photo-1506157786151-b8491531f063?auto=format&fit=crop&w=1200&q=70',
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('home')->with('success', 'Dogodek uspešno ustvarjen!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Party $party)
    {
        return view('parties.show', compact('party'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
