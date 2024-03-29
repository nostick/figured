<?php

namespace Tests\Feature;

use App\Models\Comment;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    public function testIndex()
    {
        $cesar = factory(User::class)->states('cesar')->create();

        $post = factory(Post::class)->create(['author_id' => $cesar->id]);
        factory(Post::class, 2)->create();
        factory(Comment::class, 3)->create(['post_id' => $post->id]);

        $this->get('/')
            ->assertOk()
            ->assertSee('Latest posts')
            ->assertSee(e($post->title))
            ->assertSee(humanize_date($post->posted_at))
            ->assertSee('3')
            ->assertSee('cesar');
    }

    public function testSearch()
    {
        factory(Post::class, 3)->create();
        $post = factory(Post::class)->create(['title' => 'Hello Obiwan']);

        $this->get('/?q=Hello')
            ->assertOk()
            ->assertSee('1 post found')
            ->assertSee(e($post->title))
            ->assertSee(humanize_date($post->posted_at));
    }

    public function testShow()
    {
        $post = factory(Post::class)->create();
        factory(Comment::class, 2)->create(['post_id' => $post->id]);
        factory(Comment::class)->create(['post_id' => $post->id]);

        $this->actingAsUser()
            ->get("/posts/{$post->slug}")
            ->assertOk()
            ->assertSee(e($post->content))
            ->assertSee(e($post->title))
            ->assertSee(humanize_date($post->posted_at))
            ->assertSee('3 comments')
            ->assertSee('Comment');
    }

    public function testShowUnauthenticated()
    {
        $post = factory(Post::class)->create();

        $this->get("/posts/{$post->slug}")
            ->assertOk()
            ->assertSee('You must be signed in to comment.');
    }
}
