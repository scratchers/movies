<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\User;

class ScenarioTest extends DuskTestCase
{
    private static $firstTest = true;

    public function setUp()
    {
        parent::setUp();
        if (static::$firstTest) {
            $this->artisan('migrate:refresh');
            $this->artisan('db:seed');
            static::$firstTest = false;
        }
    }

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
