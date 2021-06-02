<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
//        $this->call(GenreSeeder::class);
//        $this->call(AuthorSeeder::class);
//        $this->call(BookSeeder::class);        
        
        User::truncate();
        User::create(array('email' => 'admin@shop.test', 
                           'password' => bcrypt('secret'),
                           'vards' => 'George',
                           'uzvards' => 'Toliashvili',
                           'dzimsanas_diena' => Carbon::parse('2001-02-25'),
                           'telefona_nr' => 22222222));
        
        Schema::enableForeignKeyConstraints();
    }
}
