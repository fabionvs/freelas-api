<?php

namespace App\Http\Repository;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Models\Candy;
use App\Models\Chain;
use App\Models\Files;
use App\Models\CandyTransaction;
use App\Models\CandyMint;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;

class CandyRepository
{
    public function create($request)
    {
        $candy = Candy::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'hashtags'=> $request->input('hashtags'),
            'website'=> $request->input('website'),
            'explicit'=> $request->input('explicit'),
            'public_chat'=> $request->input('public_chat'),
            'community'=> $request->input('community'),
            'user_id' => Auth::user()->id,
            'properties' => $request->input('properties'),
            'stats' => $request->input('stats'),
            'levels' => $request->input('levels'),
            'category_id' => $request->input('category_id'),
            'link' => strtolower(str_replace(" ", "-", $request->input('title')))
        ]);
        Cache::forget('user:candies:'.Auth::user()->id);
        foreach($request->input('files') as $file){
            $f = Files::where('name', $file)->where('user_id', Auth::user()->id)->first();
            if($f){
                $f->candy_id = $candy->id;
                $f->save();
            }
        }

        Cache::forget('user:candies:'.Auth::user()->id);

        return  [
            "success" => true,
            'candy' => $candy->link
        ];
    }

    public function show($id, $request)
    {
        $candy = Cache::remember('business:'.$id, Carbon::now()->addHours(env('REDIS_CACHE_HOURS')), function () use ($id, $request) {
            $candy = Candy::with('files')
            ->with('category')
            ->with('user')
            ->where('link', $id)
            ->first();
            if($candy !== null) {
                $candyTransactions = CandyTransaction::where('candy_id', $candy->id)->count();
                $candy->setAttribute('transactions_count', $candyTransactions);

                $candyMinted = CandyMint::where('candy_id', $candy->id)->sum('amount');
                $candy->setAttribute('minted_count', $candyMinted);

                $candy->makeVisible(['created_at', 'description', 'levels', 'properties', 'stats', 'public_chat', 'hashtags', 'website']);
            }
            return $candy;
        });
        if($candy !== null) {
            $userChainHasMint = CandyMint::where('candy_id', $candy->id)->where('chain_id', $request->input('chain_id'))->first();
            $candy->setAttribute('user_chain_has_mint', ($userChainHasMint !== null) ? true : false);
        }
        return $candy;
    }

    public function complete($id, $request)
    {
        $candy = Cache::remember('candy:complete:'.$id, Carbon::now()->addHours(env('REDIS_CACHE_HOURS')), function () use ($id, $request) {
            $chains = Chain::get();
            $transaction = [];
            $candy = Candy::
            where('link', $id)
            ->first();
            if($candy !== null) {
                foreach($chains as $chain){
                    $lastTransaction = CandyTransaction::with('chain')
                    ->where('candy_id', $candy->id)
                    ->where('chain_id', $chain->id)
                    ->orderBy('id', 'DESC')
                    ->first();
                    if($lastTransaction !== null){
                        $transaction[] = $lastTransaction;
                    }
                }
            }
            return [
                'transaction' => $transaction,
            ];
        });
        return $candy;
    }

    public function search($request)
    {
        $candy = Cache::remember('candy:search:'.md5(json_encode($request->all())), Carbon::now()->addHours(env('REDIS_CACHE_HOURS')), function () use ($request) {
            $candy = Candy::with('files')
            ->with('category')
            ->where('active', true);
            if($request->input('category') !== null){
                $candy->whereHas('category', function ($query) use ($request) {
                    return $query->where('id', $request->input('category'));
                });
            }
            if($request->input('chains') !== null){
                $candy->whereHas('lastPrice', function ($query) use ($request) {
                    return $query->whereIn('chain_id', $request->input('chains'));
                });
            }
            if($request->input('keywords') !== null){
                $keywords = explode(' ', $request->input('keywords'));
                foreach($keywords as $word){
                    $candy->where('hashtags', 'LIKE', '%'.$word.'%');
                }
            }
            return $candy->paginate();
        });
        return $candy;
    }

}
