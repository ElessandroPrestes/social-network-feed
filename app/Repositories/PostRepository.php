<?php

namespace App\Repositories;

use App\Models\Post;
use App\Repositories\Contracts\PostRepositoryInterface;

class PostRepository implements PostRepositoryInterface
{
    protected $modelPost;

    public function __construct(Post $post)
    {
        $this->modelPost = $post;
    }

    public function createPost(array $post)
    {
        return $this->modelPost->create($post);
    }

}