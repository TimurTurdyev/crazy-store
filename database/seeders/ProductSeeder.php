<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Description;
use App\Models\Group;
use App\Models\Product;
use App\Models\Size;
use App\Models\Variant;
use App\Models\VariantPhoto;
use App\Models\VariantPrice;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use League\HTMLToMarkdown\HtmlConverter;

class ProductSeeder extends Seeder
{
    private HtmlConverter $converter;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::truncate();
        Variant::truncate();
        VariantPhoto::truncate();
        VariantPrice::truncate();
        Description::truncate();
        $this->converter = new HtmlConverter();

        $brands = Brand::get(['id', 'name']);
        $groups = Group::get(['id', 'name']);
        $sizes = Size::get(['id', 'name']);

        $products = collect(DB::connection('crazy_old')->select("
                    select
                        op.product_id,
                        op.jan,
                        op.quantity,
                        op.price,
                        IF(op.image != '', CONCAT('storage/', op.image), 'placeholder.png') as image,
                        op.status,
                        (
                        SELECT
                            name
                        from
                            oc_manufacturer om
                        where
                            op.manufacturer_id = om.manufacturer_id
                        limit 1) as brand_name,
                        (
                        SELECT
                            name
                        from
                            oc_category_description ocd
                        join oc_product_to_category op2c on
                            ocd.category_id = op2c.category_id
                            and op2c.main_category = 1
                        where
                            op2c.product_id = op.product_id
                        limit 1
                                            ) as group_name,
                        opd.name,
                        opd.meta_h1 as heading,
                        opd.meta_title,
                        opd.meta_description,
                        opd.description as body
                    from
                        oc_product op
                    join oc_product_description opd on
                        op.product_id = opd.product_id
        "))->groupBy(function ($item) {
            if ($item->jan === '') {
                return 'single';
            }
            return $item->jan;
        });

