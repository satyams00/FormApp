<?php
use App\Http\Controllers\JobController;



Route::middleware('admin')->group(function () {

    Route::get('/create', [JobController::class, 'create'])->name('jobs.create');
    Route::get('/{job}/edit', [JobController::class, 'edit'])->name('job.edit');
    Route::patch('/{job}/update', [JobController::class, 'update'])->name('job.update');
    Route::delete('/{job}/delete', [JobController::class, 'destroy'])->name('jobs.delete');
    Route::post('', [JobController::class, 'store'])->name('jobs.store');
});

Route::get('', [JobController::class, 'index'])->name('jobs.index')->middleware('updateProfile');
Route::get('/{job}/apply', [JobController::class, 'apply'])->name('job.apply');
Route::get('/{job}/view-job', [JobController::class, 'viewJob'])->name('job.viewJob');





