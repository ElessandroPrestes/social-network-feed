<?php

namespace App\Services;

use App\Repositories\PostRepository;

class PostService
{
    protected $postRepository;

    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function getAllPostsDesc()
    {
        return $this->postRepository->getAllPostsDesc();
    }

    public function createPost(array $post)
    {
        $imagePath = $post['image']->store('public');

        $post['image'] = $imagePath;

        return $this->postRepository->createPost($post);
    }

    public function getPostById(int $id)
    {
        return $this->postRepository->getPostById($id);
    }

    public function updatePost(int $id, array $post)
    {
        return $this->postRepository->updatePost($id, $post);
    }

}