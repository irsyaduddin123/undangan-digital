<?php

use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\InvitationController;
use App\Http\Controllers\Admin\InvitationGuestController;
use App\Http\Controllers\Customer\DashboardController as CustomerDashboardController;
use App\Http\Controllers\Customer\InvitationGuestController as CustomerInvitationGuestController;
use App\Http\Controllers\Customer\RSVPController as CustomerRSVPController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicInvitationController;
use App\Http\Controllers\RSVPController;
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

        // Gallery
        Route::get('/invitations/{invitation}/galleries', [
            GalleryController::class,
            'index'
        ])->name('invitations.galleries.index');

        Route::post('/invitations/{invitation}/galleries', [
            GalleryController::class,
            'store'
        ])->name('invitations.galleries.store');

        Route::delete('/galleries/{gallery}', [
            GalleryController::class,
            'destroy'
        ])->name('galleries.destroy');


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

        // Invitation Guests
        Route::get('/invitation-guests', [InvitationGuestController::class, 'index'])
            ->name('invitation-guests.index');

        Route::get('/invitation-guests/{invitation}', [InvitationGuestController::class, 'guests'])
            ->name('invitation-guests.guests');

        Route::post('/invitation-guests/{invitation}', [InvitationGuestController::class, 'store'])
            ->name('invitation-guests.store');

        Route::delete('/invitation-guests/{invitation}/guest/{invitationGuest}', [InvitationGuestController::class, 'destroy'])
            ->name('invitation-guests.destroy');

    });



/*
|--------------------------------------------------------------------------
| Customer Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:customer'])
    ->prefix('customer')
    ->name('customer.')
    ->group(function () {

        Route::get('/dashboard', [
            CustomerDashboardController::class,
            'index'
        ])->name('dashboard');

        Route::get('/undangan-saya', [
            CustomerDashboardController::class,
            'invitations'
        ])->name('invitations');
        Route::get('/daftar-tamu', [
            CustomerInvitationGuestController::class,
            'index'
        ])->name('guests');

        Route::get('/daftar-tamu/tambah', [
            CustomerInvitationGuestController::class,
            'create'
        ])->name('guests.create');

        Route::post('/daftar-tamu/tambah', [
            CustomerInvitationGuestController::class,
            'store'
        ])->name('guests.store');

        Route::get('/rekap-rsvp', [
            CustomerDashboardController::class,
            'rsvp'
        ])->name('rsvp');

        Route::get('/rekap-rsvp', [
            CustomerRSVPController::class,
            'index'
        ])->name('rsvp');

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


Route::get('/undangan/{invitation:slug}/tamu/{invitationGuest:slug}', [
    PublicInvitationController::class,
    'showGuest'
])->name('invitation.guest.show');

Route::post(
    '/undangan/{invitation:slug}/tamu/{invitationGuest:slug}/rsvp',
    [RSVPController::class, 'store']
)->name('invitation.guest.rsvp');


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

require __DIR__ . '/auth.php';
