<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ZoomController;
use Laravel\Socialite\Facades\Socialite;



Route::get('/test', function () {
dd(storage_path('app/public'));
});

        Route::get('/auth/redirect', function () {
            return Socialite::driver('google')->redirect();
        })->name('googel.redirect');



        Route::get('/auth/callback', function () {
            try {
                $socialiteUser = Socialite::driver('google')->user();
                $user = User::where('email', $socialiteUser->getEmail())->first();

                if ($user) {
                    Auth::login($user);

                    if (Auth::user()->department == 2) {
                        return redirect()->route('crm.employ.main');
                    } elseif (Auth::user()->department == 3) {
                        return redirect()->route('crm.employ.main');
                    } else {
                        return redirect()->route('crmCompany');
                    }
                } else {
                    return redirect()->route('login')->with('error', 'User not found.');
                }
            } catch (\Throwable $th) {
                return redirect()->route('login')->with('error', 'Authentication failed. Please register first.');
            }
        })->name('google.callback');

        Route::middleware(['auth','admin'])->prefix('zoom')->group(function () {
            Route::get('/',          [ZoomController::class, 'index'])         ->name('zoom.index');
            Route::get('/show',  [ZoomController::class, 'access_tocken'])->name('zoom.access_tocken');
            Route::get('/view/{zoom}',  [ZoomController::class, 'view'])->name('zoom.view');
            Route::get('/create',         [ZoomController::class, 'create'])        ->name('zoom.create');
            Route::post('/store',         [ZoomController::class, 'store'])        ->name('zoom.store');

            Route::get('/edit/{meeting}',         [ZoomController::class, 'edit'])        ->name('zoom.edit');
            Route::put('/update/{meetingId}',         [ZoomController::class, 'update'])        ->name('zoom.update');

            Route::delete('/delete/{meetingId}',         [ZoomController::class, 'delete'])        ->name('zoom.delete');

        });
        Route::middleware(['auth','employ'])->prefix('zoom')->group(function () {
            Route::get('/users',          [ZoomController::class, 'zoomUsers'])         ->name('zoom.users');

        });

Route::middleware(['setLocale'])->group(function () {
            Route::view('dashboard', 'dashboard')->middleware(['auth', 'verified'])->name('dashboard');
            Route::view('profile', 'profile')->middleware(['auth'])->name('profile');

            Route::get('/', function () {
                return view('home');
            });

            require __DIR__.'/auth.php';
            require __DIR__.'/crm.php';

         });


Route::get('payment', [\App\Http\Controllers\MyFatoorahController::class, 'index']);
Route::get('payment/callback', [\App\Http\Controllers\MyFatoorahController::class, 'callback']);
Route::get('payment/error', [\App\Http\Controllers\MyFatoorahController::class, 'error']);





