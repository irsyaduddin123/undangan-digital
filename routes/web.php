
<?php

use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\InvitationController;
use App\Http\Controllers\Customer\DashboardController as CustomerDashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicInvitationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\TemplateController;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/



Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Dashboard
        Route::get('/dashboard', [
            DashboardController::class,
            'index'
        ])->name('dashboard');

        //customer
        Route::get('/customers', [CustomerController::class, 'index'])->name('customers.index');

        Route::get('/customers/{user}', [CustomerController::class, 'show'])->name('customers.show');


        // Template
        Route::get('/templates', [
            TemplateController::class,
            'index'
        ])->name('templates.index');

        Route::get('/templates/create', [
            TemplateController::class,
            'create'
        ])->name('templates.create');

        Route::post('/templates', [
            TemplateController::class,
            'store'
        ])->name('templates.store');

        Route::get('/templates/{template}/edit', [
            TemplateController::class,
            'edit'
        ])->name('templates.edit');

        Route::put('/templates/{template}', [
            TemplateController::class,
            'update'
        ])->name('templates.update');

        Route::delete('/templates/{template}', [
            TemplateController::class,
            'destroy'
        ])->name('templates.destroy');

        // Invitation
        Route::get('/invitations', [
            InvitationController::class,
            'index'
        ])->name('invitations.index');

        Route::get('/invitations/create', [
            InvitationController::class,
            'create'
        ])->name('invitations.create');

        Route::post('/invitations', [
            InvitationController::class,
            'store'
        ])->name('invitations.store');

        Route::get('/invitations/{invitation}/edit', [
            InvitationController::class,
            'edit'
        ])->name('invitations.edit');

        Route::put('/invitations/{invitation}', [
            InvitationController::class,
            'update'
        ])->name('invitations.update');

        Route::delete('/invitations/{invitation}', [
            InvitationController::class,
            'destroy'
        ])->name('invitations.destroy');

            });


/*
|--------------------------------------------------------------------------
| Customer Routes
|--------------------------------------------------------------------------
*/

/*Route::middleware(['auth', 'role:customer'])
    ->prefix('customer')
    ->name('customer.')
    ->group(function () {

        Route::get('/dashboard', [
            CustomerDashboardController::class,
            'index'
        ])->name('dashboard');

    });


/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/undangan/{invitation:slug}', [
    PublicInvitationController::class,
    'show'
])->name('invitation.show');


/*
|--------------------------------------------------------------------------
| Profile Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/profile', [
        ProfileController::class,
        'edit'
    ])->name('profile.edit');

    Route::patch('/profile', [
        ProfileController::class,
        'update'
    ])->name('profile.update');

    Route::delete('/profile', [
        ProfileController::class,
        'destroy'
    ])->name('profile.destroy');

});


/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';
