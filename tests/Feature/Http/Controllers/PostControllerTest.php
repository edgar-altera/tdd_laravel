<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostControllerTest extends TestCase
{
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
}
