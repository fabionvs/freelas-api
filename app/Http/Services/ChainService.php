<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Models\Candy;
use App\Models\Files;
use App\Http\Repository\ChainRepository;

class ChainService
{
    public function __construct(ChainRepository $chainRepository)
    {
        $this->chainRepository = $chainRepository;
    }


    public function list()
    {
        $candyTransactions = $this->chainRepository->list();
        return [
            'chains' => $candyTransactions
        ];
    }


}
