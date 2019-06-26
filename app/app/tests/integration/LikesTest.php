<?php

class LikesTest extends TestCase
{
    /** @test */
    public function a_user_can_like_a_post()
    {
        factory(App\Post::class)->create();

        $user = factory(App\User::class)->create();

        $this->actingAs($user);

        $post->like();

        $this->seeInDatabase('likes', [
           'user_id' => $user->id,
           'likeable_id' => $post->id,
           'likeable_type' => get_class($post)
        ]);
    }
}