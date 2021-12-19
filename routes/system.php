<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use Spatie\Permission\Models\Permission;

Route::prefix('system')->group(function () {
    Route::get('seed', function () {
        // Artisan::call('migrate --path=database/migrations/2021_09_29_174521_create_permission_tables.php');
        Artisan::call('db:seed');
        // notify()->success('Permission Tables Crated Successfully');
        return redirect('/');
    });

    Route::get('down', function () {
        Artisan::call('down');
        // notify()->success('Application maintance mood on successfully');
        return redirect('/');
    });

    Route::get('up', function () {
        Artisan::call('up');
        // notify()->success('Application maintance mood off successfully');
        return redirect('/');
    });

    Route::get('clear', function () {
        Artisan::call('optimize:clear');
        // notify()->success('Application cache cleared successfully');
        return redirect('home');
    });


    Route::get('permission/seed', function () {
        Permission::create(['name' => 'student setting']);
        Permission::create(['name' => 'student management']);
        Permission::create(['name' => 'waiver management']);
        Permission::create(['name' => 'attendance']);
        Permission::create(['name' => 'home work']);
        Permission::create(['name' => 'fee management']);
        Permission::create(['name' => 'payment management']);
        Permission::create(['name' => 'mcq qustions']);
        Permission::create(['name' => 'written qustions']);
        Permission::create(['name' => 'result management']);
        Permission::create(['name' => 'old questions']);
        Permission::create(['name' => 'sheet management']);
        Permission::create(['name' => 'sms settting']);
        Permission::create(['name' => 'website settting']);
        return 'Successfully created all the permissions';
    });
});
