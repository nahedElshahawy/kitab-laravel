<?php

namespace Database\Seeders;

use App\Models\book;
use App\Models\category;
use App\Models\RateBook;
use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RateBookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker  = Factory::create();
        DB::table('users')->delete();
        DB::table('rate_books')->delete();
        DB::table('books')->delete();
        DB::table('categorys')->delete();

        for ($i = 0; $i <= 50; $i++) {
            User::create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail(),
                'password' => Hash::make(123456789)
            ]);
        }

        for ($i = 0; $i <= 50; $i++) {
            category::create([
                'name' => $faker->name,
            ]);
        }

        for ($i = 0; $i <= 50; $i++) {
            book::create([
                'name' => $faker->name,
                'description' => $faker->paragraph(),
                'price' => rand(10,60),
                'category_id' => category::all()->random()->id,
        
            ]);
        }



        for ($i = 0; $i <= 50; $i++) {
            RateBook::create([
                'user_id' => User::all()->random()->id,
                'value' => 0,
                'book_id' => book::all()->random()->id,
        
            ]);
        }
    }
}
