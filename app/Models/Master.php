<?php

namespace App\Models;

use Database\Seeders\CategoriesTableSeeder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Master extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'email', 'image'];

    public function category()
    {
        return $this->belongsTo(CategoriesTableSeeder::class);
    }

    public function services()
    {
        return $this->hasMany(Service::class);
    }

    public function meetings()
    {
        return $this->hasMany(Meeting::class);
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}
