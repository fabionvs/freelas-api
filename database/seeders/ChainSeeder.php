<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Chain;


class ChainSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Chain::create([
            'id' => 1,
            'name' => 'Ethereum Mainnet',
            'currency' => 'ETH',
            'image' => 'assets/img/eth.png',
            'active' => true
        ]);
        
        Chain::create([
            'id' => 56,
            'name' => 'Binance Smart Chain',
            'currency' => 'BNB',
            'image' => 'assets/img/bsc.png',
            'active' => true
        ]);
        
        Chain::create([
            'id' => 137,
            'name' => 'Polygon Mainnet',
            'currency' => 'MATIC',
            'image' => 'assets/img/polygon.png',
            'active' => true
        ]);

        Chain::create([
            'id' => 11155111,
            'name' => 'Sepolia Testnet',
            'currency' => 'SEPETH',
            'image' => 'assets/img/sepolia.png',
            'active' => true
        ]);
    }
}
