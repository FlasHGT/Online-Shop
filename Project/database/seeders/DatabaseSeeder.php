<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;
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
        Schema::disableForeignKeyConstraints();
//        $this->call(GenreSeeder::class);
//        $this->call(AuthorSeeder::class);
//        $this->call(BookSeeder::class);        
        
        // create an admin user with email admin@library.test and password secret
        User::truncate();
        User::create(array('vards' => 'Georgs',
                           'uzvards' => 'Toliašvili',
                           'email' => 'admin@shop.test', 
                           'password' => Hash::make('secret'),
                           'role' => 1));
        
        Schema::enableForeignKeyConstraints();
    }
}
