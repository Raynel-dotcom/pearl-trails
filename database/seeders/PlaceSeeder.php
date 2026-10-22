<?php

namespace Database\Seeders;

use App\Models\Destination;
use App\Models\Place;
use Illuminate\Database\Seeder;

class PlaceSeeder extends Seeder
{
    public function run(): void
    {
        $destinations = Destination::all();

        // 1. Seed Stays from hotel_names and accommodation_costs for each destination
        foreach ($destinations as $dest) {
            $hotelNames = $dest->hotel_names ?? [];
            $costs = $dest->accommodation_costs ?? [];

            $styleTypes = [
                'Budget'   => 'Hostel/Budget',
                'Moderate' => 'Lodge/Moderate',
                'Luxury'   => 'Hotel/Luxury',
            ];

            foreach ($styleTypes as $style => $typeName) {
                if (!empty($hotelNames[$style]) && isset($costs[$style])) {
                    $hotelName = $hotelNames[$style];
                    Place::updateOrCreate(
                        [
                            'destination_id' => $dest->id,
                            'category' => 'stay',
                            'name' => $hotelName,
                        ],
                        [
                            'price_ugx' => (int) $costs[$style],
                            'unit' => 'night',
                            'type' => $typeName,
                            'description' => "Quality {$style} accommodation near {$dest->name}.",
                            'image_path' => $this->resolveStayImage($hotelName, $style),
                        ]
                    );
                }
            }
        }

        // 2. Specific Eat, Recreation, and Visit places
        $placesData = [
            'jinja' => [
                'eat' => [
                    ['name' => 'All Friends Food Bar & Grill', 'price_ugx' => 25000, 'unit' => 'meal', 'type' => 'Restaurant'],
                    ['name' => 'The Source Cafe Jinja', 'price_ugx' => 18000, 'unit' => 'meal', 'type' => 'Cafe'],
                    ['name' => 'Java House Jinja', 'price_ugx' => 35000, 'unit' => 'meal', 'type' => 'Casual Dining'],
                    ['name' => 'Igar Cafe & Bakery', 'price_ugx' => 15000, 'unit' => 'meal', 'type' => 'Bakery & Snacks'],
                ],
                'recreation' => [
                    ['name' => 'Adrift River Adventures Rafting', 'price_ugx' => 280000, 'unit' => 'entry', 'type' => 'Activity Centre'],
                    ['name' => 'Nile River Tubing Crew', 'price_ugx' => 60000, 'unit' => 'entry', 'type' => 'River Recreation'],
                    ['name' => 'All Terrain Quad Adventures', 'price_ugx' => 150000, 'unit' => 'entry', 'type' => 'Off-road Park'],
                    ['name' => 'Nile Horseback Safaris', 'price_ugx' => 120000, 'unit' => 'entry', 'type' => 'Equine Trails'],
                ],
                'visit' => [
                    ['name' => 'Source of the River Nile Monument', 'price_ugx' => 10000, 'unit' => 'entry', 'type' => 'Historical Monument'],
                    ['name' => 'Busowoko Falls Eco Park', 'price_ugx' => 15000, 'unit' => 'entry', 'type' => 'Natural Waterfall'],
                    ['name' => 'Itanda Rapids Viewpoint', 'price_ugx' => 10000, 'unit' => 'entry', 'type' => 'Scenic River Rapids'],
                ],
            ],
            'sipi-falls' => [
                'eat' => [
                    ['name' => 'Sipi Coffee View Cafe', 'price_ugx' => 15000, 'unit' => 'meal', 'type' => 'Cafe'],
                    ['name' => 'Lacam Verandah Diner', 'price_ugx' => 28000, 'unit' => 'meal', 'type' => 'Restaurant'],
                    ['name' => 'Rafiki Terrace Dining', 'price_ugx' => 35000, 'unit' => 'meal', 'type' => 'Bistro'],
                ],
                'recreation' => [
                    ['name' => 'Sipi Falls Abseiling Experience', 'price_ugx' => 140000, 'unit' => 'entry', 'type' => 'Extreme Sports'],
                    ['name' => 'Chebonet River Rock Scramble', 'price_ugx' => 40000, 'unit' => 'entry', 'type' => 'Guided Trek'],
                    ['name' => 'Elgon Ridge Mountain Biking', 'price_ugx' => 70000, 'unit' => 'entry', 'type' => 'Bike Trail'],
                ],
                'visit' => [
                    ['name' => 'Sipi Three-Falls Trail Access', 'price_ugx' => 30000, 'unit' => 'entry', 'type' => 'Waterfall Trail'],
                    ['name' => 'Bugisu Arabica Coffee Farm Walk', 'price_ugx' => 25000, 'unit' => 'entry', 'type' => 'Agro-Tourism'],
                    ['name' => 'Tewei Forest Sanctuary', 'price_ugx' => 15000, 'unit' => 'entry', 'type' => 'Forest Reserve'],
                ],
            ],
            'murchison-falls-np' => [
                'eat' => [
                    ['name' => 'Red Chilli River Camp Restaurant', 'price_ugx' => 30000, 'unit' => 'meal', 'type' => 'Safari Camp Diner'],
                    ['name' => 'Pakuba Safari Restaurant', 'price_ugx' => 50000, 'unit' => 'meal', 'type' => 'Lodge Dining'],
                    ['name' => 'Paraa Safari Riverside Terrace', 'price_ugx' => 70000, 'unit' => 'meal', 'type' => 'Fine Dining'],
                ],
                'recreation' => [
                    ['name' => 'Nile Launch Boat to Base of Falls', 'price_ugx' => 110000, 'unit' => 'entry', 'type' => 'River Cruise'],
                    ['name' => 'Budongo Forest Chimpanzee Trek', 'price_ugx' => 220000, 'unit' => 'entry', 'type' => 'Primate Sanctuary'],
                    ['name' => 'Albert Nile Delta Wildlife Boat', 'price_ugx' => 150000, 'unit' => 'entry', 'type' => 'Birding Safari'],
                ],
                'visit' => [
                    ['name' => 'Top of Murchison Falls Gorge Trail', 'price_ugx' => 35000, 'unit' => 'entry', 'type' => 'National Park Site'],
                    ['name' => 'Paraa Ferry Nile Crossing', 'price_ugx' => 20000, 'unit' => 'entry', 'type' => 'Scenic Crossing'],
                    ['name' => 'Kaniyo Pabidi Mahogany Forest', 'price_ugx' => 40000, 'unit' => 'entry', 'type' => 'Nature Reserve'],
                ],
            ],
            'queen-elizabeth-np' => [
                'eat' => [
                    ['name' => 'Tembo Canteen & Grill', 'price_ugx' => 25000, 'unit' => 'meal', 'type' => 'Local Grill'],
                    ['name' => 'Kazinga Channel Lookout Bistro', 'price_ugx' => 45000, 'unit' => 'meal', 'type' => 'Lodge Dining'],
                    ['name' => 'Bush Lodge River View Diner', 'price_ugx' => 50000, 'unit' => 'meal', 'type' => 'Eco-Diner'],
                ],
                'recreation' => [
                    ['name' => 'UWA Kazinga Channel 2hr Boat Safari', 'price_ugx' => 110000, 'unit' => 'entry', 'type' => 'Channel Cruise'],
                    ['name' => 'Kyambura Gorge Chimp Tracking', 'price_ugx' => 200000, 'unit' => 'entry', 'type' => 'Primate Trek'],
                    ['name' => 'Ishasha Tree-Climbing Lion Guided Drive', 'price_ugx' => 90000, 'unit' => 'entry', 'type' => 'Ranger Guided Safari'],
                ],
                'visit' => [
                    ['name' => 'Lake Katwe Traditional Salt Mines', 'price_ugx' => 20000, 'unit' => 'entry', 'type' => 'Heritage Site'],
                    ['name' => 'Bunyaruguru Twin Crater Lookout', 'price_ugx' => 10000, 'unit' => 'entry', 'type' => 'Crater Viewpoint'],
                    ['name' => 'Kikorongo Equator Monument', 'price_ugx' => 5000, 'unit' => 'entry', 'type' => 'Geographical Landmark'],
                ],
            ],
            'bwindi' => [
                'eat' => [
                    ['name' => 'Buhoma Community Rest Haven Meals', 'price_ugx' => 30000, 'unit' => 'meal', 'type' => 'Community Restaurant'],
                    ['name' => 'Bakiga Lodge Organic Kitchen', 'price_ugx' => 45000, 'unit' => 'meal', 'type' => 'Lodge Dining'],
                    ['name' => 'Silverback Gorilla Bistro', 'price_ugx' => 55000, 'unit' => 'meal', 'type' => 'Fine Dining'],
                ],
                'recreation' => [
                    ['name' => 'Batwa Cultural Forest Experience', 'price_ugx' => 120000, 'unit' => 'entry', 'type' => 'Cultural Trail'],
                    ['name' => 'Munyaga Waterfall Rainforest Walk', 'price_ugx' => 70000, 'unit' => 'entry', 'type' => 'Forest Nature Trail'],
                    ['name' => 'Bwindi Community Bike Tour', 'price_ugx' => 60000, 'unit' => 'entry', 'type' => 'Cycling Tour'],
                ],
                'visit' => [
                    ['name' => 'Ride 4 a Woman Craft Center', 'price_ugx' => 10000, 'unit' => 'entry', 'type' => 'Artisan Cooperative'],
                    ['name' => 'Buhoma Gorilla Hospital Visitor Wing', 'price_ugx' => 15000, 'unit' => 'entry', 'type' => 'Conservation Education'],
                ],
            ],
            'lake-bunyonyi' => [
                'eat' => [
                    ['name' => 'Bunyonyi Overland Lake Bar & Grill', 'price_ugx' => 22000, 'unit' => 'meal', 'type' => 'Lakeside Grill'],
                    ['name' => 'Arcadia Highlands Panoramic Restaurant', 'price_ugx' => 38000, 'unit' => 'meal', 'type' => 'Scenic Dining'],
                    ['name' => 'BirdNest Belgo-Ugandan Kitchen', 'price_ugx' => 55000, 'unit' => 'meal', 'type' => 'Fine Dining'],
                ],
                'recreation' => [
                    ['name' => 'Supreme Adventure Park Zipline over Lake', 'price_ugx' => 80000, 'unit' => 'entry', 'type' => 'Adventure Park'],
                    ['name' => 'Bunyonyi Motorized Canoe Safari', 'price_ugx' => 60000, 'unit' => 'entry', 'type' => 'Boat Cruise'],
                    ['name' => 'Traditional Dugout Canoe Rental & Lesson', 'price_ugx' => 25000, 'unit' => 'entry', 'type' => 'Water Sports'],
                ],
                'visit' => [
                    ['name' => 'Akampene (Punishment Island) Historical Tour', 'price_ugx' => 30000, 'unit' => 'entry', 'type' => 'Historic Island'],
                    ['name' => 'Kyahugye Island Zebra & Impala Sanctuary', 'price_ugx' => 45000, 'unit' => 'entry', 'type' => 'Island Wildlife Reserve'],
                    ['name' => 'Arcadia 360-degree Hills Viewpoint', 'price_ugx' => 10000, 'unit' => 'entry', 'type' => 'Scenic Viewpoint'],
                ],
            ],
            'fort-portal' => [
                'eat' => [
                    ['name' => 'Gardens Restaurant Fort Portal', 'price_ugx' => 20000, 'unit' => 'meal', 'type' => 'Local & Continental'],
                    ['name' => 'The Dutchess European Diner', 'price_ugx' => 35000, 'unit' => 'meal', 'type' => 'Bistro & Pizzeria'],
                    ['name' => 'Mountains of the Moon Verandah', 'price_ugx' => 45000, 'unit' => 'meal', 'type' => 'Hotel Dining'],
                ],
                'recreation' => [
                    ['name' => 'Ndali-Kasenda Guided Crater Bike Tour', 'price_ugx' => 65000, 'unit' => 'entry', 'type' => 'Cycling Excursion'],
                    ['name' => 'Mpanga Tea Estate Tour & Tasting', 'price_ugx' => 30000, 'unit' => 'entry', 'type' => 'Agro-Tourism'],
                    ['name' => 'Top of the World Viewpoint Hike', 'price_ugx' => 20000, 'unit' => 'entry', 'type' => 'Scenic Trek'],
                ],
                'visit' => [
                    ['name' => 'Amabere Ga Nyina Mwiru Caves & Waterfalls', 'price_ugx' => 25000, 'unit' => 'entry', 'type' => 'Stalactite Caves'],
                    ['name' => 'Karuzika Palace of Tooro Kingdom', 'price_ugx' => 15000, 'unit' => 'entry', 'type' => 'Royal Heritage'],
                    ['name' => 'Kyaninga Crater Rim Trail', 'price_ugx' => 15000, 'unit' => 'entry', 'type' => 'Crater Lake'],
                ],
            ],
            'rwenzori' => [
                'eat' => [
                    ['name' => 'Trekkers Rest Canteen Kilembe', 'price_ugx' => 25000, 'unit' => 'meal', 'type' => 'Mountain Canteen'],
                    ['name' => 'Equator Snow Alpine Diner', 'price_ugx' => 45000, 'unit' => 'meal', 'type' => 'Lodge Dining'],
                    ['name' => 'Kasese Spring International Cafe', 'price_ugx' => 18000, 'unit' => 'meal', 'type' => 'Town Cafe'],
                ],
                'recreation' => [
                    ['name' => '1-Day Mahoma Nature Trail Hike', 'price_ugx' => 120000, 'unit' => 'entry', 'type' => 'Guided Trek'],
                    ['name' => 'Ruboni Community Village Cultural Walk', 'price_ugx' => 40000, 'unit' => 'entry', 'type' => 'Cultural Trail'],
                    ['name' => 'River Mubuku Whitewater Scramble', 'price_ugx' => 60000, 'unit' => 'entry', 'type' => 'Mountain Activity'],
                ],
                'visit' => [
                    ['name' => 'Nyakalengija Trailhead Interpretive Center', 'price_ugx' => 15000, 'unit' => 'entry', 'type' => 'Mountaineering Center'],
                    ['name' => 'Ruboni Hilltop Viewpoint of Mount Stanley', 'price_ugx' => 20000, 'unit' => 'entry', 'type' => 'Mountain Lookout'],
                ],
            ],
            'kidepo' => [
                'eat' => [
                    ['name' => 'Apoka Rest Camp Canteen', 'price_ugx' => 25000, 'unit' => 'meal', 'type' => 'Camp Canteen'],
                    ['name' => 'Kidepo Savannah Lodge Open-Air Dining', 'price_ugx' => 45000, 'unit' => 'meal', 'type' => 'Lodge Dining'],
                    ['name' => 'Apoka Safari Lodge Gourmet Table', 'price_ugx' => 80000, 'unit' => 'meal', 'type' => 'Luxury Dining'],
                ],
                'recreation' => [
                    ['name' => 'Lorukul Cultural Karamojong Manyattas Walk', 'price_ugx' => 50000, 'unit' => 'entry', 'type' => 'Cultural Immersion'],
                    ['name' => 'Guided Bush Nature Walk in Narus', 'price_ugx' => 80000, 'unit' => 'entry', 'type' => 'Walking Safari'],
                    ['name' => 'Night Spotlight Game Drive', 'price_ugx' => 120000, 'unit' => 'entry', 'type' => 'Night Safari'],
                ],
                'visit' => [
                    ['name' => 'Kanangorok Hot Springs on South Sudan Border', 'price_ugx' => 20000, 'unit' => 'entry', 'type' => 'Geothermal Springs'],
                    ['name' => 'Narus Valley Wildlife Waterhole Hide', 'price_ugx' => 15000, 'unit' => 'entry', 'type' => 'Wildlife Hide'],
                ],
            ],
            'entebbe' => [
                'eat' => [
                    ['name' => 'Goretti\'s Pizzeria on the Beach', 'price_ugx' => 30000, 'unit' => 'meal', 'type' => 'Beach Restaurant'],
                    ['name' => 'Cafe Javas Entebbe Mall', 'price_ugx' => 35000, 'unit' => 'meal', 'type' => 'Modern Casual'],
                    ['name' => '2 Friends Waterfront Seafood Bar', 'price_ugx' => 50000, 'unit' => 'meal', 'type' => 'Lakeside Dining'],
                ],
                'recreation' => [
                    ['name' => 'Ngamba Island Day Excursion & Speedboat', 'price_ugx' => 240000, 'unit' => 'entry', 'type' => 'Sanctuary Cruise'],
                    ['name' => 'Mabamba Swamp Shoebill Wooden Canoe', 'price_ugx' => 90000, 'unit' => 'entry', 'type' => 'Birding Safari'],
                    ['name' => 'Sunset Yacht Cruise on Lake Victoria', 'price_ugx' => 120000, 'unit' => 'entry', 'type' => 'Lake Cruise'],
                ],
                'visit' => [
                    ['name' => 'Entebbe National Botanical Gardens', 'price_ugx' => 20000, 'unit' => 'entry', 'type' => 'Botanical Park'],
                    ['name' => 'UWEC (Uganda Wildlife Conservation Zoo)', 'price_ugx' => 25000, 'unit' => 'entry', 'type' => 'Wildlife Zoo'],
                    ['name' => 'Uganda Reptile Village', 'price_ugx' => 15000, 'unit' => 'entry', 'type' => 'Reptile Sanctuary'],
                ],
            ],
            'kampala' => [
                'eat' => [
                    ['name' => '2K Restaurant Nakasero (Local Cuisine)', 'price_ugx' => 22000, 'unit' => 'meal', 'type' => 'Authentic Local'],
                    ['name' => 'Cafe Javas Oasis Mall', 'price_ugx' => 35000, 'unit' => 'meal', 'type' => 'Modern Casual'],
                    ['name' => 'Fang Fang Chinese Restaurant', 'price_ugx' => 45000, 'unit' => 'meal', 'type' => 'Asian Dining'],
                    ['name' => 'The Lawns Wild Game & Grill Kololo', 'price_ugx' => 65000, 'unit' => 'meal', 'type' => 'Steakhouse'],
                ],
                'recreation' => [
                    ['name' => 'Ndere Cultural Centre Troupe Night Show', 'price_ugx' => 60000, 'unit' => 'entry', 'type' => 'Cultural Theater'],
                    ['name' => 'Kampala Rolex & Street Food Walking Safari', 'price_ugx' => 45000, 'unit' => 'entry', 'type' => 'Culinary Tour'],
                    ['name' => 'Uganda National Theatre Performing Arts', 'price_ugx' => 30000, 'unit' => 'entry', 'type' => 'Live Theater'],
                ],
                'visit' => [
                    ['name' => 'Kasubi Royal Tombs UNESCO World Heritage', 'price_ugx' => 25000, 'unit' => 'entry', 'type' => 'Historical Heritage'],
                    ['name' => 'Uganda National Museum Kira Road', 'price_ugx' => 15000, 'unit' => 'entry', 'type' => 'National Museum'],
                    ['name' => 'Gaddafi National Mosque Minaret Tower', 'price_ugx' => 20000, 'unit' => 'entry', 'type' => 'Architectural Landmark'],
                    ['name' => 'Bahai Temple of Africa Gardens', 'price_ugx' => 5000, 'unit' => 'entry', 'type' => 'Spiritual Sanctuary'],
                ],
            ],
            'ssese-islands' => [
                'eat' => [
                    ['name' => 'Kalangala Beach Camp Fish Fry', 'price_ugx' => 20000, 'unit' => 'meal', 'type' => 'Beach BBQ'],
                    ['name' => 'Brovad Sands Lakeside Buffet', 'price_ugx' => 45000, 'unit' => 'meal', 'type' => 'Resort Dining'],
                    ['name' => 'Victoria Forest Verandah Grill', 'price_ugx' => 50000, 'unit' => 'meal', 'type' => 'Island Bistro'],
                ],
                'recreation' => [
                    ['name' => 'Ssese Island Quad Bike Trail Safari', 'price_ugx' => 100000, 'unit' => 'entry', 'type' => 'Off-road Trail'],
                    ['name' => 'Lake Victoria Nile Perch Sport Fishing', 'price_ugx' => 150000, 'unit' => 'entry', 'type' => 'Sport Fishing'],
                    ['name' => 'Bugala Island Forest Monkey Walk', 'price_ugx' => 30000, 'unit' => 'entry', 'type' => 'Nature Trail'],
                ],
                'visit' => [
                    ['name' => 'Lutoboka Bay Pier & White Sands', 'price_ugx' => 10000, 'unit' => 'entry', 'type' => 'Sandy Beach'],
                    ['name' => 'Nanziri Sacred Falls & Cave Shrine', 'price_ugx' => 20000, 'unit' => 'entry', 'type' => 'Cultural Shrine'],
                ],
            ],
            'lake-mburo-np' => [
                'eat' => [
                    ['name' => 'Rwakobo Rock Sunset Diner', 'price_ugx' => 30000, 'unit' => 'meal', 'type' => 'Eco-Camp Dining'],
                    ['name' => 'Arcadia Cottages Lakeside Grill', 'price_ugx' => 45000, 'unit' => 'meal', 'type' => 'Lodge Dining'],
                    ['name' => 'Mihingo Lodge Cliff Restaurant', 'price_ugx' => 75000, 'unit' => 'meal', 'type' => 'Fine Dining'],
                ],
                'recreation' => [
                    ['name' => 'Guided Savannah Walking Safari on Foot', 'price_ugx' => 75000, 'unit' => 'entry', 'type' => 'Walking Safari'],
                    ['name' => 'Mihingo Horseback Wildlife Safari (2hr)', 'price_ugx' => 220000, 'unit' => 'entry', 'type' => 'Horse Riding'],
                    ['name' => 'Lake Mburo 2hr Motorboat Cruise', 'price_ugx' => 90000, 'unit' => 'entry', 'type' => 'Boat Cruise'],
                ],
                'visit' => [
                    ['name' => 'Kazuma Hill Lookout Panoramic Deck', 'price_ugx' => 15000, 'unit' => 'entry', 'type' => 'Lookout Deck'],
                    ['name' => 'Ankole Cultural Cattle Sanctuary', 'price_ugx' => 25000, 'unit' => 'entry', 'type' => 'Living Heritage'],
                ],
            ],
        ];

        foreach ($placesData as $slug => $categories) {
            $dest = $destinations->firstWhere('slug', $slug);
            if (!$dest) continue;

            foreach ($categories as $cat => $items) {
                foreach ($items as $item) {
                    Place::updateOrCreate(
                        [
                            'destination_id' => $dest->id,
                            'category' => $cat,
                            'name' => $item['name'],
                        ],
                        [
                            'price_ugx' => $item['price_ugx'],
                            'unit' => $item['unit'],
                            'type' => $item['type'],
                            'description' => "Popular {$cat} destination in {$dest->name}.",
                            'image_path' => $this->resolvePlaceImage($cat, $item['name'], $dest),
                        ]
                    );
                }
            }
        }
    }

