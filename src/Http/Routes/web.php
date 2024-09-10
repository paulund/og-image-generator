<?php

\Illuminate\Support\Facades\Route::get('og-image', \Paulund\OgImageGenerator\Http\Controllers\OgImageController::class)
    ->name('og-image');
