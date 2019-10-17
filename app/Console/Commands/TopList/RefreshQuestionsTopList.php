<?php

namespace App\Console\Commands\TopList;

use Illuminate\Console\Command;
use App\Services\TopList\Managers\QuestionsTopListManager;

class RefreshQuestionsTopList extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'toplists:refresh_questions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Refresh toplist for questions';

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
    public function handle(QuestionsTopListManager $manager)
    {
        $manager->refresh();
        info("Questions toplist refreshed in ". now());
    }
}
