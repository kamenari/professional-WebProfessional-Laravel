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

    public function images()
    {   
        // Tweetモデルから交差テーブル(tweet_images)を利用したImageモデルとの紐付け
        return $this->belongsToMany(Image::class, 'tweet_images')->using(TweetImage::class);
    }
}
