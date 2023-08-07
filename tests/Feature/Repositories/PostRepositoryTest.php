<?php

namespace Tests\Feature\Repositories;

use App\Models\Post;
use App\Repositories\Contracts\PostRepositoryInterface;
use App\Repositories\PostRepository;
use App\Services\PostService;
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

     public function createPost()
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
   
}
