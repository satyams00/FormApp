<?php
use App\Http\Controllers\UserController;






Route::get('', [UserController::class, 'index'])->name('users.index');
Route::get('/{user}', [UserController::class, 'show'])->name('users.profile');
Route::patch('/{user}/update', [UserController::class, 'update'])->name('user.profile.update');



