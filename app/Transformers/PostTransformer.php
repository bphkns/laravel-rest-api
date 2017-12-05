<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Post;
use App\Transformers\UserTransformer;

class PostTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */

    protected $availableIncludes = ['user','likes'];

    public function transform(Post $post)
    {
        return [
            'id' => $post->id,
            'body' => $post->body,
            'like_count' => $post->likes->count(),
            'created_at' => $post->created_at->toDateTimeString(),
            'created_at_human' => $post->created_at->diffForHumans(),
        ];
    }
    public function includeUser(Post $post)
    {
        return $this->item($post->user,new UserTransformer());

    }

    public function includeLikes(Post $post)
    {
       return $this->collection($post->likes->pluck('user'), new UserTransformer);
    }
}
