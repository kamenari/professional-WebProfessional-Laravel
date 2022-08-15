<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{
    use HasFactory;

    public function user()
    {   
        // TweetモデルからUserモデルへの関連付け
        return $this->belongsTo(User::class);
    }
}
