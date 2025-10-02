<?php

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Livewire\Settings\TwoFactor;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use App\Http\Controllers\ToolController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\ProductController;


Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');

    Route::get('settings/two-factor', TwoFactor::class)
        ->middleware(
            when(
                Features::canManageTwoFactorAuthentication()
                    && Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword'),
                ['password.confirm'],
                [],
            ),
        )
        ->name('two-factor.show');

    // CRUD de herramientas
    Route::resource('tools', ToolController::class);
            
    // CRUD de inventario (para ver historial de préstamos)
    Route::resource('inventories', InventoryController::class)->only(['index', 'show']);
            
    // Ruta especial: prestar herramienta
    Route::post('/tools/{tool}/prestar', [ToolController::class, 'prestar'])->name('tools.prestar');
            
    // Ruta especial: devolver herramienta (va en InventoryController)
    Route::post('/inventories/{inventory}/devolver', [InventoryController::class, 'devolver'])->name('inventories.devolver');

    // Resource
    Route::resource('products', ProductController::class);

    // Ruta para prestar (descontar stock)
    Route::post('products/{product}/prestar', [ProductController::class, 'prestar'])->name('products.prestar');
});

require __DIR__.'/auth.php';
