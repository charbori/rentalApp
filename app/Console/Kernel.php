<?php

namespace App\Console;

use Illuminate\Support\Facades\DB;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        $schedule->call(function () {
            $user_cnt = DB::table('map_list')->select(DB::raw('map_id, count(distinct `user_id`) as `user_cnt`'))
            ->groupBy('map_id')
            ->get();

            $record_cnt = DB::table('map_list')->select(DB::raw('map_id, count(`*`) as `record_cnt`'))
            ->groupBy('map_id')
            ->get();

            $map_batch_list = array();
            foreach ($user_cnt AS $val) {
                $map_batch_list[$val['map_id']]['user_id'] = $val['user_cnt'];
                $map_batch_list[$val['map_id']]['record_cnt'] = 0;
            }

            foreach ($record_cnt AS $val) {
                $map_batch_list[$val['map_id']]['record_cnt'] = $val['record_cnt'];
            }

            foreach ($map_batch_list AS $key => $val) {
                DB::table('map_list')->where('map_id', $key)
                ->update([ 'rank' => $val['record_cnt'],
                            'player_count' => $val['user_id']]);
            }

        })->daily();
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
}
