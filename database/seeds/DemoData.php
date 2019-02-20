<?php

use Illuminate\Database\Seeder;

class DemoData extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        \Illuminate\Support\Facades\DB::beginTransaction();

        // Units

        $kg = \App\Plugins\Units\Model\Unit::create([
            'name' => 'Kilograms',
            'unit' => 'kg',
        ]);

        $g = \App\Plugins\Units\Model\Unit::create([
            'name'          => 'Grams',
            'unit'          => 'g',
            'unit_id'       => $kg->id,
            'parent_amount' => 1000,
        ]);

        // Vat
        $v = \App\Plugins\Vat\Model\Vat::create([
            'name'   => 'Standarta',
            'amount' => '21',
        ]);

        // MarketDays
        $md = new \App\Plugins\MarketDays\Model\MarketDay;
        $md->withTrashed()->find(1)->restore();
        $md->withTrashed()->find(4)->restore();

        $c1 = \App\Plugins\Categories\Model\Category::create();

        $c1->metaData()->updateOrCreate([
            'meta_name' => 'name',
            'language'  => config('app.locale'),
        ], [
            'meta_value' => 'Gaļa',
        ]);

        $c1->metaData()->updateOrCreate([
            'meta_name' => 'slug',
            'language'  => config('app.locale'),
        ], [
            'meta_value' => 'gala',
        ]);

        $c2 = \App\Plugins\Categories\Model\Category::create(['parent_id' => $c1->id]);

        $c2->metaData()->updateOrCreate([
            'meta_name' => 'name',
            'language'  => config('app.locale'),
        ], [
            'meta_value' => 'Cūkgaļa',
        ]);

        $c2->metaData()->updateOrCreate([
            'meta_name' => 'slug',
            'language'  => config('app.locale'),
        ], [
            'meta_value' => 'cukgala',
        ]);


        $c3 = \App\Plugins\Categories\Model\Category::create();

        $c3->metaData()->updateOrCreate([
            'meta_name' => 'name',
            'language'  => config('app.locale'),
        ], [
            'meta_value' => 'Dārzeņi',
        ]);

        $c3->metaData()->updateOrCreate([
            'meta_name' => 'slug',
            'language'  => config('app.locale'),
        ], [
            'meta_value' => 'darzeni',
        ]);


        $frontMenu = \App\Plugins\Menu\Model\FrontendMenu::where('slug', 'shop')->first();

        $m1 = $frontMenu->menuItems()->create([
            'menu_owner' => 'category',
            'owner_id'   => $c1->id,
            'sequence'   => 0,
        ]);
        $frontMenu->menuItems()->create([
            'menu_owner' => 'category',
            'owner_id'   => $c3->id,
            'sequence'   => 1,
        ]);
        $frontMenu->menuItems()->create([
            'menu_owner'            => 'category',
            'owner_id'              => $c2->id,
            'frontend_menu_item_id' => $m1->id,
            'sequence'              => 0,
        ]);

        $s1 = \App\Plugins\Suppliers\Model\Supplier::create([
            'custom_id' => 'cimbuli',
            'email'     => 'zs@cimbuli.example',
            'farmer'    => rand(0, 1),
            'craftsman' => rand(0, 1),
            'featured'  => rand(0, 1),
        ]);

        $s1->metaData()->updateOrCreate([
            'meta_name' => 'name',
            'language'  => config('app.locale'),
        ], [
            'meta_value' => 'Z/S Cimbuļi',
        ]);

        $s1->metaData()->updateOrCreate([
            'meta_name' => 'slug',
            'language'  => config('app.locale'),
        ], [
            'meta_value' => 'zs-cimbuli',
        ]);


        $p1 = \App\Plugins\Products\Model\Product::create([
            'sku'            => 'cukgala1',
            'main_category'  => $c2->id,
            'state'          => 0,
            'is_bio'         => rand(0, 1),
            'is_lv'          => rand(0, 1),
            'is_suggested'   => rand(0, 1),
            'is_highlighted' => rand(0, 1),
            'supplier_id'    => $s1->id,
            'vat_id'         => $v->id,
            'unit_id'        => $kg->id,
            'cost'           => 5,
            'mark_up'        => 40,
        ]);

        $p1->variations()->create([
            'amount'       => '0.25',
            'display_name' => '250g',
            'for_supplier' => '250g',
        ]);
        $p1->variations()->create([
            'amount'       => '0.5',
            'display_name' => '500g',
            'for_supplier' => '500g',
        ]);
        $p1->variations()->create([
            'amount'       => '1',
            'display_name' => '1kg',
            'for_supplier' => '1kg',
        ]);

        $p1->extra_categories()->sync([$c1->id,$c2->id]);

        $p1->metaData()->updateOrCreate([
            'meta_name' => 'name',
            'language'  => config('app.locale'),
        ], [
            'meta_value' => 'Cūkgaļa cepta',
        ]);

        $p1->metaData()->updateOrCreate([
            'meta_name' => 'slug',
            'language'  => config('app.locale'),
        ], [
            'meta_value' => 'cukgala-cepta',
        ]);

        $p1->market_days()->sync([1,4]);

        $p2 = \App\Plugins\Products\Model\Product::create([
            'sku'            => 'cukgala2',
            'main_category'  => $c2->id,
            'state'          => 0,
            'is_bio'         => rand(0, 1),
            'is_lv'          => rand(0, 1),
            'is_suggested'   => rand(0, 1),
            'is_highlighted' => rand(0, 1),
            'supplier_id'    => $s1->id,
            'vat_id'         => $v->id,
            'unit_id'        => $kg->id,
            'cost'           => 10,
            'mark_up'        => 40,
        ]);
        $p2->variations()->create([
            'amount'       => '1',
            'display_name' => '1kg',
            'for_supplier' => '1kg',
        ]);
        $p2->extra_categories()->sync([$c1->id,$c2->id]);

        $p2->metaData()->updateOrCreate([
            'meta_name' => 'name',
            'language'  => config('app.locale'),
        ], [
            'meta_value' => 'Cūkgaļa svaiga',
        ]);

        $p2->metaData()->updateOrCreate([
            'meta_name' => 'slug',
            'language'  => config('app.locale'),
        ], [
            'meta_value' => 'cukgala-svaig',
        ]);

        $p2->market_days()->sync([1]);

        $p3 = \App\Plugins\Products\Model\Product::create([
            'sku'            => 'kartupeli',
            'main_category'  => $c2->id,
            'state'          => 0,
            'is_bio'         => rand(0, 1),
            'is_lv'          => rand(0, 1),
            'is_suggested'   => rand(0, 1),
            'is_highlighted' => rand(0, 1),
            'supplier_id'    => $s1->id,
            'vat_id'         => $v->id,
            'unit_id'        => $kg->id,
            'cost'           => 15,
            'mark_up'        => 40,
        ]);
        $p3->variations()->create([
            'amount'       => '1',
            'display_name' => '1kg',
            'for_supplier' => '1kg',
        ]);
        $p3->extra_categories()->sync([$c3->id]);

        $p3->metaData()->updateOrCreate([
            'meta_name' => 'name',
            'language'  => config('app.locale'),
        ], [
            'meta_value' => 'Kartupeļi Vineta',
        ]);

        $p3->metaData()->updateOrCreate([
            'meta_name' => 'slug',
            'language'  => config('app.locale'),
        ], [
            'meta_value' => 'kartupeli-vineta',
        ]);
        $p3->market_days()->sync([4]);

        \Illuminate\Support\Facades\DB::commit();

    }

}
