<?php

namespace App\Http\Repository;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Models\Category;
use App\Models\Files;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;

class CategoryRepository
{
    public function create($request)
    {
        $category = Category::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'hashtags'=> $request->input('hashtags'),
        ]);
        Cache::forget('user:candies:'.Auth::user()->id);

        return  [
            "success" => true,
            'candy' => $category->link
        ];
    }

    public function show($id)
    {
        $category = Cache::remember('category:'.$id, Carbon::now()->addHours(env('REDIS_CACHE_HOURS')), function () use ($id) {
            $category = Category::
            where('id', $id)
            ->first();
            return $category;
        });
        return $category;
    }

    public function list()
    {
        $category = Cache::remember('categories', Carbon::now()->addHours(env('REDIS_CACHE_HOURS')), function () {
            $category = Category::
            where('active', true)
            ->orderBy('title', 'ASC')
            ->get();
            return $category;
        });
        return $category;
    }

}
