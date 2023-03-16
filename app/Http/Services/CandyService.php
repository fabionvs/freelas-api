<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Models\Candy;
use App\Models\Files;
use App\Http\Repository\CandyRepository;
use App\Http\Repository\CandyTransactionRepository;

class CandyService
{
    public function __construct(CandyRepository $candyRepository, CandyTransactionRepository $candyTransactionRepository)
    {
        $this->candyRepository = $candyRepository;
        $this->candyTransactionRepository = $candyTransactionRepository;
    }

    public function search($request)
    {
        $candy = $this->candyRepository->search($request);
        return $candy;
    }

    public function create($request)
    {
        return $this->candyRepository->create($request);
    }

    public function show($id, $request)
    {
        $candy = $this->candyRepository->show($id, $request);
        return [
            'candy' => $candy,
        ];
    }

    public function transactions($id, $request)
    {
        $candyTransactions = $this->candyTransactionRepository->getCandyTransactions($id, $request);
        return [
            'transactions' => $candyTransactions
        ];
    }

    public function complete($id, $request)
    {
        $candyChains = $this->candyRepository->complete($id, $request);
        return $candyChains;
    }


}
