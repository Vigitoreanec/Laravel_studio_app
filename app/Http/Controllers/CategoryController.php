<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Master;
use App\Models\Service;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');
        // Ищем категории, в названии которых есть совпадения
        $categories = Category::where('name', 'like', "%{$query}%")
            ->with('services')->get();

        $categoriesId = $categories->pluck('id');
        $services = Service::whereIn('category_id', $categoriesId)->get();
        //dd($services);
        return view('categories.index', compact('categories', 'query'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category, Master $master)
    {
        $masters = Master::join('services', 'masters.id', '=', 'services.master_id')
        ->where('services.category_id', $category->id)
        ->select('masters.*')
        ->distinct() // Important for SQLite
        ->get();
        $services = $master->services()->where('category_id', $category->id)->get();
        //$masters = $category->masters()->with('services')->get();

        //dd($masters);
        return view('categories.show', compact('masters', 'category', 'services'));
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::with('services.masters')->get();
        return view('categories.index', compact('categories'));
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
    public function store(Request $request)
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
