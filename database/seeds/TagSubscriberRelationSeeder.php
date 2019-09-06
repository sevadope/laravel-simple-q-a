<?php

use Illuminate\Database\Seeder;
use App\Models\Tag;
use App\Models\User;

class TagSubscriberRelationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
     	$relations = [];
        $tags_count = Tag::count();
        $users_count = User::count();

        for ($tag_id = 1; $tag_id <= $tags_count; $tag_id++) {
        	$avarage_subs_count = (int) round($users_count / $tags_count);

        	// 50% that Tag has 2-50% fewer subscribers that average value
        	// 50% that Tag has 2-50% more subscribers that average value
        	$subs_count = (int) round(
        		random_int(1, 2) === 1 ?
        		$avarage_subs_count + $avarage_subs_count / random_int(2, 50)
        		:
        		$avarage_subs_count - $avarage_subs_count / random_int(2, 50)
        	);

        	for ($sub = 1; $sub <= $subs_count; $sub++) {
        		$relations[] = [
        			'tag_id' => $tag_id,
        			'user_id' => random_int(1, $users_count)
        		];
        	}
        }

        \DB::table('tag_subscriber')->insert($relations);
    }
}
