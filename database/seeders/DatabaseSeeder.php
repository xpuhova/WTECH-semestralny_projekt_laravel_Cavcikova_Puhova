<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use App\Models\DeliveryOption;
use App\Models\PaymentOption;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Tag;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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
        $adultShoeSizes = collect([
            '35', '35.5', '36', '36.5', '37', '37.5', '38', '38.5', '39', '39.5',
            '40', '40.5', '41', '41.5', '42', '42.5', '43', '43.5', '44', '44.5',
            '45', '45.5', '46',
        ])->mapWithKeys(function ($name) {
            return [$name => Tag::create([
                'name' => $name,
                'type' => 'adult_shoe_size',
            ])];
        });

        $kidsShoesSizes = collect([
            '33', '34', '35', '36', '37', '38',
        ])->mapWithKeys(function ($name) {
            return [$name => Tag::create([
                'name' => $name,
                'type' => 'kids_shoe_size',
            ])];
        });

        // Clothing sizes
        $adultClothingSizes = collect([
            'XXS', 'XS', 'S', 'M', 'L', 'XL',
        ])->mapWithKeys(function ($name) {
            return [$name => Tag::create([
                'name' => $name,
                'type' => 'adult_clothing_size',
            ])];
        });

        $kidsClothingSizes = collect([
            '2 Years', '4 Years', '6 Years', '8 Years', '10 Years', '12 Years',
        ])->mapWithKeys(function ($name) {
            return [$name => Tag::create([
                'name' => $name,
                'type' => 'kids_clothing_size',
            ])];
        });

        // Brands
        $laSportiva = Brand::create(['name' => 'La Sportiva']);
        $blackDiamond = Brand::create(['name' => 'Black Diamond']);
        $e9 = Brand::create(['name' => 'E9']);
        $eightBPLUS = Brand::create(['name' => '8b+ 8BPLUS']);
        $beal = Brand::create(['name' => 'Beal']);
        $arcteryx = Brand::create(['name' => "Arc'teryx"]);
        $patagonia = Brand::create(['name' => 'Patagonia']);

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
            'name' => 'BD Black Diamond Vision Airnet Recco harness',
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
            'name' => '8b+ 8BPLUS Chalk Bag Stan',
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
            'name' => '8b+ 8BPLUS Chalk Bag Phil',
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

        $p10 = Product::create([
            'name' => "E9 Enove B Pentago Peace children's shorts",
            'color' => 'Vintage Blue',
            'brand_id' => $e9->id,
            'category_id' => $clothing->id,
            'price' => 50.00,
            'discount_percent' => 10,
            'brief_description' => "Very comfortable children's climbing shorts perfect for summer",
            'detailed_description' => 'Durable outdoor and climbing shorts crafted from organic cotton gabardine, designed for active kids who love adventure. Features a printed side pocket for essentials and a dedicated brush holder—perfect for young climbers. The regular fit ensures excellent comfort during movement, while the breathable fabric keeps them cool on the trail. Proudly made in Italy with quality craftsmanship.',
            'features_specifications' => 'Gender: Unisex
            Season: Spring-Summer 2026
            Fit: Regular
            Material: 98% Cotton, 2% Elastane',
        ]);

        $p11 = Product::create([
            'name' => 'Patagonia Baby Furry Friends Hoody technical fleece baby jacket',
            'color' => 'Night Plum',
            'brand_id' => $patagonia->id,
            'category_id' => $clothing->id,
            'price' => 60.00,
            'discount_percent' => 0,
            'brief_description' => 'The ideal garment to protect the little ones on the coldest winter days',
            'detailed_description' => 'The Baby Furry Friends Hoody is made from high-pile, double-face 100% recycled polyester fleece that’s ultrasoft. The hoody has a three-panel hood with bear cub–style ears for added fun. Soft, cotton-twill tape at the inside neck and zipper pull provide ultimate comfort next to skin. Full zipper at center front with zipper garage for comfort and handwarmer pockets for warmth.',
            'features_specifications' => 'Gender: Unisex
            Season: Spring-Summer 2026
            Material: 100% Recycled Polyester
            Weight: 207 g',
        ]);

        $p12 = Product::create([
            'name' => "Patagonia Baby Furry Friends Hat children's hat",
            'color' => 'Mallow Pink',
            'brand_id' => $patagonia->id,
            'category_id' => $clothing->id,
            'price' => 30.00,
            'discount_percent' => 20,
            'brief_description' => 'An adorable hat perfect for winter walks and any outdoor moment',
            'detailed_description' => 'The Baby Furry Friends Fleece Hat by Patagonia is a fleece hat designed to protect children during cold days, perfect for winter walks and any outdoor moment. This adorable hat, with its cute bear ears, is made from soft and thick double-sided fleece weighing 292 g/m² of 100% recycled polyester, a material that offers exceptional warmth and incredible softness against the delicate skin of children. The double fabric band ensures optimal comfort and extra warmth, wrapping the head without being tight. In addition to its irresistible design, this hat represents an ethical and sustainable choice, being produced in a Fair Trade Certified™ facility, ensuring fair treatment for the workers who made it.',
            'features_specifications' => 'Gender: Unisex
            Season: Fall-Winter 2026
            Material: 100% Recycled Polyester
            Weight: 292 g',
        ]);

        $p13 = Product::create([
            'name' => "E9 Enove B-Wild children's t-shirt",
            'color' => 'Greenapple',
            'brand_id' => $e9->id,
            'category_id' => $clothing->id,
            'price' => 38.00,
            'discount_percent' => 11,
            'brief_description' => "A children's t-shirt designed for little adventurers who love the outdoors",
            'detailed_description' => "The B-Wild by E9 is a children's t-shirt designed for little adventurers who love the outdoors. Made from lightweight 100% organic cotton jersey, it ensures natural breathability and prolonged comfort on the skin during play and sports activities. The design features an original front print themed Into the Wild, which reflects the free spirit of the brand, and a regular fit that accommodates every movement. Thanks to the durability of the organic fibers and the attention to detail in the finishes, the B-Wild proves to be a resilient and versatile garment for everyday use and leisure time in nature.",
            'features_specifications' => 'Gender: Unisex
            Season: Spring-Summer 2026
            Material: Cotton',
        ]);

        $p14 = Product::create([
            'name' => "BD Black Diamond J Momentum Climbing Shoes children's climbing shoes",
            'color' => 'Grey (Pewter)',
            'brand_id' => $blackDiamond->id,
            'category_id' => $shoes->id,
            'price' => 75.00,
            'discount_percent' => 15,
            'brief_description' => 'Designed to provide the perfect balance between comfort and high performance for growing young climbers',
            'detailed_description' => "The Big Kids' Momentum shoe from Black Diamond is a climbing shoe for children and young people designed to provide the perfect balance between comfort and high performance for growing young climbers. Thanks to its flat and neutral shape, this shoe ensures lasting comfort throughout the day, making it ideal for long sessions in the gym or for first climbs at the crag. The model is built on a specific last for kids aged 7 to 12 years, ensuring a precise and customized fit that follows the development of the foot. The Black Label rubber sole is molded to offer maximum durability and reduced weight, ensuring consistent grip on all types of walls. The breathable mesh fabric tongue allows for excellent ventilation, while the microfiber midsole increases sensitivity and comfort during foot placement. The closure with a practical Velcro strap allows for easy adjustment of the fit and for putting on or taking off the shoes independently. The Big Kids' Momentum represents the ideal solution for young athletes looking for a technical yet comfortable shoe that can support their climbing progress without sacrificing ease of use and breathability.",
            'features_specifications' => 'Climbing Shoe Use: Boulder, Crag, Gym
            Climbing Shoe Sole Type: Full Sole
            Shoe Downturn: Comfortable
            Upper Material: Knitted Fabric
            Sole Material: BlackLabel Fuse',
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

        ProductImage::create([
            'product_id' => $p10->id,
            'image_url' => 'images/E9_b_pentago_peace_vintageblue.jpg',
            'alt_text' => "E9 Enove B Pentago Peace children's shorts",
            'sort_order' => 1,
        ]);

        ProductImage::create([
            'product_id' => $p11->id,
            'image_url' => 'images/patagonia_furry_jacket.jpg',
            'alt_text' => 'Patagonia Baby Furry Friends Hoody technical fleece baby jacket',
            'sort_order' => 1,
        ]);

        ProductImage::create([
            'product_id' => $p12->id,
            'image_url' => 'images/patagonia-baby-furry-friends-hat-mallow-pink.jpg',
            'alt_text' => "Patagonia Baby Furry Friends Hat children's hat",
            'sort_order' => 1,
        ]);

        ProductImage::create([
            'product_id' => $p13->id,
            'image_url' => 'images/E9_b_greenapple.jpg',
            'alt_text' => "E9 Enove B-Wild children's t-shirt",
            'sort_order' => 1,
        ]);

        ProductImage::create([
            'product_id' => $p13->id,
            'image_url' => 'images/E9_b_greenapple1.jpg',
            'alt_text' => "E9 Enove B-Wild children's t-shirt",
            'sort_order' => 2,
        ]);

        ProductImage::create([
            'product_id' => $p14->id,
            'image_url' => 'images/J_Momentum_Climbing_ShoesPewter.jpg',
            'alt_text' => "BD Black Diamond J Momentum Climbing Shoes children's climbing shoes",
            'sort_order' => 1,
        ]);

        ProductImage::create([
            'product_id' => $p14->id,
            'image_url' => 'images/j_Momentum_Climbing_ShoesPewter2.jpg',
            'alt_text' => "BD Black Diamond J Momentum Climbing Shoes children's climbing shoes",
            'sort_order' => 2,
        ]);

        ProductImage::create([
            'product_id' => $p14->id,
            'image_url' => 'images/j_Momentum_Climbing_ShoesPewter3.jpg',
            'alt_text' => "BD Black Diamond J Momentum Climbing Shoes children's climbing shoes",
            'sort_order' => 3,
        ]);

        ProductImage::create([
            'product_id' => $p14->id,
            'image_url' => 'images/j_Momentum_Climbing_ShoesPewter4.jpg',
            'alt_text' => "BD Black Diamond J Momentum Climbing Shoes children's climbing shoes",
            'sort_order' => 4,
        ]);

        ProductImage::create([
            'product_id' => $p14->id,
            'image_url' => 'images/j_Momentum_Climbing_ShoesPewter5.jpg',
            'alt_text' => "BD Black Diamond J Momentum Climbing Shoes children's climbing shoes",
            'sort_order' => 5,
        ]);

        ProductImage::create([
            'product_id' => $p14->id,
            'image_url' => 'images/j_Momentum_Climbing_ShoesPewter6.jpg',
            'alt_text' => "BD Black Diamond J Momentum Climbing Shoes children's climbing shoes",
            'sort_order' => 6,
        ]);

        ProductImage::create([
            'product_id' => $p14->id,
            'image_url' => 'images/j_Momentum_Climbing_ShoesPewter7.jpg',
            'alt_text' => "BD Black Diamond J Momentum Climbing Shoes children's climbing shoes",
            'sort_order' => 7,
        ]);

        // Product tags
        $p1->tags()->attach([
            $audienceTags['Men']->id,
            $audienceTags['Women']->id,
            $colorTags['Black']->id,
            $colorTags['Yellow']->id,
            $adultShoeSizes['35']->id,
            $adultShoeSizes['35.5']->id,
            $adultShoeSizes['36']->id,
            $adultShoeSizes['36.5']->id,
            $adultShoeSizes['37']->id,
            $adultShoeSizes['37.5']->id,
            $adultShoeSizes['38']->id,
            $adultShoeSizes['38.5']->id,
            $adultShoeSizes['39']->id,
            $adultShoeSizes['39.5']->id,
            $adultShoeSizes['40']->id,
            $adultShoeSizes['40.5']->id,
            $adultShoeSizes['41']->id,
            $adultShoeSizes['41.5']->id,
            $adultShoeSizes['42']->id,
            $adultShoeSizes['42.5']->id,
            $adultShoeSizes['43']->id,
            $adultShoeSizes['43.5']->id,
            $adultShoeSizes['44']->id,
            $adultShoeSizes['44.5']->id,
            $adultShoeSizes['45']->id,
            $adultShoeSizes['45.5']->id,
            $adultShoeSizes['46']->id,
            $promoTags['Sale']->id,
        ]);

        $p2->tags()->attach([
            $audienceTags['Women']->id,
            $colorTags['Pink']->id,
            $adultClothingSizes['XXS']->id,
            $adultClothingSizes['XS']->id,
            $adultClothingSizes['S']->id,
            $adultClothingSizes['M']->id,
            $adultClothingSizes['L']->id,
            $adultClothingSizes['XL']->id,
        ]);

        $p3->tags()->attach([
            $audienceTags['Men']->id,
            $audienceTags['Women']->id,
            $colorTags['Black']->id,
            $colorTags['Green']->id,
            $adultClothingSizes['S']->id,
            $adultClothingSizes['M']->id,
            $adultClothingSizes['L']->id,
            $adultClothingSizes['XL']->id,
        ]);

        $p4->tags()->attach([
            $audienceTags['Men']->id,
            $audienceTags['Women']->id,
            $audienceTags['Kids']->id,
            $colorTags['Gray']->id,
            $promoTags['Sale']->id,
        ]);

        $p5->tags()->attach([
            $audienceTags['Women']->id,
            $colorTags['Blue']->id,
            $adultClothingSizes['S']->id,
            $adultClothingSizes['M']->id,
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
            $adultClothingSizes['XS']->id,
            $adultClothingSizes['S']->id,
            $adultClothingSizes['M']->id,
            $adultClothingSizes['L']->id,
        ]);

        $p8->tags()->attach([
            $audienceTags['Men']->id,
            $audienceTags['Women']->id,
            $audienceTags['Kids']->id,
            $colorTags['Gray']->id,
            $colorTags['Yellow']->id,
            $promoTags['Sale']->id,
        ]);

        $p9->tags()->attach([
            $audienceTags['Men']->id,
            $audienceTags['Women']->id,
            $audienceTags['Kids']->id,
            $colorTags['White']->id,
        ]);

        $p10->tags()->attach([
            $audienceTags['Kids']->id,
            $colorTags['Blue']->id,
            $kidsClothingSizes['2 Years']->id,
            $kidsClothingSizes['4 Years']->id,
            $kidsClothingSizes['6 Years']->id,
            $kidsClothingSizes['8 Years']->id,
            $kidsClothingSizes['10 Years']->id,
            $kidsClothingSizes['12 Years']->id,
            $promoTags['Sale']->id,
        ]);

        $p11->tags()->attach([
            $audienceTags['Kids']->id,
            $colorTags['Purple']->id,
            $kidsClothingSizes['2 Years']->id,
            $kidsClothingSizes['4 Years']->id,
            $kidsClothingSizes['6 Years']->id,
        ]);

        $p12->tags()->attach([
            $audienceTags['Kids']->id,
            $colorTags['Pink']->id,
            $promoTags['Sale']->id,
        ]);

        $p13->tags()->attach([
            $audienceTags['Kids']->id,
            $colorTags['Green']->id,
            $kidsClothingSizes['10 Years']->id,
            $kidsClothingSizes['12 Years']->id,
        ]);

        $p14->tags()->attach([
            $audienceTags['Kids']->id,
            $colorTags['Gray']->id,
            $kidsShoesSizes['33']->id,
            $kidsShoesSizes['34']->id,
            $kidsShoesSizes['35']->id,
            $kidsShoesSizes['36']->id,
            $kidsShoesSizes['37']->id,
            $kidsShoesSizes['38']->id,
            $promoTags['Sale']->id,
        ]);

        DeliveryOption::create(['name' => 'Economy Delivery', 'description' => '5–7 business days', 'price' => 0.00]);
        DeliveryOption::create(['name' => 'Standard Delivery', 'description' => '2–4 business days', 'price' => 3.99]);
        DeliveryOption::create(['name' => 'Express Delivery', 'description' => '1–2 business days', 'price' => 7.99]);
        DeliveryOption::create(['name' => 'Pickup Point', 'description' => '1–2 business days', 'price' => 0.00]);

        PaymentOption::create(['name' => 'Credit / Debit Card', 'description' => 'Visa, Mastercard']);
        PaymentOption::create(['name' => 'PayPal', 'description' => 'Pay securely with your PayPal account']);
        PaymentOption::create(['name' => 'Cash on Delivery', 'description' => 'Pay when your order arrives']);
        PaymentOption::create(['name' => 'Bank Transfer', 'description' => 'Send payment directly from your bank']);

        User::create([
            'first_name' => 'Steve',
            'last_name' => 'Person',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);
    }
}
