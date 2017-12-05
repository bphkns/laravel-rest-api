<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Topic;
use App\Transformers\UserTransformer;
use App\Transformers\PostTransformer;

class TopicTransformer extends TransformerAbstract
{


    /**
     * A Fractal transformer.
     *
     * @return array
     */

     protected $availableIncludes = ['user','posts'];
    // protected $defaultIncludes = ['user'];
     
    public function transform( Topic $topic )
    {
        return [
            'id' => $topic->id,
            'title' => $topic->title,
            'created_at' => $topic->created_at->toDateTimeString(),
            'created_at_human' => $topic->created_at->diffForHumans(),
        ];
    }

    public function includeUser(Topic $topic)
    {
        return $this->item($topic->user,new UserTransformer());

    }
    public function includePosts(Topic $topic)
    {
        return $this->collection($topic->posts,new PostTransformer());

    }
}
