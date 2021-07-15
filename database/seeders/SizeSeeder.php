<?php

namespace Database\Seeders;

use App\Models\Size;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sizes = DB::connection('crazy_old')->select("
            select
                oovd.name
            from
                oc_product_option_value opov
            left join oc_option_value_description oovd on
                opov.option_value_id = oovd.option_value_id
            group by
                opov.option_value_id
        ");

        Size::truncate();

        foreach ($sizes as $size) {
            Size::updateOrCreate([
                'name' => $size->name,
            ], [
                'name' => $size->name,
            ]);
        }
    }
}
