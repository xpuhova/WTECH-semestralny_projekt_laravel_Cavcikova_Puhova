<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Tag;
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
        // Audience
        $audienceTags = collect(['Men', 'Women', 'Kids'])->mapWithKeys(function ($name) {
            return [$name => Tag::create([
                'name' => $name,
                'type' => 'audience',
            ])];
        });

        // Promo
        $promoTags = collect(['Sale'])->mapWithKeys(function ($name) {
            return [$name => Tag::create([
                'name' => $name,
                'type' => 'promo',
            ])];
        });

        // Colors
        $colorTags = collect([
            'Black', 'White', 'Gray', 'Navy', 'Blue', 'Red',
            'Green', 'Yellow', 'Orange', 'Pink', 'Purple',
            'Brown', 'Beige',
        ])->mapWithKeys(function ($name) {
            return [$name => Tag::create([
                'name' => $name,
                'type' => 'color',
            ])];
        });

        // Shoe sizes
        $shoeSizes = collect([
            '35', '35.5', '36', '36.5', '37', '37.5', '38', '38.5', '39', '39.5',
            '40', '40.5', '41', '41.5', '42', '42.5', '43', '43.5', '44', '44.5',
            '45', '45.5', '46',
        ])->mapWithKeys(function ($name) {
            return [$name => Tag::create([
                'name' => $name,
                'type' => 'shoe_size',
            ])];
        });

        // Clothing sizes
        $clothingSizes = collect([
            'XXS', 'XS', 'S', 'M', 'L', 'XL',
        ])->mapWithKeys(function ($name) {
            return [$name => Tag::create([
                'name' => $name,
                'type' => 'clothing_size',
            ])];
        });

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
            $audienceTags['Men']->id,
            $audienceTags['Women']->id,
            $colorTags['Black']->id,
            $colorTags['Yellow']->id,
            $shoeSizes['35']->id,
            $shoeSizes['35.5']->id,
            $shoeSizes['36']->id,
            $shoeSizes['36.5']->id,
            $shoeSizes['37']->id,
            $shoeSizes['37.5']->id,
            $shoeSizes['38']->id,
            $shoeSizes['38.5']->id,
            $shoeSizes['39']->id,
            $shoeSizes['39.5']->id,
            $shoeSizes['40']->id,
            $shoeSizes['40.5']->id,
            $shoeSizes['41']->id,
            $shoeSizes['41.5']->id,
            $shoeSizes['42']->id,
            $shoeSizes['42.5']->id,
            $shoeSizes['43']->id,
            $shoeSizes['43.5']->id,
            $shoeSizes['44']->id,
            $shoeSizes['44.5']->id,
            $shoeSizes['45']->id,
            $shoeSizes['45.5']->id,
            $shoeSizes['46']->id,
            $promoTags['Sale']->id,
        ]);

        $p2->tags()->attach([
            $audienceTags['Women']->id,
            $colorTags['Pink']->id,
            $clothingSizes['XXS']->id,
            $clothingSizes['XS']->id,
            $clothingSizes['S']->id,
            $clothingSizes['M']->id,
            $clothingSizes['L']->id,
            $clothingSizes['XL']->id,
        ]);

        $p3->tags()->attach([
            $audienceTags['Men']->id,
            $audienceTags['Women']->id,
            $colorTags['Black']->id,
            $colorTags['Green']->id,
            $clothingSizes['S']->id,
            $clothingSizes['M']->id,
            $clothingSizes['L']->id,
            $clothingSizes['XL']->id,
        ]);
    }
}
