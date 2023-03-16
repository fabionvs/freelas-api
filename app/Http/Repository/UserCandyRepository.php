<?php

namespace App\Http\Repository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Models\Candy;
use App\Models\CandyTransaction;
use App\Models\Files;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redis;

class UserCandyRepository
{
    public function manage($id)
    {
        $candy = Candy::with('files')->where('id', $id)->where('user_id', Auth::user()->id)->first();
        return  [
            "success" => true,
            'candy' => $candy
        ];
    }

    public function manageList()
    {
        $chain = Redis::get('user:chain:'.Auth::user()->id);
        $candy = Cache::remember('user:candies:'.Auth::user()->id.':'.$chain, Carbon::now()->addHours(env('REDIS_CACHE_HOURS')), function () {
            return Candy::with('files')->with('lastPrice')->where('user_id', Auth::user()->id)->get();
        });
        return $candy;
    }

    public function wallet()
    {
        $chain = Redis::get('user:chain:'.Auth::user()->id);
        $candy = Cache::remember('user:wallet:'.Auth::user()->id.':'.$chain, Carbon::now()->addHours(env('REDIS_CACHE_HOURS')), function () use ($chain) {
            return CandyTransaction::with('candy.files')
            ->with(['candy.lastPrice' => function ($q) use ($chain) {
                $q->where('chain_id', $chain)->first();
            }])
            ->selectRaw("sum(case type when 'buy' then amount when 'sell' then -amount end) as total, candy_id")
            ->where('wallet', Auth::user()->eth_address)
            ->groupBy('candy_id')
            ->get();
        });
        return $candy;
    }

    public function changeChain($request)
    {
        Redis::set('user:chain:'.Auth::user()->id, $request->input('chain_id'));
        return $candy;
    }
}
