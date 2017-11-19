<?php

namespace Furbook\Providers;

use Furbook\User;
use Validator;
use Furbook\Validators\CustomValidator;
use Furbook\Observers\UserObserver;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(
            'partials.forms.cat', 'Furbook\Http\ViewComposers\CatFormComposer'
        );
        // Using class based composers...
        View::composer(
            'users.create', 'Furbook\Http\ViewComposers\UserFormComposer'
        );
        // Using class based composers...
//        view()->composer('users.create', function ($view) {
//            //dd(Breed::pluck('name', 'id'));
//            $view->breeds = Breed::pluck('name', 'id');
//        });
        User::observe(UserObserver::class);

        Validator::resolver(function ($translator, $data, $rules, $messages) {
            return new CustomValidator($translator, $data, $rules, $messages);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
