<?php

namespace App\Http\Repository;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Models\News;
use App\Models\Chain;
use App\Models\Files;
use App\Models\CandyTransaction;
use App\Models\CandyMint;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;

class CandyRepository
{

    public function search($request)
    {
        $news = Cache::remember('news', Carbon::now()->addHours(env('REDIS_CACHE_HOURS')), function () use ($request) {
            $news = News::limit(5)->orderBy('created_at', 'DESC');
            return $news->get();
        });
        return $news;
    }

    public function create($request)
    {
        $news = Candy::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'hashtags'=> $request->input('hashtags'),
            'website'=> $request->input('website'),
            'image'=> $request->input('image'),
            'link' => strtolower(str_replace(" ", "-", $request->input('title')))
        ]);
        Cache::forget('news');

        return  [
            "success" => true,
            'response' => $news
        ];
    }

}
