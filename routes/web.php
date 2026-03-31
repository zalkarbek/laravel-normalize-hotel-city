<?php

use App\Models\City;
use App\Models\Hotel;
use App\Services\HotelCityService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return view('test');
})->name('home');

Route::post('/normalize', function (Request $request, HotelCityService $hotelCityService) {
    $isNormalize = $request->input('is_normalize');

    $message = '';
    if ($isNormalize == 1) {
        $message = $hotelCityService->normalizeHotelCity();
    }

    if ($isNormalize == 0) {
        $message = $hotelCityService->rollbackHotelCity();
    }

    $hotels = Hotel::query()->with(['city'])->get();
    $cities = City::query()->with(['hotels'])->get();

    return response()->json([
        'message' => $message,
        'hotels' => $hotels,
        'cities' => $cities
    ]);
});

// Route::view('dashboard', 'dashboard')
//    ->middleware(['auth', 'verified'])
//    ->name('dashboard');
//
// Route::middleware(['auth'])->group(function () {
//    Route::redirect('settings', 'settings/profile');
//
//    Volt::route('settings/profile', 'settings.profile')->name('profile.edit');
//    Volt::route('settings/password', 'settings.password')->name('user-password.edit');
//    Volt::route('settings/appearance', 'settings.appearance')->name('appearance.edit');
//
//    Volt::route('settings/two-factor', 'settings.two-factor')
//        ->middleware(
//            when(
//                Features::canManageTwoFactorAuthentication()
//                    && Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword'),
//                ['password.confirm'],
//                [],
//            ),
//        )
//        ->name('two-factor.show');
// });
