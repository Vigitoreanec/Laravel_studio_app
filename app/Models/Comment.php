<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Comment extends Model
{
    use HasFactory;
    //protected $randDate = Carbon::now()->subDays(rand(1,10));
    protected $fillable = ['content', 'client_id', 'commentable_id', 'commentable_type'];
    
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function commentable()
    {
        return $this->morphTo();
    }
}
