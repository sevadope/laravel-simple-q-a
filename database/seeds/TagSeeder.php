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

        	'Windows Server', 'PHP', 'Node.js', 'Python',
        	'Django', 'Vue.js', 'Javascript', 'SQL',
        	'AI', 'Machine learning', 'NoSql', 'Ajax',
        	'WebSockets', 'Redis', 'Memcached', 'Mysql',
        	'PostgreSQL', 'Symfony', 'Laravel', 'Eloquent',
            'CakePHP', 'OOP', 'Hosting', 'Devices',
            'Flask', 'React', 'Angular', 'HTLML',
            'CSS', 'JQuery', 'Linux', 'Windows',
            'Android', 'Google', 'Books', 'Algorithms',
            'Java', 'Git', '1C-Bitrix', 'Google Chrome',
            'C++', 'GameDev', 'Operating systems', 'MacOS',
            'System administration', 'C', 'C#', 'Freelance',
            'WordPress', 'CMS', 'YII', 'Ubuntu',
            'Apache', 'Nginx', 'Bootstrap', 'Homestead',
            'Vagrant', 'IT Education', 'iOS', 'Databases',
            'Ruby on Rails', 'htaccess', 'Debian', 'Mobile development',
            'Regular expressions', 'Gulp.js', 'WooCommerce', 'Web',
            'Unity Game Engine', 'JSON', 'Mikrotik', 'Frontend',
            'Backend', 'Wi-Fi', 'MODX', 'Network hardware',
            'Career', 'ASP.NET', 'OpenCart', 'centOS',
            'Telegram', 'Adobe Photoshop', 'VPN', 'Visual Studio',
            'Electronics', 'Ruby', 'DNS', 'MongoDB',
            'Video', 'UI', 'Qt', 'Online stores',
            'Maths', 'PhpStorm', 'Joomla', 'SVG',
            'Sass', 'bash', 'Sublime Text', 'Go',
    	];

    	foreach ($titles as $title) {
    		$tags[] = [
    			'title' => $title,
    			'slug' => \Str::slug(urlencode($title)),
    			'description' => str_repeat($title, rand(3, 10)),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
    		];
    	}

    	\DB::table('tags')->insert($tags);
    }
}
