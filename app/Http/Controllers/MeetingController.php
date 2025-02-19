<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Master;
use App\Models\Meeting;
use App\Models\Service;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class MeetingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Master $master, Service $service)
    {

        return view('meetings.create', compact('master', 'service'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Master $master, Service $service)
    {
        $request->validate([
            'datetime' => 'required|date',
            'client_id' => 'requered',
            'master_id' => 'requered'
        ]);

        $idClient = Auth()->user()->id;
        //dd($idClient);

        Meeting::updateOrCreate([
            'client_id' => $idClient,
            'master_id' => $master->id,
            'service_id' => $service->id,
            'datetime' => $request->datetime,
            'status' => 'pending'
        ]);

        return redirect()->route('index')->with('success', 'Запись успешно создана!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
