<?php

namespace App\Providers;

use App\Models\News;
use App\Models\Permission;
use App\Models\Question;
use App\Policies\NewsPolicy;
use App\Policies\QuestionPolicy;
use App\Policies\UserPolicy;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Schema;

use App\Extensions\AccessTokenGuard;
use App\Extensions\TokenToUserProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Auth::extend('access_token', function ($app, $name, array $config) {
			// automatically build the DI, put it as reference
			$userProvider = app(TokenToUserProvider::class);
			$request = app('request');

			return new AccessTokenGuard($userProvider, $request, $config);
		});

        if (Schema::hasTable('permissions')) {
            $permissions = Permission::with(['roles'])->get();

            foreach($permissions as $permission){
                Gate::define($permission->title, function(User $user) use ($permission){
                    return $user->hasPermission($permission);
                });
            }
        }
    }
}
