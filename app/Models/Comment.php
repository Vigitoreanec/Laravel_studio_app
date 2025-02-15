<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

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
