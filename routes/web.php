<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return ['Laravel' => app()->version()];
});

Route::get('/{shortenedUrl}', function ($shortenedUrl) {
    $url = \App\Models\Url::where('shortened_url', $shortenedUrl)->firstOrFail();
    return redirect($url->original_url);
});

require __DIR__.'/auth.php';
