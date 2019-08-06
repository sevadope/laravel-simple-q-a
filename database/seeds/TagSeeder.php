<?php
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use App\Models\Tag;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$tags = [];

        $titles = [
        	'Web', 'PHP', 'Node.js', 'Python',
        	'Django', 'Vue.js', 'Javascript', 'SQL',
        	'AI', 'Machine Learning', 'NoSql', 'Ajax',
        	'WebSockets', 'Redis', 'Memcached', 'Mysql',
        	'PostgreSQL', 'Symfony', 'Laravel', 'Eloquent',
    	];

    	foreach ($titles as $title) {
    		$tags[] = [
    			'title' => $title,
    			'slug' => \Str::slug($title),
    			'description' => str_repeat($title, rand(3, 10)),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
    		];
    	}

    	\DB::table('tags')->insert($tags);
    }
}
