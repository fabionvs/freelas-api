<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Models\Candy;
use App\Models\Files;
use App\Http\Repository\CategoryRepository;
use App\Http\Repository\CandyTransactionRepository;

class CategoryService
{
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function create($request)
    {
        return $this->categoryRepository->create($request);
    }

    public function show($id)
    {
        $candy = $this->categoryRepository->show($id);
        $minted = $this->candyTransactionRepository->getMintedTransactions($id);
        return [
            'candy' => $candy,
            'minted' => $minted
        ];
    }

    public function list()
    {
        $candyTransactions = $this->categoryRepository->list();
        return [
            'categories' => $candyTransactions
        ];
    }


}
