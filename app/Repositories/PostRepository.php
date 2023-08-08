<?php

namespace App\Repositories;

use App\Models\Post;
use App\Repositories\Contracts\PostRepositoryInterface;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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

    public function getPostById(int $id)
    {
        try {
            
            return  $this->modelPost->where('id',$id)->firstOrFail();
            

        } catch (\Throwable $th ) {

            throw new NotFoundHttpException('Post Not Found');

        }
      
    }

    public function updatePost(int $id, array $post)
    {
        $edit = $this->getPostById($id);

        Cache::forget('post:all');

        return $edit->update($post);

    }

    public function deletePost(int $id)
    {
        $delete = $this->getPostById($id);

        Cache::forget('post:all');
        
        return $delete->delete();

    }


}