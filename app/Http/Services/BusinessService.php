<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Models\Candy;
use App\Models\Files;
use App\Http\Repository\BusinessRepository;
use App\Http\Repository\CandyTransactionRepository;

class CandyService
{
    public function __construct(BusinessRepository $candyRepository)
    {
        $this->candyRepository = $candyRepository;
    }

    public function search($request)
    {
        $candy = $this->candyRepository->search($request);
        return $candy;
    }


}