        foreach ($products as $key => $product) {
            if ($key === 'single') {
                foreach ($product as $product_info) {
                    $brand_id = $brands->firstWhere('name', $product_info->brand_name)?->id;
                    $group_id = $groups->firstWhere('name', $product_info->group_name)?->id;

                    $this->normalizeText($product_info);

                    $product_db = Product::create([
                        'group_id' => $group_id ?? null,
                        'brand_id' => $brand_id ?? null,
                        'name' => $product_info->name,
                        'status' => $product_info->status,
                    ]);

                    $description = Description::where('heading', '=', $product_info->heading)->first();

                    $product_db->description()->updateOrCreate([
                        'heading' => $description?->id ? $product_info->heading . ' duplicate-' . $product_db->id : $product_info->heading,
                        'meta_title' => $description?->id ? $product_info->meta_title . ' duplicate-' . $product_db->id : $product_info->meta_title,
                        'meta_description' => $product_info->meta_description,
                        'body' => $product_info->body,
                    ]);

                    $this->productVariants($product_db, $product_info, $sizes);
                }
            } else {
                $parent_product = $product->firstWhere('product_id', $key) ?? $product->first();

                $brand_id = $brands->firstWhere('name', $parent_product->brand_name)?->id;
                $group_id = $groups->firstWhere('name', $parent_product->group_name)?->id;


                $this->normalizeText($parent_product);

                $product_db = Product::create([
                    'group_id' => $group_id ?? null,
                    'brand_id' => $brand_id ?? null,
                    'name' => $parent_product->name,
                    'status' => $parent_product->status,
                ]);

                $description = Description::where('heading', '=', $parent_product->heading)->first();

                $product_db->description()->updateOrCreate([
                    'heading' => $description?->id ? $parent_product->heading . ' duplicate-' . $product_db->id : $parent_product->heading,
                    'meta_title' => $description?->id ? $parent_product->meta_title . ' duplicate-' . $product_db->id : $parent_product->meta_title,
                    'meta_description' => $parent_product->meta_description,
                    'body' => $parent_product->body,
                ]);

                $product_name = '';

                foreach ($product as $index => $product_info) {
                    $this->normalizeText($product_info);
                    $position = $this->getCharacterOffsetOfDifference($parent_product->name, $product_info->name);
                    $short_name = mb_substr($product_info->name, $position, null, 'UTF-8');

                    try {
                        if ($short_name === '') {
                            if (isset($product[$index - 1])) {
                                $position = $this->getCharacterOffsetOfDifference($product[$index - 1]->name, $parent_product->name);
                                $short_name = mb_substr($product_info->name, $position, null, 'UTF-8');
                                $product_name = mb_substr($product_info->name, 0, $position - 1, 'UTF-8');
                            } else if (isset($product[$index + 1])) {
                                $position = $this->getCharacterOffsetOfDifference($product[$index + 1]->name, $parent_product->name);
                                $short_name = mb_substr($product_info->name, $position, null, 'UTF-8');
                                $product_name = mb_substr($product_info->name, 0, $position - 1, 'UTF-8');
                            }
                        }
                        dump($short_name, $parent_product->name, $product_info->name);
                        $this->productVariants($product_db, $product_info, $sizes, $short_name);
                    } catch (\Exception $exception) {
                        dd($short_name, $position, $parent_product->name, $product_info->name);
                    }
                }

                if ($product_name) {
                    $product_name = implode('', explode(',', $product_name));
                    $product_db->update(['name' => $product_name]);
                }
            }
        }
    }

    protected function images($product_id): array
    {
        return DB::connection('crazy_old')->select("
                                                        SELECT
                                                               IF(image != '', CONCAT('storage/', image), 'placeholder.png') as path
                                                        FROM oc_product_image
                                                        WHERE product_id = '" . (int)$product_id . "' ORDER BY sort_order ASC
                                                        ");
    }

    protected function getCharacterOffsetOfDifference($str1, $str2, $encoding = 'UTF-8')
    {
        return mb_strlen(
            mb_strcut(
                $str1,
                0, strspn($str1 ^ $str2, "\0"),
                $encoding
            ),
            $encoding
        );
    }

    protected function normalizeText(&$product)
    {
        $product->name = str_replace('&quot;', '', $product->name);
        $product->heading = str_replace('&quot;', '', $product->heading);
        $product->meta_title = str_replace('&quot;', '', $product->meta_title);
        $product->meta_description = str_replace('&quot;', '', $product->meta_description);
        $product->body = $this->converter->convert(html_entity_decode($product->body));
    }

    private function productVariants($product, $info, $sizes, $short_name = '')
    {
        $variant_db = (new Variant())->create([
            'product_id' => $product->id,
            'sku' => $info->product_id,
            'short_name' => $short_name,
            'status' => $info->status,
        ]);

        $images = [
            [
                'path' => $info->image,
                'sort_order' => 0
            ]
        ];

        foreach ($this->images($info->product_id) as $index => $image) {
            $images[] = [
                'path' => $image->path,
                'sort_order' => $index + 1
            ];
        }

        if (count($images)) {
            $variant_db->photos()->createMany($images);
        }

        $options = [];

        foreach ($this->options($info->product_id) as $option_value) {
            $options[] = [
                'size_id' => $sizes->firstWhere('name', $option_value->option_value_name)?->id,
                'price' => $this->price($info->price, $option_value->option_price, $option_value->option_price_prefix),
                'cost' => 0,
                'quantity' => $option_value->option_quantity,
                'discount' => 0,
            ];
        }

        if (count($options) === 0) {
            $options[] = [
                'size_id' => null,
                'price' => $info->price,
                'cost' => 0,
                'quantity' => $info->quantity,
                'discount' => 0,
            ];
        }
        //dd($product->toArray(), $variant_db->toArray(), $options);
        $variant_db->prices()->createMany($options);
    }

    private function price($product_price, $option_price, $prefix): int
    {
        if ($option_price === 0) return $product_price;

        if ($prefix === '+') {
            return (int)$product_price + (int)$option_price;
        }
        return $product_price;
    }

    private function options($product_id): array
    {
        return DB::connection('crazy_old')->select("
                    select
                        (select name from oc_option_description ood where ood.option_id = opov.option_id) as oprion_name,
                        (select name from oc_option_value_description oovd where oovd.option_value_id = opov.option_value_id) as option_value_name,
                        opov.price as option_price,
                        opov.price_prefix as option_price_prefix,
                        opov.quantity as option_quantity
                    from oc_product_option_value opov
                    where opov.product_id = '" . $product_id . "'
                    ORDER BY opov.product_option_value_id ASC
        ");
    }
}
