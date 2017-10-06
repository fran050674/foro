<?php

use App\Post;

class PostIntegrationTest extends FeaturesTestCase
{

    function test_slug_is_generated_and_saved_to_the_database()
    {
       $post = $this->createPost([
            'title' => 'Como instalar Laravel'
        ]);

       // dd($post->toArray());

        /*   $this->seeInDatabase('posts', [
            'slug' => 'como-instalar-laravel'
        ]);*/

        // $this->assertSame('como-instalar-laravel', $post->slug);

        $this->assertSame(
            'como-instalar-laravel',
             $post->fresh()->slug
         );
    }

    function test_the_url_of_the_post_is_generated()
    {
        $user = $this->defaultUser();
        $post = factory(Post::class)->make();
        $user->posts()->save($post);

        $this->assertSame(
            $post->url,
            route('posts.show', [$post->id, $post->slug])
        );
    }
}
