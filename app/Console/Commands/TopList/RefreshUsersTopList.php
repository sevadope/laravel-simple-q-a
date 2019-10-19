<?php

namespace App\Console\Commands\TopList;

use Illuminate\Console\Command;
use App\Services\TopList\Managers\UsersTopListManager;

class RefreshUsersTopList extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'top_lists:refresh_users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Refresh top list for users';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(UsersTopListManager $list_manager)
    {
        $list_manager->refresh();
        info('Users top list refreshed in ' . now());
    }
}
