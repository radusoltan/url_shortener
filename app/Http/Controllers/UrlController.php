<?php

namespace App\Http\Controllers;

use App\Http\Resources\UrlResource;
use App\Models\Url;
use App\Services\UrlShortenerService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UrlController extends Controller
{

    /**
     * @var \App\Services\UrlShortenerService
     */
    protected UrlShortenerService $urlShortenerService;

    /**
     * @param \App\Services\UrlShortenerService $urlShortenerService
     */
    public function __construct(UrlShortenerService $urlShortenerService)
    {
        $this->urlShortenerService = $urlShortenerService;
    }

    /**
     *
     * Return a list of URLs, of the logged-in user
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return UrlResource::collection(Auth::user()->urls()->paginate());
    }

    /**
     * Store and short new URL
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \App\Http\Resources\UrlResource
     */
    public function store(Request $request)
    {
        $request->validate([
            'url' => 'required|url'
        ]);

        $url = $this->urlShortenerService->createShortenedUrl(Auth::user(), $request->url);

        return new UrlResource($url);
    }

    /**
     *
     * Update URL
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Url $url
     *
     * @return \App\Http\Resources\UrlResource
     */
    public function update(Request $request, Url $url)
    {

        $request->validate([
            'original_url' => 'required|url'
        ]);

        $url->update([
            'original_url' => $request->original_url
        ]);

        return new UrlResource($url);
    }

    /**
     *
     * Delete URL
     *
     * @param \App\Models\Url $url
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Url $url)
    {
        $url->delete();

        return response()->json(null, 204);
    }

    /**
     *
     * Show URL
     *
     * @param \App\Models\Url $url
     *
     * @return \App\Http\Resources\UrlResource
     */
    public function show(Url $url)
    {
        return new UrlResource($url);
    }

}
