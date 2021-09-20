<?php

use Illuminate\Database\Seeder;
use App\Tag;
use Illuminate\Support\Str;

class TagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = ['uno', 'due', 'tre', 'quattro'];

        foreach($tags as $tag){
            $newTag = new Tag();

            // popolo i dati
            $newTag->name = $tag;
            $newTag->slug = Str::slug($tag , '-');

            $newTag->save();
        }
    }
}