    protected function resolveStayImage(string $name, string $style): string
    {
        $lower = strtolower($name);

        if (str_contains($lower, 'kyaninga')) {
            return str_contains($lower, 'room')
                ? 'images/hotels/kyaninga-lodge-room.webp'
                : 'images/hotels/kyaninga-lodge-aerial.webp';
        }
        if (str_contains($lower, 'ishasha')) {
            return 'images/hotels/ishasha-wilderness-camp.webp';
        }
        if (str_contains($lower, 'igongo')) {
            return 'images/hotels/igongo-country-hotel.webp';
        }

        if ($style === 'Luxury') {
            return (abs(crc32($name)) % 2 === 0)
                ? 'images/hotels/hotel-room-canopy-bed.webp'
                : 'images/hotels/kyaninga-lodge-aerial.webp';
        }

        if ($style === 'Moderate') {
            return (abs(crc32($name)) % 2 === 0)
                ? 'images/hotels/hotel-cottages-pool.webp'
                : 'images/hotels/kyaninga-lodge-room.webp';
        }

        // Budget
        return (abs(crc32($name)) % 2 === 0)
            ? 'images/hotels/ishasha-wilderness-camp.webp'
            : 'images/hotels/hotel-cottages-pool.webp';
    }

    protected function resolvePlaceImage(string $category, string $name, Destination $dest): string
    {
        $lower = strtolower($name);

        if ($category === 'eat') {
            if (str_contains($lower, 'java') || str_contains($lower, 'cafe') || str_contains($lower, 'bakery') || str_contains($lower, 'coffee')) {
                return 'images/restaurants/cafe-javas.webp';
            }
            if (str_contains($lower, 'cabana') || str_contains($lower, 'grill') || str_contains($lower, 'bar')) {
                return 'images/restaurants/la-cabana-restaurant.webp';
            }
            if (str_contains($lower, 'mediterraneo') || str_contains($lower, 'terrace') || str_contains($lower, 'fine') || str_contains($lower, 'serena')) {
                return 'images/restaurants/mediterraneo-restaurant-kampala.webp';
            }
            if (str_contains($lower, 'lawns') || str_contains($lower, 'garden') || str_contains($lower, 'verandah')) {
                return 'images/restaurants/the-lawns-restaurant.webp';
            }
            if (str_contains($lower, 'piato') || str_contains($lower, 'bistro') || str_contains($lower, 'diner')) {
                return 'images/restaurants/piato-restaurant.webp';
            }
            if (str_contains($lower, 'asian') || str_contains($lower, 'fusion') || str_contains($lower, 'spice') || str_contains($lower, 'curry')) {
                return 'images/restaurants/asian-fusion-restaurant.webp';
            }
            if (str_contains($lower, 'rolex') || str_contains($lower, 'local') || str_contains($lower, 'roots') || str_contains($lower, 'food') || str_contains($lower, 'platter')) {
                return 'images/restaurants/ugandan-food-platter.webp';
            }

            $restaurantPool = [
                'images/restaurants/cafe-javas.webp',
                'images/restaurants/la-cabana-restaurant.webp',
                'images/restaurants/mediterraneo-restaurant-kampala.webp',
                'images/restaurants/the-lawns-restaurant.webp',
                'images/restaurants/piato-restaurant.webp',
                'images/restaurants/asian-fusion-restaurant.webp',
                'images/restaurants/ugandan-food-platter.webp',
            ];
            return $restaurantPool[abs(crc32($name)) % count($restaurantPool)];
        }

        if ($category === 'recreation') {
            if (str_contains($lower, 'quad') || str_contains($lower, 'bike') || str_contains($lower, 'biking') || str_contains($lower, 'off-road')) {
                return 'images/recreation centres/jinja-qaud-biking-1024x678-1.webp';
            }
            if (str_contains($lower, 'horse') || str_contains($lower, 'equine') || str_contains($lower, 'walking') || str_contains($lower, 'safari')) {
                return 'images/recreation centres/horseback-riding-spots-kampala.webp';
            }
            if (str_contains($lower, 'rafting') || str_contains($lower, 'boat') || str_contains($lower, 'cruise') || str_contains($lower, 'tubing')) {
                return 'images/destinations/boat-cruise-elephants.webp';
            }
            if (str_contains($lower, 'chimp') || str_contains($lower, 'trek') || str_contains($lower, 'hike') || str_contains($lower, 'mountain')) {
                return 'images/destinations/chimpanzee-trekking.webp';
            }
            if (str_contains($lower, 'park') || str_contains($lower, 'resort') || str_contains($lower, 'adventure') || str_contains($lower, 'abseil') || str_contains($lower, 'ropes')) {
                return 'images/recreation centres/Forest-park-resort-Buloba-1.webp';
            }

            $recPool = [
                'images/recreation centres/Forest-park-resort-Buloba-1.webp',
                'images/recreation centres/Kavumba-Recreation-Center-Kids-Park-Wakiso-Uganda-TortoisePathcom-1.webp',
                'images/recreation centres/horseback-riding-spots-kampala.webp',
                'images/recreation centres/jinja-qaud-biking-1024x678-1.webp',
            ];
            return $recPool[abs(crc32($name)) % count($recPool)];
        }

        // Visit places: destination image or waterfall/scenery
        return $dest->image_path ?: 'images/destinations/boat-cruise-elephants.webp';
    }
}
