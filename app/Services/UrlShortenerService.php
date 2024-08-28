<?php

namespace App\Services;

use App\Models\Url;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class UrlShortenerService {
    public function generateShortUrl($originalUrl)
    {
        $shortenedUrl = Str::random(6);

        // Ensure the shortened URL is unique
        while (Url::where('shortened_url', $shortenedUrl)->exists()) {
            $shortenedUrl = Str::random(6);
        }

        return $shortenedUrl;
    }

    public function createShortenedUrl($user,$originalUrl)
    {
        $shortenedUrl = $this->generateShortUrl($originalUrl);

        return Url::create([
            'user_id' => $user->id,
            'original_url' => $originalUrl,
            'shortened_url' => $shortenedUrl,
        ]);
    }
}
