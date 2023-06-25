<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\DBAL\TimestampType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

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
        $admins = [1, 12];
        foreach($categories as $category){
            $arr[] =([
                'title' => $category,
                'slug' => Str::slug($category),
                'user_id' => User::where("role", 'admin')->get()->random()->id,
                // 'user_id' =>
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        Category::insert($arr);

    }
}
