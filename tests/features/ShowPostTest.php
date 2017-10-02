<?php

class ShowPostTest extends FeaturesTestCase
{
    function test_a_user_can_see_the_post_details()
    {
        //Having
        $user = $this->defaultUser([
            'name' => 'Francisco Andres',
        ]);

        $post = $this->createPost([
            'title' => 'Este es el titulo del post',
            'content' => 'Este es el contenido del post',
            'user_id' => $user->id,
        ]);

        // dd(\App\User::all()->toArray(), $post->user_id);

        // dd($post->url);

        //When
        $this->visit($post->url)
        ->seeInElement('h1', $post->title)
        ->see($post->content)
        ->see('Francisco Andres');
    }

    function test_old_url_are_redirected()
    {
        //Having
        $post = $this->createPost([
            'title' => 'Old title',
        ]);

        $url = $post->url;

        $post->update(['title' => 'New title']);

        $this->visit($url)
            ->seePageIs($post->url);
    }

/*    function test_post_url_with_wrong_slug_still_work()
    {
         //Having
        $user = $this->defaultUser();

        $post = factory(Post::class)->make([
            'title' => 'Old title',
        ]);

        $user->posts()->save($post);

        $url = $post->url;

        $post->update(['title' => 'New title']);

        $this->visit($url)
        ->assertResponseOk()
        ->see('New title');
    }*/
}
