<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Tag;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Categories
        $shoes = Category::create(['name' => 'Shoes']);
        $clothing = Category::create(['name' => 'Clothing']);
        $equipment = Category::create(['name' => 'Equipment']);

        // Subcategories
        $helmets = Category::create(['name' => 'Helmets', 'parent_category_id' => $equipment->id]);
        $harnesses = Category::create(['name' => 'Harnesses', 'parent_category_id' => $equipment->id]);
        $ropes = Category::create(['name' => 'Ropes', 'parent_category_id' => $equipment->id]);
        $chalk_bags = Category::create(['name' => 'Chalk Bags', 'parent_category_id' => $equipment->id]);

        // Tags
        $menTag = Tag::create(['name' => 'Men']);
        $womenTag = Tag::create(['name' => 'Women']);
        $kidsTag = Tag::create(['name' => 'Kids']);
        $saleTag = Tag::create(['name' => 'Sale']);
        $size35 = Tag::create(['name' => '35']);
        $size355 = Tag::create(['name' => '35,5']);
        $size36 = Tag::create(['name' => '36']);
        $size365 = Tag::create(['name' => '36,5']);
        $size37 = Tag::create(['name' => '37']);
        $size375 = Tag::create(['name' => '37,5']);
        $size38 = Tag::create(['name' => '38']);
        $size385 = Tag::create(['name' => '38,5']);
        $size39 = Tag::create(['name' => '39']);
        $size395 = Tag::create(['name' => '39,5']);
        $size40 = Tag::create(['name' => '40']);
        $size405 = Tag::create(['name' => '40,5']);
        $size41 = Tag::create(['name' => '41']);
        $size415 = Tag::create(['name' => '41,5']);
        $size42 = Tag::create(['name' => '42']);
        $size425 = Tag::create(['name' => '42,5']);
        $size43 = Tag::create(['name' => '43']);
        $size435 = Tag::create(['name' => '43,5']);
        $size44 = Tag::create(['name' => '44']);
        $size445 = Tag::create(['name' => '44,5']);
        $size45 = Tag::create(['name' => '45']);
        $size455 = Tag::create(['name' => '45,5']);
        $size46 = Tag::create(['name' => '46']);
        $sizeXXS = Tag::create(['name' => 'XXS']);
        $sizeXS = Tag::create(['name' => 'XS']);
        $sizeS = Tag::create(['name' => 'S']);
        $sizeM = Tag::create(['name' => 'M']);
        $sizeL = Tag::create(['name' => 'L']);
        $sizeXL = Tag::create(['name' => 'XL']);

        // Brands
        $laSportiva = Brand::create(['name' => 'La Sportiva']);
        $blackDiamond = Brand::create(['name' => 'Black Diamond']);
        $e9 = Brand::create(['name' => 'E9']);
        $eightBPLUS = Brand::create(['name' => '8b+ 8BPLUS']);

        // Products
        $p1 = Product::create([
            'name' => 'La Sportiva Miura VS',
            'color' => 'Yellow/Black',
            'brand_id' => $laSportiva->id,
            'category_id' => $shoes->id,
            'price' => 160.00,
            'discount_percent' => 15,
            'brief_description' => 'Aggressive, high-performance sport and multipitch climbing shoe',
            'detailed_description' => "La Sportiva Miura VS is an aggressive and high-performance sport climbing and multipitch shoe, now in an updated aesthetic version with an improved heel.
The Miura VS shoe is made with the innovative P3 (Permanent Power Platform) technology that allows it to maintain its shape longer over time, even after numerous uses.
It features a three-velcro closure that speeds up and facilitates putting on, the upper is made of suede leather with a tubular construction, while the LaSpoFlex 1.1 mm midsole, present only at the front, is combined with the P3 system.
As for the rubber, you will find a 4 mm Vibram XS Edge, while in the women's version, a slightly softer rubber, the Vibram XS Grip2, has been applied.",
            'features_specifications' => 'Closing System: Velcro
            Climbing Shoe Use: Crag, Multipitch
            Climbing Shoe Sole Type: Full Sole
            Climbing Shoe Stiffness: Stiff
            Climbing Shoe Width: Wide
            Shoe Downturn: Aggressive
            Upper Material: Leather
            Sole Material: Vibram XS Edge',
        ]);

        $p2 = Product::create([
            'name' => "E9 Enove Bia women's pants",
            'color' => 'Tulip',
            'brand_id' => $e9->id,
            'category_id' => $clothing->id,
            'price' => 110.00,
            'discount_percent' => 0,
            'brief_description' => 'Climbing and outdoor pants made of organic cotton corduroy',
            'detailed_description' => "E9 Enove Bia are women's pants designed for bouldering and climbing. Made from poplin cotton, they are very comfortable and adapt to every movement. Additionally, the elastic waistband ensures a great fit.",
            'features_specifications' => 'Season: Fall-Winter 2025-2026
            Material: 96% Cotton, 4% Elastane',
        ]);

        $p3 = Product::create([
            'name' => 'Black Diamond Vision Airnet Recco harness',
            'color' => 'Envy Green/Black',
            'brand_id' => $blackDiamond->id,
            'category_id' => $harnesses->id,
            'price' => 170.00,
            'discount_percent' => 0,
            'brief_description' => 'An ultralight and complete climbing harness',
            'detailed_description' => 'BD Black Diamond Recco Vision Airnet is an ultralight and complete climbing harness, designed for those who push their limits on ice or rock in the mountains. Equipped with airNET technology, this harness achieves the ideal balance between weight and packability, while providing good upper support. The Vision airNET also includes our patented Infinity Belay Loop, which has no seams, is durable, and eliminates the dreaded shifting of the belay loop. This harness is also mountain-ready, with four slots for ice screws and the addition of RECCO® technology, which consists of an integrated passive RECCO® transponder that requires no power or activation to function and makes you searchable by rescuers.',
            'features_specifications' => 'Use: Ice Climbing, Mountaineering, Sport Climbing, Trad Climbing
            Gender: Unisex
            Waist Buckles: 1
            Leg Loops: No
            Gear Loops: 4
            Carabiner Slots: 2',
        ]);

        // Images
        ProductImage::create([
            'product_id' => $p1->id,
            'image_url' => 'images/lasportiva_miura_vs.jpg',
            'alt_text' => 'Climbing shoes',
            'sort_order' => 1,
        ]);

        ProductImage::create([
            'product_id' => $p1->id,
            'image_url' => 'images/lasportiva_miura_vs1.jpg',
            'alt_text' => 'Climbing shoes',
            'sort_order' => 2,
        ]);

        ProductImage::create([
            'product_id' => $p1->id,
            'image_url' => 'images/lasportiva_miura_vs2.jpg',
            'alt_text' => 'Climbing shoes',
            'sort_order' => 3,
        ]);

        ProductImage::create([
            'product_id' => $p1->id,
            'image_url' => 'images/lasportiva_miura_vs3.jpg',
            'alt_text' => 'Climbing shoes',
            'sort_order' => 4,
        ]);

        ProductImage::create([
            'product_id' => $p1->id,
            'image_url' => 'images/lasportiva_miura_vs4.jpg',
            'alt_text' => 'Climbing shoes',
            'sort_order' => 5,
        ]);

        ProductImage::create([
            'product_id' => $p1->id,
            'image_url' => 'images/lasportiva_miura_vs5.jpg',
            'alt_text' => 'Climbing shoes',
            'sort_order' => 6,
        ]);

        ProductImage::create([
            'product_id' => $p2->id,
            'image_url' => 'images/E9_enove_bia-vs_women_pants.jpg',
            'alt_text' => 'Climbing pants',
            'sort_order' => 1,
        ]);

        ProductImage::create([
            'product_id' => $p2->id,
            'image_url' => 'images/E9_enove_bia-vs_women_pants1.jpg',
            'alt_text' => 'Climbing pants',
            'sort_order' => 2,
        ]);

        ProductImage::create([
            'product_id' => $p2->id,
            'image_url' => 'images/E9_enove_bia-vs_women_pants2.jpg',
            'alt_text' => 'Climbing pants',
            'sort_order' => 3,
        ]);

        ProductImage::create([
            'product_id' => $p2->id,
            'image_url' => 'images/E9_enove_bia-vs_women_pants3.jpg',
            'alt_text' => 'Climbing pants',
            'sort_order' => 4,
        ]);

        ProductImage::create([
            'product_id' => $p2->id,
            'image_url' => 'images/E9_enove_bia-vs_women_pants4.jpg',
            'alt_text' => 'Climbing pants',
            'sort_order' => 5,
        ]);

        ProductImage::create([
            'product_id' => $p2->id,
            'image_url' => 'images/E9_enove_bia-vs_women_pants5.jpg',
            'alt_text' => 'Climbing pants',
            'sort_order' => 6,
        ]);

        ProductImage::create([
            'product_id' => $p3->id,
            'image_url' => 'images/BD_black_diamond_vision_harness.jpg',
            'alt_text' => 'Harness',
            'sort_order' => 1,
        ]);

        ProductImage::create([
            'product_id' => $p3->id,
            'image_url' => 'images/BD_black_diamond_vision_harness1.jpg',
            'alt_text' => 'Harness',
            'sort_order' => 2,
        ]);

        ProductImage::create([
            'product_id' => $p3->id,
            'image_url' => 'images/BD_black_diamond_vision_harness2.jpg',
            'alt_text' => 'Harness',
            'sort_order' => 3,
        ]);

        ProductImage::create([
            'product_id' => $p3->id,
            'image_url' => 'images/BD_black_diamond_vision_harness3.jpg',
            'alt_text' => 'Harness',
            'sort_order' => 4,
        ]);

        ProductImage::create([
            'product_id' => $p3->id,
            'image_url' => 'images/BD_black_diamond_vision_harness4.jpg',
            'alt_text' => 'Harness',
            'sort_order' => 5,
        ]);

        ProductImage::create([
            'product_id' => $p3->id,
            'image_url' => 'images/BD_black_diamond_vision_harness5.jpg',
            'alt_text' => 'Harness',
            'sort_order' => 6,
        ]);

        ProductImage::create([
            'product_id' => $p3->id,
            'image_url' => 'images/BD_black_diamond_vision_harness6.jpg',
            'alt_text' => 'Harness',
            'sort_order' => 7,
        ]);

        // Product tags
        $p1->tags()->attach([
            $menTag->id, $womenTag->id, $size35->id, $size355->id, $size36->id,
            $size365->id, $size37->id, $size375->id, $size38->id, $size385->id,
            $size39->id, $size395->id, $size40->id, $size405->id, $size41->id,
            $size415->id, $size42->id, $size425->id, $size43->id, $size435->id,
            $size44->id, $size445->id, $size45->id, $size455->id, $size46->id,
            $saleTag->id,
        ]);

        $p2->tags()->attach([
            $womenTag->id, $sizeXXS->id, $sizeXS->id, $sizeS->id,
            $sizeM->id, $sizeL->id, $sizeXL->id,
        ]);

        $p3->tags()->attach([
            $menTag->id, $womenTag->id, $sizeS->id, $sizeM->id,
            $sizeL->id, $sizeXL->id,
        ]);
    }
}
