<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Movie;
use App\Policies\MoviePolicy;
use App\Group;
use App\Policies\GroupPolicy;
use App\Tag;
use App\Policies\TagPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Movie::class  => MoviePolicy::class,
        Group::class  => GroupPolicy::class,
        Tag::class    => TagPolicy::class,
        Filter::class => FilterPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::before(function ($user) {
            if ( $user->isAdmin() ) {
                return true;
            }
        });
    }
}
