<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Master;
use Illuminate\Http\Request;

class CommentController extends Controller
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request,Master $master)
    {
        
        $request->validate([
            'content' => 'required|string|max:200',
            // 'commentable_id' => 'required|integer',
            // 'commentable_type' => 'required|string'
        ]);

        $comment = Comment::create([
            'content' => $request->input('content'),
            'client_id' => auth()->id(),
            'commentable_id' => $master->id,
            'commentable_type' => Master::class
        ]);
        //dd($comment);
        
        return redirect()->back()->with('success', 'Комментарий успешно добавлен!');
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
    public function update(Request $request, Comment $comment)
    {
        $request->validate([
            'content' => 'required|string|max:200'
        ]);

        $comment->update([
            'content' => $request->input('content')
        ]);

        return redirect()->back()->with('success', 'Комментарий успешно обновлен!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        //dd($comment);
        $comment->delete();
        return redirect()->back()->with('success', 'Комментарий успешно удален!');
    }
}
