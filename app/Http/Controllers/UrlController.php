<?php

namespace App\Http\Controllers;

use App\Models\Url;
use App\Services\UrlShortenerService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UrlController extends Controller
{
    protected UrlShortenerService $urlShortenerService;

    public function __construct(UrlShortenerService $urlShortenerService)
    {
        $this->urlShortenerService = $urlShortenerService;
    }

    /**
     * Return a list of URLs, of the logged-in user
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json(Auth::user()->urls()->paginate());
    }

    /**
     *
     * Add new URL
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'url' => 'required|url'
        ]);

        $url = $this->urlShortenerService->createShortenedUrl(Auth::user(), $request->url);

        return response()->json($url, 201);
    }

    /**
     *
     * Update URL
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Url $url
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Url $url)
    {

        $request->validate([
            'original_url' => 'required|url'
        ]);

        $url->update([
            'original_url' => $request->original_url
        ]);

        return response()->json($url);
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Url $url)
    {

        return response()->json($url);
    }

}
