<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Master;
use App\Models\Meeting;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

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
     * Display the specified resource.
     */

    public function show(Master $master)
    {
        $services = $master->services;
        //$comments = $master->comments()->with('client')->get();
        //dd($comments);
        return view('masters.show', compact('master', 'services'));
    }

    /**
     * Show the form for creating a new resource.
     */

    public function create()
    {
        $categories = Category::all();
        //dd($categories);
        return view('masters.create', compact('categories'));
    }

    public function store(Request $request)
    {
        // Валидация данных
        $request->validate([
            'name' => 'required|string|min:5|max:255',
            'description' => 'required|string',
            'email' => 'required|string|min:5|max:150',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'categoryId' => 'nullable|exists:category,id',
            'price' => 'nullable|numeric|min:1000|max:5000'

        ]);

        //dd($category);
        //dd($request);

        $photoPath = '';
        if ($request->hasFile('image')) {
            $photoPath = $request->file('image')->store('images', 'public');
        }

        // Создание
        $master = Master::create([
            'name' => $request->name,
            'description' => $request->description,
            'email' => $request->email,
            'image' => $photoPath,
        ]);
        //dd($request);
        //dd($master->id);
        $ser = Service::create([
            'title' => fake()->realText(),
            'price' => $request->price,
            'category_id' => $request->category_id,
            'master_id' => $master->id
        ]);
        //dd($ser);
        return redirect()->route('master.management');
    }

    public function edit(Master $master)
    {
        return view('masters.edit', compact('master'));
    }

    public function editMeeting(Meeting $meeting)
    {
        return view('master.edit', compact('meeting'));
    }

    public function management()
    {
        $masters = Master::all();
        //dd($masters);
        return view('master.management', compact('masters'));
    }

    public function meetings(string $name)
    {
        //dd($name);
        $master = Master::where('name', $name)->first();
        //dd($master);

        $meetings = $master->meetings()->get();

        //dd($meetings);
        return view('master.meetings', compact('meetings'));
    }


    public function update(Request $request, Meeting $meeting)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,cancelled',
        ]);

        $meeting->update($request->only('status'));
        return redirect()->route('master.management')->with('success', 'Запись обновлена!');
    }

    public function updateMaster(Request $request, Master $master)
    {
        $request->validate([
            'name' => 'required|string|min:5|max:255',
            'description' => 'required|string',
            'email' => 'required|string|min:15|max:150',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $photoPath = $master->image;
        if ($request->hasFile('image')) {
            if ($photoPath) {
                Storage::disk('public')->delete($photoPath);
            }
            $photoPath = 'images/' . $request->file('image')->hashName();
            $request->file('images')->storeAs('public/images', $photoPath);
            //dd($photoPath);
        }

        $master->update([
            'name' => $request->name,
            'description' => $request->description,
            'email' => $request->email,
            'image' => $photoPath,
        ]);
        //dd($master);
        return redirect()->route('master.management')->with('success', 'Мастер успешно обновлен.');
    }

    public function destroyMaster(Master $master)
    {
        //dd($master->meetings());

        if ($master->image) {
            Storage::disk('public')->delete($master->image);
        }
        $master->services()->delete();
        $master->meetings()->delete();

        $master->delete();

        return redirect()->route('master.management')->with('success', 'Мастер успешно удален.');
    }

    public function destroy(Meeting $meeting)
    {
        $meeting->delete();
        return redirect()->back()->with('success', 'Запись удалена!');
    }

    public function confirmMeetings(Meeting $meeting)
    {
        //dd($meeting);
        $meeting->update(['status' => 'confirmed']);
        return redirect()->back()->with('success', 'Запись подтверждена!');
    }

    public function clients(Master $master)
    {
        //$meetings = $master->meetings()->with(['client', 'service.category'])->get();

        return view('masters.client', compact('master'));
    }

    public function export(Master $master)
    {
        // Получаем расписание посещений для мастера
        $meetings = $master->meetings()->with('client', 'service')->get();


        $data = [];
        $data[] = ['Дата и время', 'Клиент', 'Услуга'];

        foreach ($meetings as $meeting) {
            $data[] = [
                $meeting->datetime,
                $meeting->client->name,
                $meeting->service->title,
            ];
        }

        $filename = "master_{$master->id}.txt";
        $content = '';
        foreach ($data as $row) {
            $content .= implode("\t", $row) . "\n";
        }

        $headers = [
            'Content-Type' => 'text/plain',
            'Content-Disposition' => "attachment; filename=$filename",
        ];


        return Response::make($content, 200, $headers);
    }

    // public function storeComment(Request $request, Master $master)
    // {

    //     //dd($master);
    //     $request->validate([
    //         'content' => 'required|string|max:200'

    //     ]);

    //     $comment = Comment::create([
    //         'content' => $request->input('content'),
    //         'client_id' => auth()->id(),
    //         'commentable_id' => $master->id,
    //         'commentable_type' => Master::class,
    //     ]);

    //     //dd($comment);
    //     return redirect()->back()->with('success', 'Комментарий успешно добавлен!');
    // }
}
