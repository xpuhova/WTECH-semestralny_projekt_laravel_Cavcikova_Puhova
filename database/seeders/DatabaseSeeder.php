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
        $beal = Brand::create(['name' => 'Beal']);
        $arcteryx = Brand::create(['name' => "Arc'teryx"]);

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

        $p4 = Product::create([
            'name' => 'Stan Chalk Bag',
            'color' => 'Light Gray',
            'brand_id' => $eightBPLUS->id,
            'category_id' => $chalk_bags->id,
            'price' => 30.35,
            'discount_percent' => 10,
            'brief_description' => 'An unconventional chalk bag for climbing',
            'detailed_description' => '8b+ Stan chalk bag for climbing. The opening is rigid to ensure immediate access to the chalk, and the chalk bag also has two brush holder loops. The interior is fleece-lined to retain as much chalk as possible. Stan comes in a protective bag and is equipped with an adjustable strap and a carabiner to hang it on the harness. A fantastic idea for an unconventional gift!',
            'features_specifications' => 'Diameter: 12cm
            Height: 18cm
            Chalk Bag Belt: Yes
            Chalk Bag Use: Climbing',
        ]);

        $p5 = Product::create([
            'name' => 'BD Black Diamond Half Dome Woman climbing helmet for women',
            'color' => 'Caspian',
            'brand_id' => $blackDiamond->id,
            'category_id' => $helmets->id,
            'price' => 52.00,
            'discount_percent' => 0,
            'brief_description' => 'A climbing helmet designed for the female head',
            'detailed_description' => 'BD Black Diamond Half Dome Woman is a climbing helmet designed for the female head.

The famous helmet from Black Diamond has now been redesigned specifically for women, aiming to eliminate the annoying problem of the ponytail. Every time, in fact, the hair issue is always more complicated, and we never find the right way to tie our hair while keeping the helmet securely on our head. With Half Dome Woman, this problem will finally be resolved!

The helmet consists of a hard polycarbonate shell and an internal EPS foam with a lowered profile to increase comfort inside. The adjustment is easily usable with one hand via a dial, while the chin strap is secure and snug once adjusted.

Head circumference: 50-58 cm

User instructions.

',
            'features_specifications' => 'Gender: Women
            Weight: 330 g
            Certification: CE EN 12492
            Material: Polycarbonate + EPS
            Helmet Regulation System: Rotella
            Lamp Clip: Yes',
        ]);

        $p6 = Product::create([
            'name' => 'Beal Apollo II 11 mm Dry Cover climbing rope',
            'color' => 'Red',
            'brand_id' => $beal->id,
            'category_id' => $ropes->id,
            'price' => 193.00,
            'discount_percent' => 0,
            'brief_description' => 'A robust rope, capable of withstanding edges',
            'detailed_description' => 'Beal Apollo II 11 mm Dry Cover climbing rope. Apollo combines the features that make it an ultra-durable rope: large diameter, high percentage of sheath, and a good amount of dynamic elasticity. It is ideal for Big Wall climbing and group use. It is a robust rope, capable of withstanding edges thanks to the thickness of the sheath. A beast of burden that you can use for a long time.

The Dry Cover is a waterproof treatment that makes the rope resistant to moisture, abrasion, and dust. It is applied to the outer braid and performs well on long routes and approaches.',
            'features_specifications' => 'Rope Type: Single Rope
            Diameter: 11 mm
            Weight: 75 g per meter
            Dynamic Elongation Single Rope: 35 %
            Static Elongation Single Rope with 80 kg: 9,5 %
            Impact Force Single Rope: 7,7 kN
            Number of Falls Single Rope: 16
            Rope Sheath Percentage: 35 %
            Mid-rope identification: Black Limit Mark
            Treatment: Dry Cover, Thermo Fluid
            Certification: CE EN 892, UIAA
            Rope Use: Mountaineering, Trad Climbing',
        ]);

        $p7 = Product::create([
            'name' => "Arc'teryx Atom Hoody W women's insulated jacket",
            'color' => 'Black',
            'brand_id' => $arcteryx->id,
            'category_id' => $clothing->id,
            'price' => 265.00,
            'discount_percent' => 0,
            'brief_description' => "An extremely versatile women's hooded jacket",
            'detailed_description' => "The Atom Hoody by Arc'teryx is an extremely versatile women's hooded jacket, designed as the ultimate solution for bushwalking, crag climbing, or as a mid-layer for ski touring and winter activities. This model features Coreloft™ Compact 60 synthetic insulation, which provides warmth even in humid conditions and maintains its loft over time, making it the ideal choice compared to down for high-intensity aerobic days. The outer shell made of Tyono™ 20 is lightweight, soft, and breathable, treated with a PFAS-free FC0 DWR water-repellent finish to protect against light rain and wind. The new version features an updated fit with a slightly wider collar and more spacious sleeve openings to enhance mobility and layering, while still maintaining a close profile that minimizes bulk under an outer shell. The technical stretch fleece side panels offer excellent ventilation, while the 20D recycled nylon lining helps regulate body temperature, providing a soft feel against the skin. Key technical features include the insulated and adjustable StormHood™, the No Slip Zip™ front zipper with easy-to-use TPU pull tabs for gloved hands, and the ability to pack the jacket into its own chest pocket for compact transport via a carabiner. Completing the piece are two hand pockets with hidden zippers, an internal security pocket, and an adjustable hem to seal in warmth. Weighing only 320 grams, the Atom Hoody incorporates bluesign approved materials and recycled content, confirming it as an essential and sustainable piece for every mountain enthusiast.",
            'features_specifications' => 'Gender: Women
            Weight: 320 g
            Type of Padding: Synthetic Insulation
            Goretex: No
            Season: Spring-Summer 2026
            Material: Polyester',
        ]);

        $p8 = Product::create([
            'name' => '8b+ 8BPLUS Chalk Bag Phil chalk bag',
            'color' => 'Gray / Yellow',
            'brand_id' => $eightBPLUS->id,
            'category_id' => $chalk_bags->id,
            'price' => 30.35,
            'discount_percent' => 10,
            'brief_description' => ' A handmade chalk bag, developed without compromise in terms of quality and functionality',
            'detailed_description' => '8b+ 8BPLUS Phil chalk bag climbing is handmade and developed without compromise in terms of quality and functionality.

The opening is rigid to ensure immediate access to the chalk while the interior is fleece-lined to hold as much chalk as possible.

Phil comes with two brush holder slots, an adjustable strap and a small carabiner to attach it to the harness.

A fantastic idea also for an unconventional gift!',
            'features_specifications' => 'Diameter: 12,5 cm
            Height: 18 cm
            Weight: 125 g
            Chalk Bag Belt: Yes
            Chalk Bag Use: Climbing',
        ]);

        $p9 = Product::create([
            'name' => '8b+ 8BPLUS Chalk Bomb 65 g rechargeable magnesium ball',
            'color' => 'White',
            'brand_id' => $eightBPLUS->id,
            'category_id' => $chalk_bags->id,
            'price' => 8.45,
            'discount_percent' => 0,
            'brief_description' => 'A rechargeable magnesium ball',
            'detailed_description' => 'The rechargeable magnesium ball Chalk Bomb 65 g from 8b+ 8BPLUS is a great idea for your climbing sessions if you want to save a little, avoid any waste of magnesium, and have a quality product.

The ball comes with a mesh cover designed to reduce magnesium waste and is equipped with a closure with a cord and tanka to help you recharge it comfortably.',
            'features_specifications' => 'Format: 65 g
            Chalk Type: Ball',
        ]);

        // Images
        ProductImage::create([
            'product_id' => $p1->id,
            'image_url' => 'images/lasportiva_miura_vs.jpg',
            'alt_text' => 'La Sportiva Miura VS climbing shoes',
            'sort_order' => 1,
        ]);

        ProductImage::create([
            'product_id' => $p1->id,
            'image_url' => 'images/lasportiva_miura_vs1.jpg',
            'alt_text' => 'La Sportiva Miura VS climbing shoes',
            'sort_order' => 2,
        ]);

        ProductImage::create([
            'product_id' => $p1->id,
            'image_url' => 'images/lasportiva_miura_vs2.jpg',
            'alt_text' => 'La Sportiva Miura VS climbing shoes',
            'sort_order' => 3,
        ]);

        ProductImage::create([
            'product_id' => $p1->id,
            'image_url' => 'images/lasportiva_miura_vs3.jpg',
            'alt_text' => 'La Sportiva Miura VS climbing shoes',
            'sort_order' => 4,
        ]);

        ProductImage::create([
            'product_id' => $p1->id,
            'image_url' => 'images/lasportiva_miura_vs4.jpg',
            'alt_text' => 'La Sportiva Miura VS climbing shoes',
            'sort_order' => 5,
        ]);

        ProductImage::create([
            'product_id' => $p1->id,
            'image_url' => 'images/lasportiva_miura_vs5.jpg',
            'alt_text' => 'La Sportiva Miura VS climbing shoes',
            'sort_order' => 6,
        ]);

        ProductImage::create([
            'product_id' => $p2->id,
            'image_url' => 'images/E9_enove_bia-vs_women_pants.jpg',
            'alt_text' => "E9 Enove Bia women's pants",
            'sort_order' => 1,
        ]);

        ProductImage::create([
            'product_id' => $p2->id,
            'image_url' => 'images/E9_enove_bia-vs_women_pants1.jpg',
            'alt_text' => "E9 Enove Bia women's pants",
            'sort_order' => 2,
        ]);

        ProductImage::create([
            'product_id' => $p2->id,
            'image_url' => 'images/E9_enove_bia-vs_women_pants2.jpg',
            'alt_text' => "E9 Enove Bia women's pants",
            'sort_order' => 3,
        ]);

        ProductImage::create([
            'product_id' => $p2->id,
            'image_url' => 'images/E9_enove_bia-vs_women_pants3.jpg',
            'alt_text' => "E9 Enove Bia women's pants",
            'sort_order' => 4,
        ]);

        ProductImage::create([
            'product_id' => $p2->id,
            'image_url' => 'images/E9_enove_bia-vs_women_pants4.jpg',
            'alt_text' => "E9 Enove Bia women's pants",
            'sort_order' => 5,
        ]);

        ProductImage::create([
            'product_id' => $p2->id,
            'image_url' => 'images/E9_enove_bia-vs_women_pants5.jpg',
            'alt_text' => "E9 Enove Bia women's pants",
            'sort_order' => 6,
        ]);

        ProductImage::create([
            'product_id' => $p3->id,
            'image_url' => 'images/BD_black_diamond_vision_harness.jpg',
            'alt_text' => 'Black Diamond Vision Airnet Recco harness',
            'sort_order' => 1,
        ]);

        ProductImage::create([
            'product_id' => $p3->id,
            'image_url' => 'images/BD_black_diamond_vision_harness1.jpg',
            'alt_text' => 'Black Diamond Vision Airnet Recco harness',
            'sort_order' => 2,
        ]);

        ProductImage::create([
            'product_id' => $p3->id,
            'image_url' => 'images/BD_black_diamond_vision_harness2.jpg',
            'alt_text' => 'Black Diamond Vision Airnet Recco harness',
            'sort_order' => 3,
        ]);

        ProductImage::create([
            'product_id' => $p3->id,
            'image_url' => 'images/BD_black_diamond_vision_harness3.jpg',
            'alt_text' => 'Black Diamond Vision Airnet Recco harness',
            'sort_order' => 4,
        ]);

        ProductImage::create([
            'product_id' => $p3->id,
            'image_url' => 'images/BD_black_diamond_vision_harness4.jpg',
            'alt_text' => 'Black Diamond Vision Airnet Recco harness',
            'sort_order' => 5,
        ]);

        ProductImage::create([
            'product_id' => $p3->id,
            'image_url' => 'images/BD_black_diamond_vision_harness5.jpg',
            'alt_text' => 'Black Diamond Vision Airnet Recco harness',
            'sort_order' => 6,
        ]);

        ProductImage::create([
            'product_id' => $p3->id,
            'image_url' => 'images/BD_black_diamond_vision_harness6.jpg',
            'alt_text' => 'Black Diamond Vision Airnet Recco harness',
            'sort_order' => 7,
        ]);

        ProductImage::create([
            'product_id' => $p4->id,
            'image_url' => 'images/stan_chalk_bag.jpg',
            'alt_text' => 'Stan chalk bag',
            'sort_order' => 1,
        ]);

        ProductImage::create([
            'product_id' => $p4->id,
            'image_url' => 'images/stan_chalk_bag1.jpg',
            'alt_text' => 'Stan chalk bag',
            'sort_order' => 2,
        ]);

        ProductImage::create([
            'product_id' => $p4->id,
            'image_url' => 'images/stan_chalk_bag.jpg',
            'alt_text' => 'Stan chalk bag',
            'sort_order' => 3,
        ]);

        ProductImage::create([
            'product_id' => $p5->id,
            'image_url' => 'images/BD_black_diamond_half_dome_woman_climbing_helmet.jpg',
            'alt_text' => 'BD Black Diamond Half Dome Woman climbing helmet for women',
            'sort_order' => 1,
        ]);

        ProductImage::create([
            'product_id' => $p5->id,
            'image_url' => 'images/BD_black_diamond_half_dome_woman_climbing_helmet1.jpg',
            'alt_text' => 'BD Black Diamond Half Dome Woman climbing helmet for women',
            'sort_order' => 2,
        ]);

        ProductImage::create([
            'product_id' => $p6->id,
            'image_url' => 'images/beal_apollo_11_mm_dry_cover_red.jpg',
            'alt_text' => 'Beal Apollo II 11 mm Dry Cover climbing rope',
            'sort_order' => 1,
        ]);

        ProductImage::create([
            'product_id' => $p6->id,
            'image_url' => 'images/beal_apollo_11_mm_dry_cover_red1.jpg',
            'alt_text' => 'Beal Apollo II 11 mm Dry Cover climbing rope',
            'sort_order' => 2,
        ]);

        ProductImage::create([
            'product_id' => $p7->id,
            'image_url' => 'images/atom_hoody_w_black.jpg',
            'alt_text' => "Arc'teryx Atom Hoody W women's insulated jacket",
            'sort_order' => 1,
        ]);

        ProductImage::create([
            'product_id' => $p7->id,
            'image_url' => 'images/atom_hoody_w_black1.jpg',
            'alt_text' => "Arc'teryx Atom Hoody W women's insulated jacket",
            'sort_order' => 2,
        ]);

        ProductImage::create([
            'product_id' => $p7->id,
            'image_url' => 'images/atom_hoody_w_black2.jpg',
            'alt_text' => "Arc'teryx Atom Hoody W women's insulated jacket",
            'sort_order' => 3,
        ]);

        ProductImage::create([
            'product_id' => $p7->id,
            'image_url' => 'images/atom_hoody_w_black3.jpg',
            'alt_text' => "Arc'teryx Atom Hoody W women's insulated jacket",
            'sort_order' => 4,
        ]);

        ProductImage::create([
            'product_id' => $p7->id,
            'image_url' => 'images/atom_hoody_w_black4.jpg',
            'alt_text' => "Arc'teryx Atom Hoody W women's insulated jacket",
            'sort_order' => 5,
        ]);

        ProductImage::create([
            'product_id' => $p7->id,
            'image_url' => 'images/atom_hoody_w_black5.jpg',
            'alt_text' => "Arc'teryx Atom Hoody W women's insulated jacket",
            'sort_order' => 6,
        ]);

        ProductImage::create([
            'product_id' => $p7->id,
            'image_url' => 'images/atom_hoody_w_black6.jpg',
            'alt_text' => "Arc'teryx Atom Hoody W women's insulated jacket",
            'sort_order' => 7,
        ]);

        ProductImage::create([
            'product_id' => $p8->id,
            'image_url' => 'images/phil_chalk_bag.jpg',
            'alt_text' => 'Phil chalk bag',
            'sort_order' => 1,
        ]);

        ProductImage::create([
            'product_id' => $p8->id,
            'image_url' => 'images/phil_chalk_bag1.jpg',
            'alt_text' => 'Phil chalk bag',
            'sort_order' => 2,
        ]);

        ProductImage::create([
            'product_id' => $p8->id,
            'image_url' => 'images/phil_chalk_bag2.jpg',
            'alt_text' => 'Phil chalk bag',
            'sort_order' => 3,
        ]);

        ProductImage::create([
            'product_id' => $p8->id,
            'image_url' => 'images/phil_chalk_bag3.jpg',
            'alt_text' => 'Phil chalk bag',
            'sort_order' => 4,
        ]);

        ProductImage::create([
            'product_id' => $p9->id,
            'image_url' => 'images/chalk-65g-chalkbomb.jpg',
            'alt_text' => '8b+ 8BPLUS Chalk Bomb 65 g rechargeable magnesium ball',
            'sort_order' => 1,
        ]);

        ProductImage::create([
            'product_id' => $p9->id,
            'image_url' => 'images/chalk-65g-chalkbomb1.jpg',
            'alt_text' => '8b+ 8BPLUS Chalk Bomb 65 g rechargeable magnesium ball',
            'sort_order' => 2,
        ]);

        ProductImage::create([
            'product_id' => $p9->id,
            'image_url' => 'images/chalk-65g-chalkbomb2.jpg',
            'alt_text' => '8b+ 8BPLUS Chalk Bomb 65 g rechargeable magnesium ball',
            'sort_order' => 3,
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

        $p4->tags()->attach([
            $audienceTags['Men']->id,
            $audienceTags['Women']->id,
            $audienceTags['Kids']->id,
            $colorTags['Gray']->id,
        ]);

        $p5->tags()->attach([
            $audienceTags['Women']->id,
            $colorTags['Blue']->id,
            $clothingSizes['S']->id,
            $clothingSizes['M']->id,
        ]);

        $p6->tags()->attach([
            $audienceTags['Men']->id,
            $audienceTags['Women']->id,
            $audienceTags['Kids']->id,
            $colorTags['Red']->id,
        ]);

        $p7->tags()->attach([
            $audienceTags['Women']->id,
            $colorTags['Black']->id,
            $clothingSizes['XS']->id,
            $clothingSizes['S']->id,
            $clothingSizes['M']->id,
            $clothingSizes['L']->id,
        ]);

        $p8->tags()->attach([
            $audienceTags['Men']->id,
            $audienceTags['Women']->id,
            $audienceTags['Kids']->id,
            $colorTags['Gray']->id,
            $colorTags['Yellow']->id,
        ]);

        $p9->tags()->attach([
            $audienceTags['Men']->id,
            $audienceTags['Women']->id,
            $audienceTags['Kids']->id,
            $colorTags['White']->id,
        ]);


    }
}
