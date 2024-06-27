<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PageSeeder extends Seeder
{
    public function run()
    {
        $pages = ['Home','Blog','Contact'];
        foreach($pages as $page){
            $pag = new Page;
            $pag->title = $page;
            $pag->media_id = 1;
            $pag->status = 1;
            $pag->save();
        }
    }
}
