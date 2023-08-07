<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Resources\PostResource;
use App\Services\PostService;
use Illuminate\Http\Request;

     /**
     * @OA\Info(
     *      title="Post API",
     *      version="1.0.0",
     *      description="API for Post",
     *      @OA\Contact(
     *          email="elessandrodev@gmail.com"
     *      ),
     *      @OA\License(
     *          name="MIT"
     *      )
     * )
     */
class PostController extends Controller
{
    protected $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

     /**
     * @OA\Get(
     *      path="/api/v1/posts",
     *      operationId="getAllPosts",
     *      tags={"Posts"},
     *      description="Return posts in descending order",
     *      @OA\Response(
     *          response=200,
     *          description="Posts Successfully listed."
     *       )
     *     ),
     *      @OA\Server(
     *          url="http://localhost:8000",
     * 
     *      )
     *
     *@return PostResource[]
     */
    public function index()
    {
        $posts = $this->postService->getAllPostsDesc();

        return response([
            'data' => PostResource::collection($posts),
            'message' => 'Posts Successfully listed'
        ], 200);
    }

    /**
    * @OA\Post(
    *      path="/api/v1/posts",
    *      tags={"Posts"},
    *      description="Create Post",
    *      @OA\RequestBody(
    *          required=true,
    *          @OA\JsonContent(
    *          type="object",
    *          @OA\Property(property="name", type="string", example="Thanos"),
    *          @OA\Property(property="image", type="string", example="https://example.com/thanos.jpg"),
    *          @OA\Property(property="description", type="string", example="A powerful villain obsessed with balance in the universe."),
    *       )
    *     ),
    *      @OA\Response(
    *          response=201, description="Post Register Successfully."
    *      )
    *     ),
    */
    public function store(StorePostRequest $request)
    {
        $post = $this->postService->createPost($request->validated());

        return response([
            'data'=>new PostResource($post),
            'message' => 'Post Register Successfully'
        ], 201);
    }

    /**
    * @OA\Get(
    *     path="/api/v1/posts/{id}", 
    *     tags={"Posts"},
    *     description="Retrieve a Post by ID.",
    *     operationId="getPostById",
    *     @OA\Parameter(
    *         name="ID", 
    *         in="path", 
    *         required=true, 
    *         description="ID of the post to be retrieved.",
    *         @OA\Schema(
    *             type="string" 
    *         )
    *     ),
    *     @OA\Response(
    *         response=200,
    *         description="Post Successfully listed.",
    *         @OA\JsonContent(
    *             type="object",
    *             @OA\Property(
    *                 property="id",
    *                 type="integer",
    *                 example=1
    *             ),
    *             @OA\Property(
    *                 property="name",
    *                 type="string",
    *                 example="Post Name"
    *             ),
    *               @OA\Property(
    *                 property="image",
    *                 type="file",
    *                 example="public/image.jpg",
    *             ),
    *             @OA\Property(
    *                 property="description",
    *                 type="string",
    *                 example="Post Description"
    *             ),
    *            
    *         )
    *     ),
    *     @OA\Response(
    *         response=404,
    *         description="Post Not Found"
    *     ),
    * )
    */
    public function show(int $id)
    {
        $post = $this->postService->getPostById($id);  

        return response([
            'data'     =>  new PostResource($post),
            'message'  =>  'Post Successfully listed'
       ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
