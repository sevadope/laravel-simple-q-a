<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Console\Commands\TopList\RefreshQuestionsTopList;
use App\Console\Commands\TopList\RefreshUsersTopList;
use App\Console\Commands\TopList\RefreshTagsTopList;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        RefreshQuestionsTopList::class,
        RefreshUsersTopList::class,
        RefreshTagsTopList::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('top_lists:refresh_questions')
            ->everyFiveMinutes();

        $schedule->command('top_lists:refresh_users')
            ->everyFiveMinutes();

        $schedule->command('top_lists:refresh_tags')
            ->everyFifteenMinutes();
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
