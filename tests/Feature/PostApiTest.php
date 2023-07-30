<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostApiTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test fetching all posts.
     *
     * @return void
     */
    public function testFetchAllPosts()
    {
        // Create some posts using factory
        $posts = Post::factory()->count(10)->create();

        // Send GET request to /api/v1/posts
        $response = $this->get('/api/v1/posts');

        // Assert status 200
        $response->assertStatus(200);

        // Assert that each post is in the response
        foreach ($posts as $post) {
            $response->assertJsonFragment([
                'id' => $post->id,
                'title' => $post->title,
            ]);
        }
    }
}
