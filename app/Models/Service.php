<?php

namespace App\Models;

use Database\Seeders\CategoriesTableSeeder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'price', 'category_id', 'master_id'];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function master()
    {
        return $this->belongsTo(Master::class);
    }
}
