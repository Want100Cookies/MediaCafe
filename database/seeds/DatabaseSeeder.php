<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        \App\Models\User::create([
            'name' => 'Pascal',
            'email' => 'pascal@drewez.nl',
            'password' => Hash::make('password'),
        ]);

        $quality = new \App\Models\Quality();
        $quality->title = 'HD';
        $quality->type = \App\Models\MediaItem::movieType;
        $quality->minSize = 0;
        $quality->maxSize = 1500;
        $quality->save();

        $profile = new \App\Models\Profile();
        $profile->title = 'Any';
        $profile->type = \App\Models\MediaItem::movieType;
        $profile->language = 'english';
        $profile->cutoff_id = $quality->id;
        $profile->save();
    }
}
