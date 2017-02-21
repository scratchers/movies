<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\User;

class MovieTest extends DuskTestCase
{
    use DatabaseMigrations {
        runDatabaseMigrations as baseRunDatabaseMigrations;
    }

    /**
     * Define hooks to migrate the database before and after each test.
     *
     * @return void
     */
    public function runDatabaseMigrations()
    {
        $this->baseRunDatabaseMigrations();
        $this->artisan('db:seed');
    }

    /**
     * A basic browser test example.
     *
     * @return void
     */
    public function testAdminCanCreateAndDestroyMovie()
    {
        $admin = User::find(1);

        $this->browse(function ($browser) use ($admin) {
            $browser->visit('/login')
                    ->type('email', $admin->email)
                    ->type('password', 'password')
                    ->press('Login')
                    ->assertPathIs('/movies')
                    ->assertDontSee('film')
                    ->clickLink('Create New Movie')
                    ->assertPathIs('/movies/new')
                    ->press('Submit')
                    ->assertPathIs('/movies/create')
                    ->press('Submit')
                    ->assertPathIs('/movies/1')
                    ->assertSee('film')
                    ->assertSee('Edit')
                    ->visit('/movies')
                    ->assertSee('film')
                    ->clickLink('film')
                    ->assertPathIs('/movies/1')
                    ->clickLink('Edit')
                    ->assertPathIs('/movies/1/edit')
                    ->press('Delete')
                    ->assertPathIs('/movies')
                    ->assertDontSee('film');
        });
    }
}
