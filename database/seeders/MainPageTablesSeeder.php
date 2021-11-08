<?php

namespace Database\Seeders;

use App\Http\Controllers\MainPageController;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use mysql_xdevapi\Table;

class MainPageTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('langs')->insert([ 'id'=>1,'title' => 'farsi','abr' => 'fa']);
        DB::table('langs')->insert([ 'id'=>2,'title' => 'english','abr' => 'en']);


        DB::table('menus')->insert([ 'title' => 'Home','lang_id' => 2,'is_active' => 1,'link'=>route('MainPage')]);
        DB::table('menus')->insert([ 'title' => 'About','lang_id' => 2,'is_active' => 1,'link'=> route('MainPage').'#about']);
        DB::table('menus')->insert([ 'title' => 'Products','lang_id' => 2,'is_active' => 1,'link'=> route('pages.categories')]);
        DB::table('menus')->insert([ 'title' => 'Testimonial','lang_id' => 2,'is_active' => 1,'link'=> '#testimonial']);
        DB::table('menus')->insert([ 'title' => 'Contact Us','lang_id' => 2,'is_active' => 1,'link'=> route('pages.contact_form')]);

        DB::table('menus')->insert([ 'title' => 'صفحه اصلی','lang_id' => 1,'is_active' => 1,'link'=>route('MainPage')]);
        DB::table('menus')->insert([ 'title' => 'درباره ما','lang_id' => 1,'is_active' => 1,'link'=> route('MainPage').'#about']);
        DB::table('menus')->insert([ 'title' => 'تماس با ما','lang_id' => 1,'is_active' => 1,'link'=> route('pages.contact_form')]);
        DB::table('menus')->insert([ 'title' => 'محصولات','lang_id' => 1,'is_active' => 1,'link'=> route('pages.categories')]);

        DB::table('link_locations')->insert([ 'title' => 'slider','lang_id' => 2,'id'=>1]);
        DB::table('link_locations')->insert([ 'title' => 'اسلایدر','lang_id' => 1,'id'=>2]);

        DB::table('links')->insert([ "title"=> "کسب درآمد در منزل", "lang_id"=> 1, "is_active"=> 1,
                "link"=> "/about",  "image"=> "link-1.jpg", "location_id"=> 2,
                "description"=> "<span>رییس خود باشید </span>

                                    <p>
            با ثبت نام در بخش هنرمندان و فروشندگان و اشتراک محصولات و هنرهای خود می توانید در منزل به کسب درآمد بپردازید و از طریق این سایت بیشتر دیده شوید
             </p>
                                    <a class=\"buynow\" href=\"".route('MainPage')."#about\">درباره ما</a><a class=\"buynow ggg\" href=\"#\">نظر سنجی</a>"]);

        DB::table('links')->insert([ "title"=> "دسترسی آسان به کسب وکار های خانگی در محله ", "lang_id"=> 1, "is_active"=> 1,
            "link"=> "/about",  "image"=> "link-2.jpg", "location_id"=> 2,
            "description"=> "<span>خدمات و محصولات به قیمت  </span>

            <p>
            محصولات دست ساز و دست دوز را با قیمت هایی به صرفه از کسب و کار های خانگی خریداری نمایید و از این طریق از کسب و کارهای کوچک خانگی حمایت کنید
            </p>
                                    <a class=\"buynow\" href=\"#about\">درباره ما</a><a class=\"buynow ggg\" href=\"#\">نظر سنجی</a>"]);

        DB::table('links')->insert([ "title"=> "امتیاز دهید ", "lang_id"=> 1, "is_active"=> 1,
            "link"=> "/about",  "image"=> "link-5.jpg", "location_id"=> 2,
            "description"=> "<span>به فروشنده یا هنرمند مورد علاقه تان امتیاز دهید   </span>
            <p>   با امتیاز دادن در صفحه فروشنده یا هنرمند یا صفحه محصول مورد علاقه تان شانس بیشتر دیده شدن آنها را بیشتر نمایید و ازایشان حمایت کنید  </p>"]);

        DB::table('links')->insert([ "title"=> "make money at home", "lang_id"=> 2, "is_active"=> 1,
            "link"=> "/about",  "image"=> "link-1.jpg", "location_id"=> 1,
            "description"=> "<span>Be your own boss </span>
            <p> sign up and share your products and arts .  In this way you can ...</p>
                                    <a class=\"buynow\" href=\"#about\">about us</a><a class=\"buynow ggg\" href=\"#\">comments</a>"]);

        DB::table('links')->insert([ "title"=> "find home jobs around you easily ", "lang_id"=> 2, "is_active"=> 1,
            "link"=> "/about",  "image"=> "link-2.jpg", "location_id"=> 1,
            "description"=> "<span>services and home made products   </span>

            <p>
            Buy home products whit reasonable prices . ...
             adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi
            </p>
                                    <a class=\"buynow\" href=\"#about\">about us</a><a class=\"buynow ggg\" href=\"#\">comments</a>"]);
        DB::table('links')->insert([ "title"=> "Rate ", "lang_id"=> 2, "is_active"=> 1,
            "link"=> "/about",  "image"=> "link-5.jpg", "location_id"=> 1,
            "description"=> "<span> Rate your favorite seller or artist     </span>
            <p>     In sellers page you can rate a seller or in their products page you can rate the products and by this they would be seen more in site . </p>"]);

        DB::Table('pages')->insert(['title'=>'درباره ما','body'=>'

                    <h2>درباره ما<br><strong class="black"> کسب و کار خانگی</strong></h2>
                    <p>هدف از ایجاد این سایت این بوده است که هنرمندان یا افراد دیگر اگر در خانه مشغول تولید خلاقیت های خود می باشند بتوانند در این سایت محصول خود را به نمایش گذاشته یا حتی بتوانند آن را به فروش برسانند و یا حتی بتوانند برای آینده خود سفارشاتی دریافت کنند </p>
                    <p>سایر کاربران سایت نیز می توانند با کسب و کارهای خانگی  آشنا شده و از ایشان خرید نمایند یا سفارش خود را ثبت کنند </p>

                ','is_active'=>1,'lang_id'=>1]);

        DB::table('pages')->insert(['title'=>'About Us','body'=>'

                    <h2>About Us<br><strong class="black"> homemade products</strong></h2>
                    <p>dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex</p>
                    <a href="#">Read More</a>
                ','is_active'=>1,'lang_id'=>2]);

        DB::Table('pages')->insert(['title'=>'توضیحات پایین صفحه اصلی','body'=>'                   هدف از ایجاد این سایت این بوده است که هنرمندان یا افراد دیگر اگر در خانه مشغول تولید خلاقیت های خود می باشند بتوانند در این سایت محصول خود را به نمایش گذاشته یا حتی بتوانند آن را به فروش برسانند و یا حتی بتوانند برای آینده خود سفارشاتی دریافت کنند                ','is_active'=>1,'lang_id'=>1]);

        DB::table('pages')->insert(['title'=>'footer main page desc','body'=>'                 dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex dolor sit amet, consectetur adipiscing elit  ','is_active'=>1,'lang_id'=>2]);
   }
}
