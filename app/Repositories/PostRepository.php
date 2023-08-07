<?php

namespace App\Repositories;

use App\Models\Post;
use App\Repositories\Contracts\PostRepositoryInterface;
use Illuminate\Support\Facades\Cache;

class PostRepository implements PostRepositoryInterface
{
    protected $modelPost;

    public function __construct(Post $post)
    {
        $this->modelPost = $post;
    }

    public function getAllPostsDesc()
    {
        Cache::forget('post:all');
        
        return $this->modelPost->orderBy('created_at', 'desc')->get();
    }

    public function createPost(array $post)
    {
        return $this->modelPost->create($post);
    }

}