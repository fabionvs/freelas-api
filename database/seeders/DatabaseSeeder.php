<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
          'username' => 'fabio',
          'password' => Hash::make('123'),
          'email'=> 'fabio@teste.com'
        ]);

        Category::create([
            'title' => 'Restaurantes',
            'icon' => 'lnir lnir-chef-hat',
            'description' => 'Selecione esta opção se o seu negócio está relacionado com alimentação.',
            'active'=> true
          ]);

          Category::create([
            'title' => 'Construção',
            'icon' => 'lnir lnir-construction',
            'description' => 'Selecione esta opção se o seu negócio está relacionado com construção.',
            'active'=> true
          ]);
          Category::create([
            'title' => 'Casa e Decoração',
            'icon' => 'lnir lnir-house',
            'description' => 'Selecione esta opção se o seu negócio está relacionado com casa e decoração.',
            'active'=> true
          ]);
          Category::create([
            'title' => 'Tecnologia da Informação',
            'icon' => 'lnir lnir-code-alt',
            'description' => 'Selecione esta opção se o seu negócio está relacionado com tecnologia da informação.',
            'active'=> true
          ]);
          Category::create([
            'title' => 'Animais de Estimação',
            'icon' => 'lnir lnir-bone',
            'description' => 'Selecione esta opção se o seu negócio está relacionado com animais e pet shops.',
            'active'=> true
          ]);
          Category::create([
            'title' => 'Agronegócio',
            'icon' => 'lnir lnir-plant',
            'description' => 'Selecione esta opção se o seu negócio está relacionado com agropecuária.',
            'active'=> true
          ]);
          Category::create([
            'title' => 'Turismo',
            'icon' => 'lnir lnir-beach',
            'description' => 'Selecione esta opção se o seu negócio está relacionado com turismo e viagens.',
            'active'=> true
          ]);
          Category::create([
            'title' => 'Mercados e Feiras',
            'icon' => 'lnir lnir-shopping-basket',
            'description' => 'Selecione esta opção se o seu negócio está relacionado com mercados e feiras.',
            'active'=> true
          ]);
          Category::create([
            'title' => 'Arte, Artesanato, Cultura e Música',
            'icon' => 'lnir lnir-beach',
            'description' => 'Selecione esta opção se o seu negócio está relacionado com arte, artesanato, cultura e música.',
            'active'=> true
          ]);
          Category::create([
            'title' => 'Shoppings e Compras',
            'icon' => 'lnir lnir-gift',
            'description' => 'Selecione esta opção se o seu negócio está relacionado com shoppings e compras.',
            'active'=> true
          ]);
          Category::create([
            'title' => 'Nutrição e Esportes',
            'icon' => 'lnir lnir-gift',
            'description' => 'Selecione esta opção se o seu negócio está relacionado com nutrição e esportes.',
            'active'=> true
          ]);
    }
}
