<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
		
		//Добавляем во все представления данные из таблици настроек
        try {
            $sets = DB::table('settings')->get();
            foreach($sets as $set)
            {
                $settings[$set->id]=$set->data;
            }
            View::share('settings', $settings);

            //Статусы людей сотрудник/стажер/уволеный
            $status_data = DB::table('status')->get();
            foreach($status_data as $set)
            {
                $status[$set->id]=$set->name;
            }
            View::share('status', $status);
        } catch (\Exception $e) {

        }
    }
}
