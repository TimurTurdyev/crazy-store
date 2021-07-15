<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BrandsSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $brands = DB::connection('crazy_old')->select("
            select
                name,
                meta_h1 as heading,
                meta_title,
                meta_description,
                description as body
            from
                oc_manufacturer_description
        ");

        Brand::truncate();

        foreach ($brands as $brand) {
            $item = Brand::updateOrCreate([
                'name' => $brand->name,
                'status' => 1
            ]);
            if (!$brand->heading) {
                $brand->heading = $brand->name;
            }

            unset($brand->name);

            $item->description()->updateOrCreate([
                'entity_id' => $item->id
            ], array_filter((array)$brand));
        }
    }
}
