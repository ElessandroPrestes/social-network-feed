<?php

namespace Tests\Feature\Repositories;

use App\Models\Post;
use App\Repositories\Contracts\PostRepositoryInterface;
use App\Repositories\PostRepository;
use App\Services\PostService;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class PostRepositoryTest extends TestCase
{
    protected $postRepository;

    protected function setUp(): void
    {
        $this->postRepository = new PostRepository(new Post());

        parent::setUp();
    }

    /**
     * @test
     */
    public function implements_interface_post()
    {
        $this->assertInstanceOf(
                PostRepositoryInterface::class,
                $this->postRepository
        );
    }

    /**
     * @test
     */
    public function create_post_exception()
    {
        $this->expectException(QueryException::class);

        $post = [
            'image' => 'test.png',
        ];

        $this->postRepository->createPost($post);
        
    }
    /**
     * @test
     */

     public function create_post()
    {
        
        $image = imagecreatetruecolor(200, 200);

        $filename = tempnam(sys_get_temp_dir(), 'test_post') . '.png';

        imagepng($image, $filename);

        $data = [
            'name' => fake()->name,
            'image' => new UploadedFile($filename, 'test_post.png', 'image/png', null, true), 
            'description' => fake()->paragraph,
        ];

        $response = $this->postRepository->createPost($data);

        $this->assertArrayHasKey('id', $response);

        $this->assertArrayHasKey('image', $response);

        $this->assertEquals($response['name'], $data['name']);
    }

    /**
     * @test
     */
    public function get_all_posts_desc()
    {
        $post1  = Post::factory()->create(['created_at' => now()->subDays(2)]);

        $post2  = Post::factory()->create(['created_at' => now()->subDays(1)]);

        $post3  = Post::factory()->create(['created_at' => now()]);

        $posts = $this->postRepository->getAllPostsDesc();

        $this->assertCount(3, $posts);

        $this->assertEquals($post3->id, $posts[0]->id);

        $this->assertEquals($post2->id, $posts[1]->id);

        $this->assertEquals($post1->id, $posts[2]->id);
    }

     /**
      * @test
      */
      public function get_post_by_id()
      {
          $post = Post::factory()->create();
  
          $response = $this->postRepository->getPostById($post->id);
  
          $this->assertIsObject($response);
      }
   
}
