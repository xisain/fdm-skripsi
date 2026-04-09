<?php

namespace App\Http\Controllers;

use App\Models\team;
use App\Models\User;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teams = team::with('team_member.user')->get();

        return view('team.index', compact('teams'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();

        return view('team.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'team_name' => 'required|string|max:255',
            'explore_location' => 'required|string|max:255',
            'description' => 'nullable|string',
            'members' => 'required|array',
            'members.*.user_id' => 'required|exists:users,id',
            'members.*.role' => 'required|in:Ketua,Anggota',
        ]);

        $team = team::create([
            'team_name' => $validated['team_name'],
            'explore_location' => $validated['explore_location'],
            'description' => $validated['description'] ?? '',
        ]);

        foreach ($validated['members'] as $member) {
            $team->team_member()->create([
                'user_id' => $member['user_id'],
                'role' => $member['role'],
            ]);
        }

        return redirect()->route('team.index')->with('success', 'Tim berhasil dibuat');
    }

    /**
     * Display the specified resource.
     */
    public function show(team $team)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(team $team)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, team $team)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(team $team)
    {
        //
    }
}
