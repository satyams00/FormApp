<?php
use App\Http\Controllers\ApplicationController;


Route::middleware('admin')->group(function () {
    Route::get('/viewRequest', [ApplicationController::class, 'viewRequest'])->name('application.viewRequest');
    Route::post('/{application}/accept', [ApplicationController::class, 'accept'])->name('application.accept');
    Route::post('/{application}/reject', [ApplicationController::class, 'reject'])->name('application.reject');
});

Route::post('/apply', [ApplicationController::class, 'store'])->name('application.store');
Route::get('/users/{user}', [ApplicationController::class, 'show'])->name('application.show');
Route::get('/{application}/edit', [ApplicationController::class, 'edit']);
Route::patch('/{application}/update', [ApplicationController::class, 'update'])->name('application.update');

