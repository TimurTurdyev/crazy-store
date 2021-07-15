<?php

namespace Database\Seeders;

use App\Models\Group;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $groups = DB::connection('crazy_old')->select("
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
                oc.parent_id in (select category_id from oc_category where parent_id = 0)
        ");

        Group::truncate();

        foreach ($groups as $group) {
            $item = Group::updateOrCreate([
                'name' => $group->name,
                'status' => 1
            ]);

            if (!$group->heading) {
                $group->heading = $group->name;
            }

            if ($group->body) {
                $group->body = html_entity_decode($group->body, ENT_QUOTES, 'UTF-8');
            }

            unset($group->name);

            $item->description()->updateOrCreate([
                'entity_id' => $item->id
            ], array_filter((array)$group));
        }
    }
}
