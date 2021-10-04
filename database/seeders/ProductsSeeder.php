<?php

namespace Database\Seeders;

use App\Http\Controllers\MainPageController;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([ 'title' => 'آشپزی','lang_id'=>'1', 'is_active'=>'1','icon'=>'cook.png']);
        DB::table('categories')->insert([ 'title' => 'هنرهای دستی','lang_id'=>'1', 'is_active'=>'1','icon'=>'hand_made1.png']);
        DB::table('categories')->insert([ 'title' => 'بافتنی','lang_id'=>'1', 'is_active'=>'1','parent_id'=>'2','icon'=>'hand_made2.png']);
        DB::table('categories')->insert([ 'title' => 'خیاطی','lang_id'=>'1', 'is_active'=>'1','parent_id'=>'2','icon'=>'sew.png']);
        DB::table('categories')->insert([ 'title' => 'نقاشی','lang_id'=>'1', 'is_active'=>'1','parent_id'=>'2','icon'=>'paint.png']);
        DB::table('categories')->insert([ 'title' => 'مجسمه سازی','lang_id'=>'1', 'is_active'=>'1','parent_id'=>'2','icon'=>'statue.png']);
        DB::table('categories')->insert([ 'title' => 'معرق','lang_id'=>'1', 'is_active'=>'1','parent_id'=>'2','icon'=>'moaragh.png']);
        DB::table('categories')->insert([ 'title' => 'منبت','lang_id'=>'1', 'is_active'=>'1','parent_id'=>'2','icon'=>'monabat.png']);
        DB::table('categories')->insert([ 'title' => 'شیرینی پزی','lang_id'=>'1', 'is_active'=>'1','icon'=>'pastry.png']);
        DB::table('categories')->insert([ 'title' => 'کارهای کامپیوتری','lang_id'=>'1', 'is_active'=>'1','icon'=>'computer.png']);
        DB::table('categories')->insert([ 'title' => 'Cook','lang_id'=>'2', 'is_active'=>'1','icon'=>'cook.png']);
        DB::table('categories')->insert([ 'title' => 'Hand made','lang_id'=>'2', 'is_active'=>'1','icon'=>'hand_made1.png']);
        DB::table('categories')->insert([ 'title' => 'Sewing','lang_id'=>'2', 'is_active'=>'1','icon'=>'sew.png']);
        DB::table('categories')->insert([ 'title' => 'Painting','lang_id'=>'2', 'is_active'=>'1','icon'=>'paint.png']);
        DB::table('categories')->insert([ 'title' => 'Statuary','lang_id'=>'2', 'is_active'=>'1','icon'=>'statue.png']);
        DB::table('categories')->insert([ 'title' => 'Pastry','lang_id'=>'2', 'is_active'=>'1','icon'=>'pastry.png']);
        DB::table('categories')->insert([ 'title' => 'Computer jobs','lang_id'=>'2', 'is_active'=>'1','icon'=>'computer.png']);
    }
}
