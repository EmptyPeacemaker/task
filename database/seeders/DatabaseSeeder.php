<?php

namespace Database\Seeders;

use App\Models\Application;
use App\Models\Deal;
use App\Models\Status;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        if(Schema::hasTable('migrations'))Artisan::call('migrate:reset');
        Artisan::call('migrate');




        foreach (['Новая', 'Ожидание принятия исполнителем','Исполнитель принял задание','Исполнитель выполнил задание'] as $st){
            Status::create(['title'=>$st]);
        }

        $status=Status::all()->pluck('id');
        $users = \App\Models\User::factory(10)->create()->groupBy('role');

        $images=collect(File::files(storage_path('app/public/img')))->map(function ($file){return '/storage/img/'.$file->getFilename();});

        $users[2]->pluck('id')->each(function ($id) use ($users,$status,$images) {
            Deal::factory(10)->make(['author_id'=>$id])->each(function ($deal)use($users,$status,$images){
                $deal->img=$images->random();
                $deal->status_id=$status->random();
                if ($deal->status_id===1){
                    $deal->save();
                    Application::factory(rand(1,count($users[1])))->make(['deal_id'=>$deal->id])->each(function ($apl,$key)use($users){
                        $apl->executor_id=$users[1]->pluck('id')[$key];
                        $apl->status=rand(1,3);
                    });
                }else{
                    $deal->executor_id=$users[1]->pluck('id')->random();
                    $deal->save();
                }
            });
         });


    }
}
