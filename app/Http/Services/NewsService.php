<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Models\Candy;
use App\Models\Files;
use App\Http\Repository\NewsRepository;

class NewsService
{
    public function __construct(NewsRepository $newsRepository)
    {
        $this->newsRepository = $newsRepository;
    }

    public function search($request)
    {
        $candy = $this->newsRepository->search($request);
        return $candy;
    }

    public function create($request)
    {
        return $this->newsRepository->create($request);
    }

}
