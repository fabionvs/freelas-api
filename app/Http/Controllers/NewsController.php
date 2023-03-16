<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\NewsService;
use App\Http\Requests\CreateCandyRequest;

class NewsController extends Controller
{
    public function __construct(NewsService $newsService)
    {
        $this->newsService = $newsService;
    }

    public function search(Request $request){
        $candy = $this->newsService->search($request);
        return response($candy, 200);
    }

    public function create(Request $request){
        $candy = $this->newsService->create($request);
        return response($candy, 200);
    }

}
