<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'title' => "Arts",
            'description' => "Transform your art into NFT and sell as a raribles.",
            'icon' => "lnir lnir-image",
            'active' => true
        ]);
        Category::create([
            'title' => "Community",
            'description' => "Create a community and let everyone interacts with each other and share content.",
            'icon' => "lnir lnil-comments-alt",
            'active' => true
        ]);
        Category::create([
            'title' => "Private Content",
            'description' => "Offer private/fan content only to users who owns your NFT.",
            'icon' => "lnir lnir-star",
            'active' => true
        ]);
        Category::create([
            'title' => "Game Item",
            'description' => "Sell your game item and let players use it inside your web3 game.",
            'icon' => "lnir lnir-wand",
            'active' => true
        ]);
        Category::create([
            'title' => "Assets",
            'description' => "Sell images, videos, game, music samples, web, mobile, 3d renders, and any other assets and let owners use on their projects.",
            'icon' => "lnir lnir-file-upload",
            'active' => true
        ]);
        Category::create([
            'title' => "Business",
            'description' => "Create value to your business, receive investments, make good profits and pay dividends.",
            'icon' => "lnir lnir-revenue",
            'active' => true
        ]);
        Category::create([
            'title' => "Tickets and Access Grants",
            'description' => "Sell tickets and give access to your NFT owners to your party.",
            'icon' => "lnir lnir-ticket",
            'active' => true
        ]);
    }
}
