<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = DB::connection('crazy_old')->select("
            select
                ocd.name,
                ocd.meta_h1 as heading,
                ocd.meta_title,
                ocd.meta_description,
                ocd.description as body
            from
                oc_category oc
            join oc_category_description ocd on
                oc.category_id = ocd.category_id
            where
                oc.parent_id = 0
        ");

        Category::truncate();

        foreach ($categories as $category) {
            $item = Category::updateOrCreate([
                'name' => $category->name,
                'status' => 1
            ]);

            if (!$category->heading) {
                $category->heading = $category->name;
            }

            if ($category->body) {
                $category->body = html_entity_decode($category->body, ENT_QUOTES, 'UTF-8');
            }

            unset($category->name);

            $item->description()->updateOrCreate([
                'entity_id' => $item->id
            ], array_filter((array)$category));
        }
    }
}
