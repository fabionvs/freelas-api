<?php

namespace App\Http\Repository;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Models\CandyTransaction;
use App\Models\CandyMint;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class CandyTransactionRepository
{

    public function getCandyTransactions($id, $request)
    {
        $chain = $request->input('chain_id');
        $candy = Cache::remember('candy:transactions:'.$id.':'.$chain, Carbon::now()->addHours(env('REDIS_CACHE_HOURS')), function () use ($id, $chain) {
            return CandyTransaction::selectRaw('last_price, created_at')
            ->where('candy_id', $id)
            ->where('chain_id', $chain)
                ->orderBy('created_at', 'ASC')
                ->get();
        });

        return $candy;
    }

    public function getMintedTransactions($id)
    {   
        $chain = Redis::get('user:chain:'.Auth::user()->id);
        $candy = Cache::remember('candy:minted:'.$id.':'.$chain, Carbon::now()->addMinutes(10), function () use ($id, $chain) {
            $mints =  CandyMint::
            where('candy_id', $id)
            ->where('chain_id', $chain)
            ->sum('amount');
        });
        return $candy;
    }

}
