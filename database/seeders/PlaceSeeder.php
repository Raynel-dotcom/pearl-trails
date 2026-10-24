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
                            'image_path' => $this->resolveStayImage($dest->slug, $hotelName, $style),
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

    protected function resolveStayImage(string $slug, string $name, string $style): string
    {
        $destStayMap = [
            'jinja' => [
                'Budget'   => 'images/hotels/safari-tented-camp.webp',
                'Moderate' => 'images/hotels/hotel-cottages-pool.webp',
                'Luxury'   => 'images/hotels/chobe-safari-lodge-nile.webp',
            ],
            'sipi-falls' => [
                'Budget'   => 'images/hotels/safari-tented-camp.webp',
                'Moderate' => 'images/hotels/kyaninga-lodge-room.webp',
                'Luxury'   => 'images/hotels/hotel-room-canopy-bed.webp',
            ],
            'murchison-falls-np' => [
                'Budget'   => 'images/hotels/safari-tented-camp.webp',
                'Moderate' => 'images/hotels/ishasha-wilderness-camp.webp',
                'Luxury'   => 'images/hotels/chobe-safari-lodge-nile.webp',
            ],
            'queen-elizabeth-np' => [
                'Budget'   => 'images/hotels/safari-tented-camp.webp',
                'Moderate' => 'images/hotels/hotel-cottages-pool.webp',
                'Luxury'   => 'images/hotels/ishasha-wilderness-camp.webp',
            ],
            'bwindi' => [
                'Budget'   => 'images/hotels/safari-tented-camp.webp',
                'Moderate' => 'images/hotels/igongo-country-hotel.webp',
                'Luxury'   => 'images/hotels/bwindi-forest-lodge.webp',
            ],
            'lake-bunyonyi' => [
                'Budget'   => 'images/hotels/safari-tented-camp.webp',
                'Moderate' => 'images/hotels/kyaninga-lodge-aerial.webp',
                'Luxury'   => 'images/hotels/hotel-cottages-pool.webp',
            ],
            'fort-portal' => [
                'Budget'   => 'images/hotels/igongo-country-hotel.webp',
                'Moderate' => 'images/hotels/kyaninga-lodge-room.webp',
                'Luxury'   => 'images/hotels/kyaninga-lodge-aerial.webp',
            ],
            'rwenzori' => [
                'Budget'   => 'images/hotels/safari-tented-camp.webp',
                'Moderate' => 'images/hotels/bwindi-forest-lodge.webp',
                'Luxury'   => 'images/hotels/kyaninga-lodge-room.webp',
            ],
            'kidepo' => [
                'Budget'   => 'images/hotels/safari-tented-camp.webp',
                'Moderate' => 'images/hotels/ishasha-wilderness-camp.webp',
                'Luxury'   => 'images/hotels/apoka-safari-lodge-pool.webp',
            ],
            'entebbe' => [
                'Budget'   => 'images/hotels/igongo-country-hotel.webp',
                'Moderate' => 'images/hotels/hotel-cottages-pool.webp',
                'Luxury'   => 'images/hotels/hotel-room-canopy-bed.webp',
            ],
            'kampala' => [
                'Budget'   => 'images/hotels/igongo-country-hotel.webp',
                'Moderate' => 'images/hotels/kyaninga-lodge-room.webp',
                'Luxury'   => 'images/hotels/hotel-room-canopy-bed.webp',
            ],
            'ssese-islands' => [
                'Budget'   => 'images/hotels/safari-tented-camp.webp',
                'Moderate' => 'images/hotels/hotel-cottages-pool.webp',
                'Luxury'   => 'images/hotels/chobe-safari-lodge-nile.webp',
            ],
            'lake-mburo-np' => [
                'Budget'   => 'images/hotels/safari-tented-camp.webp',
                'Moderate' => 'images/hotels/hotel-cottages-pool.webp',
                'Luxury'   => 'images/hotels/apoka-safari-lodge-pool.webp',
            ],
        ];

        if (isset($destStayMap[$slug][$style])) {
            return $destStayMap[$slug][$style];
        }

        $lower = strtolower($name);

        if (str_contains($lower, 'apoka')) {
            return 'images/hotels/apoka-safari-lodge-pool.webp';
        }
        if (str_contains($lower, 'chobe')) {
            return 'images/hotels/chobe-safari-lodge-nile.webp';
        }
        if (str_contains($lower, 'bwindi')) {
            return 'images/hotels/bwindi-forest-lodge.webp';
        }
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
        if (str_contains($lower, 'camp') || str_contains($lower, 'banda') || str_contains($lower, 'tented') || str_contains($lower, 'hostel')) {
            return 'images/hotels/safari-tented-camp.webp';
        }

        if ($style === 'Luxury') {
            return (abs(crc32($name)) % 2 === 0)
                ? 'images/hotels/hotel-room-canopy-bed.webp'
                : 'images/hotels/chobe-safari-lodge-nile.webp';
        }

        if ($style === 'Moderate') {
            return (abs(crc32($name)) % 2 === 0)
                ? 'images/hotels/hotel-cottages-pool.webp'
                : 'images/hotels/kyaninga-lodge-room.webp';
        }

        return 'images/hotels/safari-tented-camp.webp';
    }

    protected function resolvePlaceImage(string $category, string $name, Destination $dest): string
    {
        $exactMap = [
            'eat' => [
                // Jinja
                'All Friends Food Bar & Grill' => 'images/restaurants/la-cabana-restaurant.webp',
                'The Source Cafe Jinja' => 'images/restaurants/fresh-coffee-cup.webp',
                'Java House Jinja' => 'images/restaurants/cafe-javas.webp',
                'Igar Cafe & Bakery' => 'images/restaurants/ugandan-rolex-street.webp',
                // Sipi Falls
                'Sipi Coffee View Cafe' => 'images/restaurants/fresh-coffee-cup.webp',
                'Lacam Verandah Diner' => 'images/restaurants/the-lawns-restaurant.webp',
                'Rafiki Terrace Dining' => 'images/restaurants/piato-restaurant.webp',
                // Murchison Falls
                'Red Chilli River Camp Restaurant' => 'images/restaurants/la-cabana-restaurant.webp',
                'Pakuba Safari Restaurant' => 'images/restaurants/the-lawns-restaurant.webp',
                'Paraa Safari Riverside Terrace' => 'images/restaurants/mediterraneo-restaurant-kampala.webp',
                // Queen Elizabeth
                'Tembo Canteen & Grill' => 'images/restaurants/local-cuisine-matooke.webp',
                'Kazinga Channel Lookout Bistro' => 'images/restaurants/piato-restaurant.webp',
                'Bush Lodge River View Diner' => 'images/restaurants/the-lawns-restaurant.webp',
                // Bwindi
                'Buhoma Community Rest Haven Meals' => 'images/restaurants/local-cuisine-matooke.webp',
                'Bakiga Lodge Organic Kitchen' => 'images/restaurants/ugandan-food-platter.webp',
                'Silverback Gorilla Bistro' => 'images/restaurants/mediterraneo-restaurant-kampala.webp',
                // Lake Bunyonyi
                'Bunyonyi Overland Lake Bar & Grill' => 'images/restaurants/la-cabana-restaurant.webp',
                'Arcadia Highlands Panoramic Restaurant' => 'images/restaurants/the-lawns-restaurant.webp',
                'BirdNest Belgo-Ugandan Kitchen' => 'images/restaurants/mediterraneo-restaurant-kampala.webp',
                // Fort Portal
                'Gardens Restaurant Fort Portal' => 'images/restaurants/ugandan-food-platter.webp',
                'The Dutchess European Diner' => 'images/restaurants/piato-restaurant.webp',
                'Mountains of the Moon Verandah' => 'images/restaurants/the-lawns-restaurant.webp',
                // Rwenzori
                'Trekkers Rest Canteen Kilembe' => 'images/restaurants/local-cuisine-matooke.webp',
                'Equator Snow Alpine Diner' => 'images/restaurants/the-lawns-restaurant.webp',
                'Kasese Spring International Cafe' => 'images/restaurants/fresh-coffee-cup.webp',
                // Kidepo
                'Apoka Rest Camp Canteen' => 'images/restaurants/ugandan-food-platter.webp',
                'Kidepo Savannah Lodge Open-Air Dining' => 'images/restaurants/la-cabana-restaurant.webp',
                'Apoka Safari Lodge Gourmet Table' => 'images/restaurants/mediterraneo-restaurant-kampala.webp',
                // Entebbe
                'Goretti\'s Pizzeria on the Beach' => 'images/restaurants/piato-restaurant.webp',
                'Cafe Javas Entebbe Mall' => 'images/restaurants/cafe-javas.webp',
                '2 Friends Waterfront Seafood Bar' => 'images/restaurants/la-cabana-restaurant.webp',
                // Kampala
                '2K Restaurant Nakasero (Local Cuisine)' => 'images/restaurants/local-cuisine-matooke.webp',
                'Cafe Javas Oasis Mall' => 'images/restaurants/cafe-javas.webp',
                'Fang Fang Chinese Restaurant' => 'images/restaurants/asian-fusion-restaurant.webp',
                'The Lawns Wild Game & Grill Kololo' => 'images/restaurants/the-lawns-restaurant.webp',
                // Ssese Islands
                'Kalangala Beach Camp Fish Fry' => 'images/restaurants/la-cabana-restaurant.webp',
                'Brovad Sands Lakeside Buffet' => 'images/restaurants/ugandan-food-platter.webp',
                'Victoria Forest Verandah Grill' => 'images/restaurants/mediterraneo-restaurant-kampala.webp',
                // Lake Mburo
                'Rwakobo Rock Sunset Diner' => 'images/restaurants/the-lawns-restaurant.webp',
                'Arcadia Cottages Lakeside Grill' => 'images/restaurants/la-cabana-restaurant.webp',
                'Mihingo Lodge Cliff Restaurant' => 'images/restaurants/mediterraneo-restaurant-kampala.webp',
            ],
            'recreation' => [
                // Jinja
                'Adrift River Adventures Rafting' => 'images/recreation centres/jinja-nile-rafting.webp',
                'Nile River Tubing Crew' => 'images/recreation centres/zipline-adventure.webp',
                'All Terrain Quad Adventures' => 'images/recreation centres/jinja-qaud-biking-1024x678-1.webp',
                'Nile Horseback Safaris' => 'images/recreation centres/horseback-riding-spots-kampala.webp',
                // Sipi Falls
                'Sipi Falls Abseiling Experience' => 'images/recreation centres/Forest-park-resort-Buloba-1.webp',
                'Chebonet River Rock Scramble' => 'images/recreation centres/rwenzori-nature-trail.webp',
                'Elgon Ridge Mountain Biking' => 'images/recreation centres/jinja-qaud-biking-1024x678-1.webp',
                // Murchison Falls
                'Nile Launch Boat to Base of Falls' => 'images/destinations/boat-cruise-elephants.webp',
                'Budongo Forest Chimpanzee Trek' => 'images/destinations/chimpanzee-trekking.webp',
                'Albert Nile Delta Wildlife Boat' => 'images/recreation centres/shoebill-wetland-canoe.webp',
                // Queen Elizabeth
                'UWA Kazinga Channel 2hr Boat Safari' => 'images/destinations/boat-cruise-elephants.webp',
                'Kyambura Gorge Chimp Tracking' => 'images/destinations/chimpanzee-trekking.webp',
                'Ishasha Tree-Climbing Lion Guided Drive' => 'images/recreation centres/tree-climbing-lions.webp',
                // Bwindi
                'Batwa Cultural Forest Experience' => 'images/recreation centres/ndere-cultural-dance.webp',
                'Munyaga Waterfall Rainforest Walk' => 'images/recreation centres/rwenzori-nature-trail.webp',
                'Bwindi Community Bike Tour' => 'images/recreation centres/jinja-qaud-biking-1024x678-1.webp',
                // Lake Bunyonyi
                'Supreme Adventure Park Zipline over Lake' => 'images/recreation centres/zipline-adventure.webp',
                'Bunyonyi Motorized Canoe Safari' => 'images/destinations/lake-bunyonyi.webp',
                'Traditional Dugout Canoe Rental & Lesson' => 'images/recreation centres/bunyonyi-canoes.webp',
                // Fort Portal
                'Ndali-Kasenda Guided Crater Bike Tour' => 'images/recreation centres/jinja-qaud-biking-1024x678-1.webp',
                'Mpanga Tea Estate Tour & Tasting' => 'images/destinations/fort-portal-crater-lakes.webp',
                'Top of the World Viewpoint Hike' => 'images/recreation centres/rwenzori-nature-trail.webp',
                // Rwenzori
                '1-Day Mahoma Nature Trail Hike' => 'images/recreation centres/rwenzori-nature-trail.webp',
                'Ruboni Community Village Cultural Walk' => 'images/recreation centres/ndere-cultural-dance.webp',
                'River Mubuku Whitewater Scramble' => 'images/recreation centres/jinja-nile-rafting.webp',
                // Kidepo
                'Lorukul Cultural Karamojong Manyattas Walk' => 'images/recreation centres/ndere-cultural-dance.webp',
                'Guided Bush Nature Walk in Narus' => 'images/recreation centres/savanna-game-drive.webp',
                'Night Spotlight Game Drive' => 'images/destinations/buffalo-herd-savanna.webp',
                // Entebbe
                'Ngamba Island Day Excursion & Speedboat' => 'images/destinations/entebbe-lake-victoria.webp',
                'Mabamba Swamp Shoebill Wooden Canoe' => 'images/recreation centres/shoebill-wetland-canoe.webp',
                'Sunset Yacht Cruise on Lake Victoria' => 'images/recreation centres/bunyonyi-canoes.webp',
                // Kampala
                'Ndere Cultural Centre Troupe Night Show' => 'images/recreation centres/ndere-cultural-dance.webp',
                'Kampala Rolex & Street Food Walking Safari' => 'images/restaurants/ugandan-rolex-street.webp',
                'Uganda National Theatre Performing Arts' => 'images/recreation centres/Kavumba-Recreation-Center-Kids-Park-Wakiso-Uganda-TortoisePathcom-1.webp',
                // Ssese Islands
                'Ssese Island Quad Bike Trail Safari' => 'images/recreation centres/jinja-qaud-biking-1024x678-1.webp',
                'Lake Victoria Nile Perch Sport Fishing' => 'images/destinations/ssese-islands.webp',
                'Bugala Island Forest Monkey Walk' => 'images/recreation centres/rwenzori-nature-trail.webp',
                // Lake Mburo
                'Guided Savannah Walking Safari on Foot' => 'images/recreation centres/savanna-game-drive.webp',
                'Mihingo Horseback Wildlife Safari (2hr)' => 'images/recreation centres/horseback-riding-spots-kampala.webp',
                'Lake Mburo 2hr Motorboat Cruise' => 'images/destinations/boat-cruise-elephants.webp',
            ],
            'visit' => [
                // Jinja
                'Source of the River Nile Monument' => 'images/destinations/source-of-the-nile.webp',
                'Busowoko Falls Eco Park' => 'images/destinations/sipi-falls.webp',
                'Itanda Rapids Viewpoint' => 'images/recreation centres/jinja-nile-rafting.webp',
                // Sipi Falls
                'Sipi Three-Falls Trail Access' => 'images/destinations/sipi-three-falls-trail.webp',
                'Bugisu Arabica Coffee Farm Walk' => 'images/restaurants/fresh-coffee-cup.webp',
                'Tewei Forest Sanctuary' => 'images/destinations/sipi-falls.webp',
                // Murchison Falls
                'Top of Murchison Falls Gorge Trail' => 'images/destinations/murchison-falls.webp',
                'Paraa Ferry Nile Crossing' => 'images/destinations/boat-cruise-elephants.webp',
                'Kaniyo Pabidi Mahogany Forest' => 'images/destinations/chimpanzee-trekking.webp',
                // Queen Elizabeth
                'Lake Katwe Traditional Salt Mines' => 'images/destinations/katwe-salt-mines.webp',
                'Bunyaruguru Twin Crater Lookout' => 'images/destinations/fort-portal-crater-lakes.webp',
                'Kikorongo Equator Monument' => 'images/destinations/uganda-equator-monument.webp',
                // Bwindi
                'Ride 4 a Woman Craft Center' => 'images/destinations/bwindi-gorilla-2.webp',
                'Buhoma Gorilla Hospital Visitor Wing' => 'images/destinations/bwindi-gorilla-1.webp',
                // Lake Bunyonyi
                'Akampene (Punishment Island) Historical Tour' => 'images/recreation centres/bunyonyi-canoes.webp',
                'Kyahugye Island Zebra & Impala Sanctuary' => 'images/destinations/lake-mburo-zebras.webp',
                'Arcadia 360-degree Hills Viewpoint' => 'images/destinations/lake-bunyonyi.webp',
                // Fort Portal
                'Amabere Ga Nyina Mwiru Caves & Waterfalls' => 'images/destinations/amabere-caves-waterfall.webp',
                'Karuzika Palace of Tooro Kingdom' => 'images/destinations/kasubi-royal-tombs.webp',
                'Kyaninga Crater Rim Trail' => 'images/destinations/fort-portal-crater-lakes.webp',
                // Rwenzori
                'Nyakalengija Trailhead Interpretive Center' => 'images/recreation centres/rwenzori-nature-trail.webp',
                'Ruboni Hilltop Viewpoint of Mount Stanley' => 'images/destinations/rwenzori-mountains.webp',
                // Kidepo
                'Kanangorok Hot Springs on South Sudan Border' => 'images/destinations/sempaya-hot-springs.webp',
                'Narus Valley Wildlife Waterhole Hide' => 'images/recreation centres/savanna-game-drive.webp',
                // Entebbe
                'Entebbe National Botanical Gardens' => 'images/destinations/entebbe-lake-victoria.webp',
                'UWEC (Uganda Wildlife Conservation Zoo)' => 'images/destinations/chimpanzee-trekking.webp',
                'Uganda Reptile Village' => 'images/recreation centres/tree-climbing-lions.webp',
                // Kampala
                'Kasubi Royal Tombs UNESCO World Heritage' => 'images/destinations/kasubi-royal-tombs.webp',
                'Uganda National Museum Kira Road' => 'images/destinations/uganda-equator-monument.webp',
                'Gaddafi National Mosque Minaret Tower' => 'images/destinations/gaddafi-national-mosque.webp',
                'Bahai Temple of Africa Gardens' => 'images/destinations/bahai-temple-gardens.webp',
                // Ssese Islands
                'Lutoboka Bay Pier & White Sands' => 'images/destinations/ssese-islands.webp',
                'Nanziri Sacred Falls & Cave Shrine' => 'images/destinations/amabere-caves-waterfall.webp',
                // Lake Mburo
                'Kazuma Hill Lookout Panoramic Deck' => 'images/destinations/lake-mburo-zebras.webp',
                'Ankole Cultural Cattle Sanctuary' => 'images/destinations/buffalo-herd-savanna.webp',
            ],
        ];

        if (isset($exactMap[$category][$name])) {
            return $exactMap[$category][$name];
        }

        $lower = strtolower($name);

        if ($category === 'eat') {
            if (str_contains($lower, 'rolex') || str_contains($lower, 'street')) {
                return 'images/restaurants/ugandan-rolex-street.webp';
            }
            if (str_contains($lower, 'coffee') || str_contains($lower, 'cafe') || str_contains($lower, 'bakery')) {
                return 'images/restaurants/fresh-coffee-cup.webp';
            }
            if (str_contains($lower, 'local') || str_contains($lower, 'matooke') || str_contains($lower, 'canteen')) {
                return 'images/restaurants/local-cuisine-matooke.webp';
            }
            if (str_contains($lower, 'buffet') || str_contains($lower, 'organic') || str_contains($lower, 'food') || str_contains($lower, 'platter')) {
                return 'images/restaurants/ugandan-food-platter.webp';
            }
            if (str_contains($lower, 'java')) {
                return 'images/restaurants/cafe-javas.webp';
            }
            if (str_contains($lower, 'cabana') || str_contains($lower, 'grill') || str_contains($lower, 'bar') || str_contains($lower, 'fish')) {
                return 'images/restaurants/la-cabana-restaurant.webp';
            }
            if (str_contains($lower, 'mediterraneo') || str_contains($lower, 'terrace') || str_contains($lower, 'fine') || str_contains($lower, 'serena')) {
                return 'images/restaurants/mediterraneo-restaurant-kampala.webp';
            }
            if (str_contains($lower, 'lawns') || str_contains($lower, 'game') || str_contains($lower, 'verandah')) {
                return 'images/restaurants/the-lawns-restaurant.webp';
            }
            if (str_contains($lower, 'piato') || str_contains($lower, 'bistro') || str_contains($lower, 'diner') || str_contains($lower, 'pizz')) {
                return 'images/restaurants/piato-restaurant.webp';
            }
            if (str_contains($lower, 'asian') || str_contains($lower, 'chinese') || str_contains($lower, 'fusion')) {
                return 'images/restaurants/asian-fusion-restaurant.webp';
            }

            $restaurantPool = [
                'images/restaurants/cafe-javas.webp',
                'images/restaurants/la-cabana-restaurant.webp',
                'images/restaurants/mediterraneo-restaurant-kampala.webp',
                'images/restaurants/the-lawns-restaurant.webp',
                'images/restaurants/piato-restaurant.webp',
                'images/restaurants/asian-fusion-restaurant.webp',
                'images/restaurants/ugandan-food-platter.webp',
                'images/restaurants/local-cuisine-matooke.webp',
                'images/restaurants/fresh-coffee-cup.webp',
                'images/restaurants/ugandan-rolex-street.webp',
            ];
            return $restaurantPool[abs(crc32($name)) % count($restaurantPool)];
        }

        if ($category === 'recreation') {
            if (str_contains($lower, 'rafting') || str_contains($lower, 'rapid')) {
                return 'images/recreation centres/jinja-nile-rafting.webp';
            }
            if (str_contains($lower, 'zipline') || str_contains($lower, 'ropes') || str_contains($lower, 'adventure') || str_contains($lower, 'tubing')) {
                return 'images/recreation centres/zipline-adventure.webp';
            }
            if (str_contains($lower, 'lion') || str_contains($lower, 'reptile')) {
                return 'images/recreation centres/tree-climbing-lions.webp';
            }
            if (str_contains($lower, 'dance') || str_contains($lower, 'troupe') || str_contains($lower, 'cultural') || str_contains($lower, 'theatre')) {
                return 'images/recreation centres/ndere-cultural-dance.webp';
            }
            if (str_contains($lower, 'shoebill') || str_contains($lower, 'delta') || str_contains($lower, 'swamp')) {
                return 'images/recreation centres/shoebill-wetland-canoe.webp';
            }
            if (str_contains($lower, 'canoe') || str_contains($lower, 'boat') || str_contains($lower, 'cruise') || str_contains($lower, 'yacht')) {
                return 'images/recreation centres/bunyonyi-canoes.webp';
            }
            if (str_contains($lower, 'quad') || str_contains($lower, 'bike') || str_contains($lower, 'biking') || str_contains($lower, 'off-road')) {
                return 'images/recreation centres/jinja-qaud-biking-1024x678-1.webp';
            }
            if (str_contains($lower, 'horse') || str_contains($lower, 'equine')) {
                return 'images/recreation centres/horseback-riding-spots-kampala.webp';
            }
            if (str_contains($lower, 'chimp') || str_contains($lower, 'primate')) {
                return 'images/destinations/chimpanzee-trekking.webp';
            }
            if (str_contains($lower, 'trail') || str_contains($lower, 'hike') || str_contains($lower, 'scramble') || str_contains($lower, 'walk')) {
                return 'images/recreation centres/rwenzori-nature-trail.webp';
            }
            if (str_contains($lower, 'safari') || str_contains($lower, 'game drive')) {
                return 'images/recreation centres/savanna-game-drive.webp';
            }

            $recPool = [
                'images/recreation centres/jinja-nile-rafting.webp',
                'images/recreation centres/zipline-adventure.webp',
                'images/recreation centres/tree-climbing-lions.webp',
                'images/recreation centres/ndere-cultural-dance.webp',
                'images/recreation centres/bunyonyi-canoes.webp',
                'images/recreation centres/shoebill-wetland-canoe.webp',
                'images/recreation centres/rwenzori-nature-trail.webp',
                'images/recreation centres/savanna-game-drive.webp',
                'images/recreation centres/horseback-riding-spots-kampala.webp',
                'images/recreation centres/jinja-qaud-biking-1024x678-1.webp',
            ];
            return $recPool[abs(crc32($name)) % count($recPool)];
        }

        // Category 'visit'
        if (str_contains($lower, 'nile') && str_contains($lower, 'source')) {
            return 'images/destinations/source-of-the-nile.webp';
        }
        if (str_contains($lower, 'equator')) {
            return 'images/destinations/uganda-equator-monument.webp';
        }
        if (str_contains($lower, 'kasubi') || str_contains($lower, 'palace')) {
            return 'images/destinations/kasubi-royal-tombs.webp';
        }
        if (str_contains($lower, 'mosque') || str_contains($lower, 'gaddafi')) {
            return 'images/destinations/gaddafi-national-mosque.webp';
        }
        if (str_contains($lower, 'bahai') || str_contains($lower, 'temple')) {
            return 'images/destinations/bahai-temple-gardens.webp';
        }
        if (str_contains($lower, 'salt') || str_contains($lower, 'katwe')) {
            return 'images/destinations/katwe-salt-mines.webp';
        }
        if (str_contains($lower, 'amabere') || str_contains($lower, 'cave')) {
            return 'images/destinations/amabere-caves-waterfall.webp';
        }
        if (str_contains($lower, 'crater')) {
            return 'images/destinations/fort-portal-crater-lakes.webp';
        }
        if (str_contains($lower, 'hot spring')) {
            return 'images/destinations/sempaya-hot-springs.webp';
        }
        if (str_contains($lower, 'three-falls') || str_contains($lower, 'cascade')) {
            return 'images/destinations/sipi-three-falls-trail.webp';
        }

        return $dest->image_path ?: 'images/destinations/boat-cruise-elephants.webp';
    }
}
