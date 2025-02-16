<?php

namespace App\Http\Controllers;

use App\Models\Master;
use App\Models\Meeting;
use Illuminate\Http\Request;

class MasterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $masters = Master::all();
        return view('masters.index', compact('masters'));
    }

    /**
     * Show the form for creating a new resource.
     */


    /**
     * Display the specified resource.
     */
    public function show(Master $master)
    {
        $services = $master->services;
        return view('masters.show', compact('master', 'services'));
    }

    public function management()
    {

        return view('master.management');
    }

    public function meetings()
    {
        $meetings = Meeting::where('master_id', auth()->id())->get();
        return view('master.meetings', compact('meetings'));
    }

    public function edit(Meeting $meeting)
    {
        return view('master.meetings.edit', compact('meeting'));
    }

    public function update(Request $request, Meeting $meeting)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,cancelled',
        ]);

        $meeting->update($request->only('status'));
        return redirect()->route('master.meetings')->with('success', 'Запись обновлена!');
    }

    public function destroy(Meeting $meeting)
    {
        $meeting->delete();
        return redirect()->route('master.meetings')->with('success', 'Запись удалена!');
    }

    public function confirmMeetings(Meeting $meeting)
    {
        $meeting->update(['status' => 'confirmed']);
        return redirect()->back()->with('success', 'Запись подтверждена!');
    }

    public function clients(Master $master)
    {
        //$meetings = $master->meetings()->with(['client', 'service.category'])->get();

        return view('masters.client', compact('master'));
    }
}
