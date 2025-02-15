<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Master;
use App\Models\Service;
use Illuminate\Http\Request;

class PageController extends Controller
{
    // Метод главной страницы
    public function home()
    {
        $masters = Master::with(['services.category'])->get();
        // Получаем уникальные категории из всех услуг всех мастеров
        $categories = Category::whereHas(
            'services.master',
            function ($query) {
                $query->where('masters.id', '!=', null);
            }
        )->get();
        //dd($categories);
        
        return view('home', [
            'masters' => $masters,
            'categories' => $categories
        ]);
    }
}
