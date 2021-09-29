<?php

namespace App\Console;

use App\Models\Message;
use App\Models\MessageAttachments;
use App\Models\ProductsImages;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            Log::info( '-----attachments------');
            $this->RemoveUnusedFiles('attachments',MessageAttachments::class,'file');
        }) ->daily() ->appendOutputTo(storage_path() . "/logs/laravel.log");

        $schedule->call(function () {
            Log::info( '-----product_images------');
            $this->RemoveUnusedFiles('product_images',ProductsImages::class,'image');
        }) ->daily() ->appendOutputTo(storage_path() . "/logs/laravel.log");;
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }

    private function RemoveUnusedFiles($place,$model,$filed_name){
        $attaches = $model::select($filed_name)->get();
        collect(Storage::listContents($place))
            ->each(function($file) use ($attaches,$filed_name) {
                $find_file = $attaches->whereIn($filed_name,$file['basename']);
                if(empty($find_file->all())){
                    if(Storage::delete($file['path'])){
                        Log::info($file['basename'] .' removed   ');
                    }
                }else Log::info( $file['basename'] .' not removed   ');
            });
    }
}
