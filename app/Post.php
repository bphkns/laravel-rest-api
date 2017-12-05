<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Topic;
use App\User;
use App\Traits\Orderable;
use App\Like;

class Post extends Model
{
    use Orderable;
    protected $fillable = ['body'];

    public function topic()
    {
       return $this->belongsTo(Topic::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function likes(){
        return $this->morphMany(Like::class,'likeable');
    }
}
