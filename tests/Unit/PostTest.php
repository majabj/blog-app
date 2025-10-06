<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function post_can_be_created()
    {
        $user = User::factory()->create();

        $post = Post::create([
            'title' => 'My Test Post',
            'content' => 'Test content',
            'user_id' => $user->id,
        ]);

        $this->assertDatabaseHas('posts', ['title' => 'My Test Post']);
    }
}
