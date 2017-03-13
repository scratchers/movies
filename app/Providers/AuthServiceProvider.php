<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\{Movie,Group,Tag,Bookmark};
use App\Policies\{MoviePolicy,GroupPolicy,TagPolicy,BookmarkPolicy};

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
        Bookmark::class => BookmarkPolicy::class,
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
