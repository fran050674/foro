<?php

use Illuminate\Support\Facades\Notification;

class WriteCommentTest extends FeaturesTestCase
{
    function test_a_user_can_write_a_comment()
    {
        //Having
        Notification::fake();

        $post = $this->createPost();

        $user = $this->defaultUser();


        $this->actingAs($user)
            ->visit($post->url)
            ->type('Un comentario', 'comment')
            ->press('Publicar comentario');

        $this->seeInDatabase('comments', [
            'comment' => 'Un comentario',
            'user_id' => $user->id,
            'post_id' => $post->id,
        ]);

        $this->seePageIs($post->url);
    }


    function test_write_comment_validation()
    {
        $post = $this->createPost();

        $user = $this->defaultUser();
        // dd($post->url);

        $this->actingAs($user)
        ->visit($post->url)
        ->press('Publicar comentario');
    }
}
