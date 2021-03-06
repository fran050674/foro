<?php

class ExampleTest extends FeaturesTestCase
{
   function test_basic_example()
    {
        $user = factory(App\User::class)->create([
            'name' => 'Francisco Javier',
            'email' => 'fran@correo.com',
        ]);

        $this->actingAs($user, 'api')
            ->visit('api/user')
            ->see('Francisco Javier')
            ->see('fran@correo.com');
    }
}
