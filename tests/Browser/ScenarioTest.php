<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\User;

class ScenarioTest extends DuskTestCase
{
    private static $firstTest = true;
    private static $admin;
    private static $user;

    public function setUp()
    {
        parent::setUp();
        if (static::$firstTest) {
            $this->artisan('migrate:refresh');
            $this->artisan('db:seed');
            static::$admin = User::find(1);
            $this->makeNewUser();
            static::$firstTest = false;
        }
    }

    private function makeNewUser()
    {
        static::$user = new User;
        static::$user->name = 'John';
        static::$user->email = 'john@example.com';
        static::$user->password = 'password';
    }

    public function testAdminCanCreateMovie()
    {
        $this->browse(function ($browser) {
            $browser->visit('/login')
                    ->type('email', static::$admin->email)
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
                    ->assertSee('film');
        });
    }

    /**
     * Test admin can logout.
     *
     * @return void
     */
    public function testAdminCanLogout()
    {
        $this->browse(function ($browser) {
            $browser->assertSee(static::$admin->name)
                    ->clickLink(static::$admin->name)
                    ->assertSee('Logout')
                    ->clickLink('Logout')
                    ->assertDontSee(static::$admin->name);
        });
    }

    public function testUserCanRegisterAndSeeFilm()
    {
        $this->browse(function ($browser) {
            $browser->visit('/register')
                    ->type('name', static::$user->name)
                    ->type('email', static::$user->email)
                    ->type('password', static::$user->password)
                    ->type('password_confirmation', static::$user->password)
                    ->press('Register')
                    ->assertPathIs('/home')
                    ->assertSee(static::$user->name)
                    ->visit('/movies')
                    ->assertSee('film')
                    ->clickLink('Logout');
        });
    }

    public function testAdminCanDestroyMovie()
    {
        $this->browse(function ($browser) {
            $browser->visit('/login')
                    ->type('email', static::$admin->email)
                    ->type('password', 'password')
                    ->press('Login')
                    ->visit('/movies')
                    ->assertSee('film')
                    ->clickLink('film')
                    ->assertPathIs('/movies/1')
                    ->clickLink('Edit')
                    ->assertPathIs('/movies/1/edit')
                    ->press('Delete')
                    ->assertPathIs('/movies')
                    ->assertDontSee('film')
                    ->clickLink('Logout');
        });
    }
}
