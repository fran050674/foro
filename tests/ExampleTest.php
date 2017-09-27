<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{
    // use DatabaseMigrations;//es más lento,si tenemos muchas migraciones.
    use DatabaseTransactions;
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testBasicExample()
    {
        $user = factory(App\User::class)->create([
            'name' => 'Francisco Javier',
            'email' => 'fran@correo.com',
        ]);

        $this->actingAs($user, 'api');

        $this->visit('api/user')
             ->see('Francisco Javier')
             ->see('fran@correo.com');
    }
}
