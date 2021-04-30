<?php

namespace Database\Seeders;

use App\Http\Controllers\MainPageController;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([ 'name' => 'root','email' => 'info@mamanDooz.com','email_verified_at' => '2021-03-08 18:42:29','password'=>Hash::make('Root@mamanDooz1579')]);
    }
}
