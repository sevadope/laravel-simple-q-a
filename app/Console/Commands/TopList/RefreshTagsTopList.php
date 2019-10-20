<?php

namespace App\Console\Commands\TopList;

use Illuminate\Console\Command;
use App\Services\TopList\Managers\TagsTopListManager;

class RefreshTagsTopList extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'top_lists:refresh_tags';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Refresh top list for tags';

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
    public function handle(TagsTopListManager $toplist_manager)
    {
        $toplist_manager->refresh();
        info('Tags top list refreshed in ' . now());
    }
}
