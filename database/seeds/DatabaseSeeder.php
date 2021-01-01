<?php

use App\Models\History;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Faker\Factory;
use Illuminate\Database\Seeder;

/**
 * 
  php artisan migrate:fresh --seed
 */
class DatabaseSeeder extends Seeder
{

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now();


        $sixMonthAgo = $now->clone()
              ->subtract('6 months');

        $period = CarbonPeriod::create($sixMonthAgo, $now);



        foreach ($period as $date) {

            $date = $date->format('Y-m-d');

            $temp = Factory::create()
                  ->numberBetween(-80, 50);

            (new History())
                  ->setDateAt($date)
                  ->setTemp($temp)
                  ->save();
        }
    }

}
