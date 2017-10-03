<?php

use App\Post;
use Carbon\Carbon;

class PostListTest extends FeaturesTestCase
{

    function test_a_user_see_the_post_list_and_go_to_the_details()
    {
        //Having
        $post = $this->createPost([
            'title' => '¿Debo usar Laravel 5.5 LTS Laravel 5.1 LTS?'
        ]);

        //When
        $this->visit('/')
            ->seeInElement('h1', 'Posts')
            ->see($post->title)
            ->click($post->title)
            ->seePageIs($post->url);
    }

    function test_the_posts_are_paginated()
    {
        //Having
        $first = factory(Post::class)->create([
            'title' => 'El post mas antiguo',
            'created_at' => Carbon::now()->subDays(2)
        ]);

        $posts = factory(Post::class)->times(15)->create([
            'created_at' => Carbon::now()->subDays(1)
        ]);

        $last = factory(Post::class)->create([
            'title' => 'El post mas reciente',
            'created_at' => Carbon::now()
        ]);

        // dd($posts->toArray());

        //When
        $this->visit('/')
            ->see($last->title)
            ->dontSee($first->title)
            ->click('2')
            ->see($first->title)
            ->dontSee($last->title);
    }
}
