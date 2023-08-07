<?php

namespace App\Repositories\Contracts;

interface PostRepositoryInterface
{
    public function getAllPostsDesc();

    public function createPost(array $post);

}