<?php

namespace App\Providers;

use App\Models\User;
use App\Services\Newsletter;
use App\Services\MailchimpNewsletter;
use http\Env\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use MailchimpMarketing\ApiClient;
use Mockery\Matcher\Closure;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
//    public function register()
//    {
//        app()->bind(Newsletter::class, function () {
////            $client = (new ApiClient)->setConfig([
////                'apiKey' => config('services.mailchimp.key'),
////                'server' => 'us6'
////            ]);
////
////            return new MailchimpNewsletter($client);
//        });
//    }

    /**
     * Bootstrap any application services.
     *
     * @param  \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return void
     * @return mixed
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        Model::unguard();

        Gate::define('admin', function (User $user) {
            return $user->is_admin;
        });

        Blade::if('admin', function () {
            return request()->user()?->can('admin');
        });
    }
}
