<?php

namespace App\Http\Services;
use Elliptic\EC;
use Illuminate\Support\Str;
use kornrunner\Keccak;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Models\Candy;
use App\Models\Files;
use App\Http\Repository\UserCandyRepository;

class UserCandyService
{
    public function __construct(UserCandyRepository $userCandyRepository)
    {
        $this->userCandyRepository = $userCandyRepository;
    }

    public function manage($id)
    {
        return $this->userCandyRepository->manage($id);
    }

    public function wallet()
    {
        return [
            'wallet' => $this->userCandyRepository->wallet(), 
            'manage' => $this->userCandyRepository->manageList()
        ];
    }

    public function changeChain($request)
    {
        return $this->userCandyRepository->manage($id);
    }
}
