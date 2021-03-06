<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use App\Topic;
use App\Post;
class User extends Authenticatable
{
    use Notifiable,HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    //protected $appends = ['avatar'];

    protected $fillable = [
        'username', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    // public function getAvatarAttribute(){
    //     return $this->avatar();
    // }

    public function avatar()
    {
        return 'https://gravatar.com/avatar/'.md5($this->email).'?s=45&d=mm';
    }

    public function ownsTopic(Topic $topic)
    {
        return $this->id === $topic->user->id;
    }

    public function ownsPost(Post $post)
    {
        return $this->id === $post->user->id;
    }

    public function hasLikedPost(Post $post)
    {
        return $post->likes->where('user_id', $this->id)->count() == 1;
    }

}
