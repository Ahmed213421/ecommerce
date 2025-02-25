<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tags')->delete();
        $tags = [
            ['en' => 'buissness' , 'ar' => 'اعمال'],
            ['en' => 'live' , 'ar' => 'حياه'],
            ['en' => 'sport' , 'ar' => 'رياضه'],
            ['en' => 'nature' , 'ar' => 'طبيعه'],
            ];

        foreach ($tags as $value) {
            Tag::create([
                'name' => [
                    'en' => $value['en'],
                    'ar' => $value['ar'],
                ],
            ]);
        }

    }
}
