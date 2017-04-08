<?php

use Illuminate\Database\Seeder;
use App\SocialMedia;

class SocialMediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $social_media = SocialMedia::create(['nama_facebook' => 'Facebook', 'link_facebook' => 'https://www.facebook.com/','nama_twitter' => 'Twitter', 'link_twitter' => 'https://twitter.com/','nama_instagram' => 'Instagram', 'link_instagram' => 'https://www.instgram.com/']); 
    }
}
