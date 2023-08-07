<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Resources\PostResource;
use App\Services\PostService;
use Illuminate\Http\Request;

class PostController extends Controller
{
    protected $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }
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
    public function index()
    {
        //
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
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
