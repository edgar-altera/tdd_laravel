<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Symfony\Component\HttpFoundation\Response;

class PostControllerTest extends TestCase
{
    use WithFaker;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_guest()
    {
        $this->get('posts')->assertRedirect('login');         // index
        $this->get('posts/create')->assertRedirect('login');  // create
        $this->post('posts')->assertRedirect('login');        // store
        $this->get('posts/1')->assertRedirect('login');       // show
        $this->get('posts/1/edit')->assertRedirect('login');  // edit
        $this->put('posts/1')->assertRedirect('login');       // update
        $this->delete('posts/1')->assertRedirect('login');    // destroy
    }

    public function test_store()
    {
        $user = User::factory()->create();

        $post = Post::factory()->definition();

        // $post['user_id'] = $user->id;

        $this
            ->actingAs($user)
            ->post('posts', $post)
            ->assertRedirect('posts')
        ;

        $this->assertDatabaseHas('posts', $post);
    }

    public function test_update()
    {
        $user = User::factory()->create();

        $post = Post::factory()->create();

        $data = [
            'title' => $this->faker->sentence(3),
            'body'  => $this->faker->text(200),
        ];

        $this
            ->actingAs($user)
            ->put("posts/$post->id", $data)
            ->assertRedirect("posts/$post->id/edit")
        ;

        $this->assertDatabaseHas('posts', $data);
    }

    public function test_validate_store()
    {
        $user = User::factory()->create();

        $this
            ->actingAs($user)
            ->post('posts', [])
            ->assertStatus(Response::HTTP_FOUND)
            ->assertSessionHasErrors(['user_id', 'title', 'body'])
        ;
    }

    public function test_validate_update()
    {
        $user = User::factory()->create();

        $post = Post::factory()->create();

        $this
            ->actingAs($user)
            ->put("posts/$post->id", [])
            ->assertStatus(Response::HTTP_FOUND)
            ->assertSessionHasErrors(['title', 'body'])
        ;
    }

    public function test_destroy()
    {
        $user = User::factory()->create();

        $post = Post::factory()->create();

        $this
            ->actingAs($user)
            ->delete("posts/$post->id")
            ->assertRedirect('posts');
        ;

        $this->assertDatabaseMissing('posts', 
            [
                'id' => $post->id,
                'title' => $post->title,
                'body' => $post->body
            ]
        );
    }
}
