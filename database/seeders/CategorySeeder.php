<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\DBAL\TimestampType;
use Illuminate\Database\Seeder;

use function PHPSTORM_META\map;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = ['Local News', 'World News', 'Sports', 'Programming', 'Science'];
        $arr = [];
        foreach($categories as $category){
            $arr[] =([
                'title' => $category,
                'user_id' => rand(1, 11),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        Category::insert($arr);

    }
}
