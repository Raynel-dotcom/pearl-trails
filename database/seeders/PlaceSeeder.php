<?php

namespace Database\Seeders;

use App\Models\Destination;
use App\Models\Place;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PlaceSeeder extends Seeder
{
    public function run(): void
    {
        $destinations = Destination::all();


        $hotelMeta = [
            'Nile River Camp & Backpackers' => [
                'price_ugx' => 55000,
                'website' => 'https://camponthenile.com',
                'desc' => 'Riverside backpackers camp on the Nile with dorms, safari tents, swimming pool, and sunset bar.',
            ],
            'Haven Eco River Lodge' => [
                'price_ugx' => 550000,
                'website' => 'https://thehaven-uganda.com',
                'desc' => 'Tranquil eco-lodge on the Nile banks with private bungalows, river view swimming pool, and bird sanctuary trails.',
            ],
            'Lemala Wildwaters Lodge' => [
                'price_ugx' => 1450000,
                'website' => 'https://lemalacamps.com',
                'desc' => 'Ultra-luxury lodge secluded on its own private rainforest island amidst roaring rapids of the River Nile.',
            ],
            'Crow\'s Nest Rest Camp' => [
                'price_ugx' => 65000,
                'website' => null,
                'desc' => 'Rustic mountain camp on the slopes of Mount Elgon with direct front-row views of Sipi Falls cascade.',
            ],
            'Rafiki Lodge Sipi' => [
                'price_ugx' => 370000,
                'website' => 'https://rafikilodgesipi.com',
                'desc' => 'Cliffside lodge overlooking the Sipi valley with stone cottages, swimming pool, and guided coffee walks.',
            ],
            'Sipi River Lodge' => [
                'price_ugx' => 550000,
                'website' => 'https://sipiheritagelodge.com',
                'desc' => 'Heritage lodge set amidst lush coffee farms and waterfalls with cozy fireplaces and gourmet dining.',
            ],
            'Red Chilli Rest Camp' => [
                'price_ugx' => 150000,
                'website' => 'https://redchillihideaway.com',
                'desc' => 'Iconic safari camp inside the park at Paraa offering safari tents, en-suite bandas, and open-air bar.',
            ],
            'Pakuba Safari Lodge' => [
                'price_ugx' => 750000,
                'website' => 'https://pakubasafarilodge.com',
                'desc' => 'Elevated safari lodge on the Eastern bank of the Albert Nile with panoramic views and swimming pool.',
            ],
            'Chobe Safari Lodge' => [
                'price_ugx' => 1500000,
                'website' => 'https://chobelodgeuganda.com',
                'desc' => 'Five-star Marasa Africa luxury resort with multi-tiered infinity pools overlooking the Victoria Nile.',
            ],
            'Engiri Game Lodge & Campsite' => [
                'price_ugx' => 185000,
                'website' => 'https://engirigamelodge.com',
                'desc' => 'Eco-campsite and safari lodge nestled near Kazinga Channel with permanent tents, bandas, and campfire nights.',
            ],
            'Marafiki Safari Lodge' => [
                'price_ugx' => 850000,
                'website' => 'https://marafikisafaris.com',
                'desc' => 'Eco-luxury safari tents and thatched cottages perched on a volcanic ridge overlooking Lake George.',
            ],
            'Mweya Safari Lodge' => [
                'price_ugx' => 1450000,
                'website' => 'https://mweyalodge.com',
                'desc' => 'Legendary peninsula lodge surrounded by the Kazinga Channel with infinity pool and sunset safari deck.',
            ],
            'Bwindi Backpackers Lodge' => [
                'price_ugx' => 75000,
                'website' => null,
                'desc' => 'Community-oriented backpackers lodge at the edge of the gorilla forest with dorms and private cottages.',
            ],
            'Bakiga Lodge Ruhija' => [
                'price_ugx' => 650000,
                'website' => 'https://bakigalodge.org',
                'desc' => 'Non-profit eco-lodge in the misty Ruhija gorilla sector with valley-facing private balconies.',
            ],
            'Bwindi Lodge by Volcanoes Safaris' => [
                'price_ugx' => 3200000,
                'website' => 'https://volcanoessafaris.com',
                'desc' => 'Ultra-luxury forest lodge featuring handcrafted stone bandas, personalized butler service, and forest spa.',
            ],
            'Bunyonyi Overland Resort' => [
                'price_ugx' => 150000,
                'website' => null,
                'desc' => 'Lakeside retreat with tiered gardens, furnished safari tents, swimming pier, and motorized canoe tours.',
            ],
            'Arcadia Cottages Bunyonyi' => [
                'price_ugx' => 550000,
                'website' => 'https://arcadialodges.com',
                'desc' => 'Panoramic highland lodge set atop a ridge with 360-degree views across all 29 islands of Lake Bunyonyi.',
            ],
            'BirdNest Resort @ Lake Bunyonyi' => [
                'price_ugx' => 480000,
                'website' => 'https://birdnestresort.com',
                'desc' => 'Belgian-Ugandan luxury resort on the water edge with ecological pool and renowned fine dining.',
            ],
            'Rwenzori View Guesthouse' => [
                'price_ugx' => 175000,
                'website' => null,
                'desc' => 'Quiet family-run guesthouse renowned for communal evening dinners and lush tropical gardens.',
            ],
            'Mountains of the Moon Hotel' => [
                'price_ugx' => 420000,
                'website' => 'https://motmh.com',
                'desc' => 'Colonial-style hotel surrounded by 15 acres of landscaped gardens with an Olympic pool and wellness spa.',
            ],
            'Kyaninga Lodge' => [
                'price_ugx' => 1600000,
                'website' => 'https://kyaningalodge.com',
                'desc' => 'Architectural log lodge raised above Lake Kyaninga crater with backdrop views of the Rwenzori peaks.',
            ],
            'Rwenzori Trekkers Hostel & Cottages' => [
                'price_ugx' => 80000,
                'website' => 'https://rwenzoritrekking.com',
                'desc' => 'The beloved mountain base of Rwenzori Trekking Services along the river in Kyanjuki with dorms and private rooms.',
            ],
            'Rwenzori Basecamp Guesthouse' => [
                'price_ugx' => 220000,
                'website' => null,
                'desc' => 'Alpine guesthouse at the foothills of Mount Stanley supporting Central Circuit hikers and cultural walks.',
            ],
            'Equator Snow Lodge' => [
                'price_ugx' => 1100000,
                'website' => 'https://geolodgesafrica.com',
                'desc' => 'Luxury mountain lodge built from river pebbles of the Mubuku River with roaring open fireplaces.',
            ],
            'UWA Bandas & Student Hostel' => [
                'price_ugx' => 80000,
                'website' => null,
                'desc' => 'Official UWA rest camp in Narus Valley where zebras and warthogs graze between self-contained bandas.',
            ],
            'Kidepo Savannah Lodge' => [
                'price_ugx' => 300000,
                'website' => 'https://naturelodgesuganda.com',
                'desc' => 'Nature Lodges camp perched on a rocky kopje overlooking the Narus Valley grasslands with open-air dining.',
            ],
            'Apoka Safari Lodge' => [
                'price_ugx' => 3500000,
                'website' => 'https://wildplacesafrica.com',
                'desc' => 'Top-tier luxury safari lodge carved into granite kopje with private natural stone outdoor plunge tubs.',
            ],
            'Entebbe Backpackers Hostel' => [
                'price_ugx' => 60000,
                'website' => null,
                'desc' => 'Friendly backpackers hostel with camping grounds, leafy shade trees, and quick access to Entebbe Airport.',
            ],
            '2 Friends Beach Hotel' => [
                'price_ugx' => 500000,
                'website' => 'https://2friendshotel.com',
                'desc' => 'Boutique hotel situated right along the shores of Lake Victoria with outdoor pool and beach club dining.',
            ],
            'Protea Hotel Entebbe Resort' => [
                'price_ugx' => 850000,
                'website' => 'https://marriott.com',
                'desc' => 'Four-star Marriott resort located 1km from the international airport with sweeping lakeside terrace and spa.',
            ],
            'Bushpig Backpackers Hostel Kololo' => [
                'price_ugx' => 75000,
                'website' => 'https://bushpigkampala.com',
                'desc' => 'Top-rated urban hostel in upscale Kololo featuring artisan sourdough pizza, craft beer, and travel hub.',
            ],
            'Fairway Hotel & Spa' => [
                'price_ugx' => 450000,
                'website' => 'https://fairwayhotel.co.ug',
                'desc' => 'Historic boutique hotel with lush tropical courtyards in Nakasero, Asian Fusion restaurant, spa, and pool.',
            ],
            'Kampala Serena Hotel' => [
                'price_ugx' => 1150000,
                'website' => 'https://serenahotels.com',
                'desc' => 'Five-star luxury oasis featuring 17 acres of water gardens, cascading waterfalls, and world-class dining.',
            ],
            'Hornbill Campsite & Cottages' => [
                'price_ugx' => 70000,
                'website' => null,
                'desc' => 'Peaceful white-sand beach campsite tucked inside a bay of Bugala Island, surrounded by tropical forest.',
            ],
            'Brovad Sands Lodge' => [
                'price_ugx' => 450000,
                'website' => 'https://brovadsandslodge.com',
                'desc' => 'Tropical beach resort with private white sands on Bugala Island, beach hammocks, and swimming pool.',
            ],
            'Victoria Forest Resort Kalangala' => [
                'price_ugx' => 650000,
                'website' => 'https://victoriaforestresort.com',
                'desc' => 'Premier island resort set against natural rain forest with private beach frontage and forest trails.',
            ],
            'Rwakobo Rock Eco Camp' => [
                'price_ugx' => 550000,
                'website' => 'https://rwakoborock.com',
                'desc' => 'Spectacular eco-camp perched on a massive granite outcrop overlooking Lake Mburo with solar showers and pool.',
            ],
            'Arcadia Cottages Mburo' => [
                'price_ugx' => 450000,
                'website' => 'https://arcadialodges.com',
                'desc' => 'Intimate lodge located inside the park with peaceful views across Lake Mburo and resident warthogs on lawn.',
            ],
            'Mihingo Safari Lodge' => [
                'price_ugx' => 1650000,
                'website' => 'https://mihingolodge.com',
                'desc' => 'Magical luxury wilderness retreat built into rock kopjes featuring an iconic infinity pool and horseback safaris.',
            ],
        ];


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
                    $meta = $hotelMeta[$hotelName] ?? [];
                    Place::updateOrCreate(
                        [
                            'destination_id' => $dest->id,
                            'category' => 'stay',
                            'name' => $hotelName,
                        ],
                        [
                            'price_ugx' => $meta['price_ugx'] ?? (int) $costs[$style],
                            'unit' => 'night',
                            'type' => $typeName,
                            'description' => $meta['desc'] ?? "Quality {$style} accommodation near {$dest->name}.",
                            'website' => $meta['website'] ?? null,
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
                    ['name' => 'All Friends Food Bar & Grill', 'price_ugx' => 28000, 'unit' => 'meal', 'type' => 'Restaurant', 'website' => null, 'description' => 'Popular open-air bar and grill on Jackson Crescent serving tender steaks, local tilapia, and chilled beverages.'],
                    ['name' => 'The Source Cafe Jinja', 'price_ugx' => 22000, 'unit' => 'meal', 'type' => 'Cafe', 'website' => null, 'description' => 'Historic Jinja cafe serving fresh Uganda espresso, fresh sandwiches, smoothies, and baked goods.'],
                    ['name' => 'Java House Jinja', 'price_ugx' => 35000, 'unit' => 'meal', 'type' => 'Casual Dining', 'website' => 'https://javahouseafrica.com', 'description' => 'Modern East African casual dining chain serving burgers, breakfast platters, and gourmet coffees.'],
                    ['name' => 'Igar Cafe & Bakery', 'price_ugx' => 18000, 'unit' => 'meal', 'type' => 'Bakery & Snacks', 'website' => null, 'description' => 'Central bakery and snack cafe serving authentic Ugandan rolex, pastries, samosas, and iced drinks.'],
                ],
                'recreation' => [
                    ['name' => 'Adrift River Adventures Rafting', 'price_ugx' => 520000, 'unit' => 'entry', 'type' => 'Activity Centre', 'website' => 'https://adrift.ug', 'description' => 'Uganda premier white-water rafting outfitter tackling the world-famous grade 5 rapids of the River Nile.'],
                    ['name' => 'Nile River Tubing Crew', 'price_ugx' => 75000, 'unit' => 'entry', 'type' => 'River Recreation', 'website' => 'https://tubingthenile.com', 'description' => 'Relaxing and adventure river tubing expeditions drifting along scenic sections of the Upper Nile.'],
                    ['name' => 'All Terrain Quad Adventures', 'price_ugx' => 185000, 'unit' => 'entry', 'type' => 'Off-road Park', 'website' => 'https://atvadventuresuganda.com', 'description' => 'Guided all-terrain quad biking along rural dirt trails, farmland, and riverbanks of the Nile.'],
                    ['name' => 'Nile Horseback Safaris', 'price_ugx' => 150000, 'unit' => 'entry', 'type' => 'Equine Trails', 'website' => 'https://nilehorsebacksafaris.com', 'description' => 'Scenic horseback safaris along riverbanks and local village trails suitable for beginner and experienced riders.'],
                ],
                'visit' => [
                    ['name' => 'Source of the River Nile Monument', 'price_ugx' => 10000, 'unit' => 'entry', 'type' => 'Historical Monument', 'website' => null, 'description' => 'The historic geographical spot where the Nile emerges from Lake Victoria on its journey to the Mediterranean.'],
                    ['name' => 'Busowoko Falls Eco Park', 'price_ugx' => 15000, 'unit' => 'entry', 'type' => 'Natural Waterfall', 'website' => null, 'description' => 'Dramatic foaming cascades along the Nile with boardwalks, scenic picnic grounds, and swimming pools.'],
                    ['name' => 'Itanda Rapids Viewpoint', 'price_ugx' => 10000, 'unit' => 'entry', 'type' => 'Scenic River Rapids', 'website' => null, 'description' => 'Spectacular thunderous river rapids famous for extreme kayaking and powerful white-water hydraulics.'],
                ],
            ],
            'sipi-falls' => [
                'eat' => [
                    ['name' => 'Sipi Coffee View Cafe', 'price_ugx' => 18000, 'unit' => 'meal', 'type' => 'Cafe', 'website' => null, 'description' => 'Perched cafe offering steaming freshly brewed Mount Elgon Arabica coffee and scenic valley terrace views.'],
                    ['name' => 'Lacam Verandah Diner', 'price_ugx' => 32000, 'unit' => 'meal', 'type' => 'Restaurant', 'website' => null, 'description' => 'Cliffside verandah restaurant serving hearty homemade soups, grilled meats, and local Ugandan dishes.'],
                    ['name' => 'Rafiki Terrace Dining', 'price_ugx' => 40000, 'unit' => 'meal', 'type' => 'Bistro', 'website' => null, 'description' => 'Open-air bistro with panoramic sunset views over Sipi valley, serving fresh wood-fired meals and cocktails.'],
                ],
                'recreation' => [
                    ['name' => 'Sipi Falls Abseiling Experience', 'price_ugx' => 180000, 'unit' => 'entry', 'type' => 'Extreme Sports', 'website' => null, 'description' => 'Exhilarating 100-meter abseil descent alongside the thunderous main waterfall of Sipi Falls.'],
                    ['name' => 'Chebonet River Rock Scramble', 'price_ugx' => 45000, 'unit' => 'entry', 'type' => 'Guided Trek', 'website' => null, 'description' => 'Guided boulder hike along Chebonet mountain stream with natural stone pools and hidden river caves.'],
                    ['name' => 'Elgon Ridge Mountain Biking', 'price_ugx' => 80000, 'unit' => 'entry', 'type' => 'Bike Trail', 'website' => null, 'description' => 'Thrilling downhill mountain biking through coffee farms, cliff ridges, and high Mount Elgon trails.'],
                ],
                'visit' => [
                    ['name' => 'Sipi Three-Falls Trail Access', 'price_ugx' => 35000, 'unit' => 'entry', 'type' => 'Waterfall Trail', 'website' => null, 'description' => 'Guided trek exploring all three magnificent waterfalls of Sipi cascading 100m, 85m, and 75m down the mountain.'],
                    ['name' => 'Bugisu Arabica Coffee Farm Walk', 'price_ugx' => 30000, 'unit' => 'entry', 'type' => 'Agro-Tourism', 'website' => null, 'description' => 'Immersive hands-on coffee tour from picking beans to roasting, grinding, and brewing fresh Arabica.'],
                    ['name' => 'Tewei Forest Sanctuary', 'price_ugx' => 15000, 'unit' => 'entry', 'type' => 'Forest Reserve', 'website' => null, 'description' => 'Peaceful evergreen forest pocket home to chameleons, black-and-white colobus monkeys, and exotic birds.'],
                ],
            ],
            'murchison-falls-np' => [
                'eat' => [
                    ['name' => 'Red Chilli River Camp Restaurant', 'price_ugx' => 35000, 'unit' => 'meal', 'type' => 'Safari Camp Diner', 'website' => null, 'description' => 'Casual safari diner serving pizzas, full English breakfasts, and cold Nile Special beers under open skies.'],
                    ['name' => 'Pakuba Safari Restaurant', 'price_ugx' => 60000, 'unit' => 'meal', 'type' => 'Lodge Dining', 'website' => null, 'description' => 'Full-board lodge restaurant with panoramic views of Albert Nile, serving international and local buffet courses.'],
                    ['name' => 'Paraa Safari Riverside Terrace', 'price_ugx' => 75000, 'unit' => 'meal', 'type' => 'Fine Dining', 'website' => null, 'description' => 'Elevated terrace restaurant overlooking the flowing Nile with colonial charm and international wine selection.'],
                ],
                'recreation' => [
                    ['name' => 'Nile Launch Boat to Base of Falls', 'price_ugx' => 110000, 'unit' => 'entry', 'type' => 'River Cruise', 'website' => null, 'description' => 'Official UWA boat safari sailing past pods of hippos and giant crocodiles to the bottom of the roaring falls.'],
                    ['name' => 'Budongo Forest Chimpanzee Trek', 'price_ugx' => 350000, 'unit' => 'entry', 'type' => 'Primate Sanctuary', 'website' => null, 'description' => 'Guided tracking through mahogany rainforest to encounter habituated wild chimpanzee communities.'],
                    ['name' => 'Albert Nile Delta Wildlife Boat', 'price_ugx' => 180000, 'unit' => 'entry', 'type' => 'Birding Safari', 'website' => null, 'description' => 'Specialized river cruise heading into the Lake Albert delta in search of rare shoebill storks and elephant herds.'],
                ],
                'visit' => [
                    ['name' => 'Top of Murchison Falls Gorge Trail', 'price_ugx' => 35000, 'unit' => 'entry', 'type' => 'National Park Site', 'website' => null, 'description' => 'Dramatic viewpoint where the full volume of the Victoria Nile surges violently through a 7-meter rock crevice.'],
                    ['name' => 'Paraa Ferry Nile Crossing', 'price_ugx' => 25000, 'unit' => 'entry', 'type' => 'Scenic Crossing', 'website' => null, 'description' => 'Scenic vehicle and passenger ferry connecting northern game tracks with southern forest sectors across the Nile.'],
                    ['name' => 'Kaniyo Pabidi Mahogany Forest', 'price_ugx' => 45000, 'unit' => 'entry', 'type' => 'Nature Reserve', 'website' => null, 'description' => 'Ancient ironwood forest trail with towering mahogany trees, baboon troops, and diverse forest bird species.'],
                ],
            ],
            'queen-elizabeth-np' => [
                'eat' => [
                    ['name' => 'Tembo Canteen & Grill', 'price_ugx' => 28000, 'unit' => 'meal', 'type' => 'Local Grill', 'website' => null, 'description' => 'Ranger canteen serving freshly cooked matooke, beef stew, tilapia, and chapati near park headquarters.'],
                    ['name' => 'Kazinga Channel Lookout Bistro', 'price_ugx' => 50000, 'unit' => 'meal', 'type' => 'Lodge Dining', 'website' => null, 'description' => 'Lodge bistro overlooking the waterway with wildlife views and continental dining.'],
                    ['name' => 'Bush Lodge River View Diner', 'price_ugx' => 55000, 'unit' => 'meal', 'type' => 'Eco-Diner', 'website' => null, 'description' => 'Romantic open-air dining terrace illuminated by hurricane lanterns, serving multi-course evening meals.'],
                ],
                'recreation' => [
                    ['name' => 'UWA Kazinga Channel 2hr Boat Safari', 'price_ugx' => 110000, 'unit' => 'entry', 'type' => 'Channel Cruise', 'website' => null, 'description' => 'The world-famous boat safari delivering close-up sightings of hippos, bathing buffalos, and water birds.'],
                    ['name' => 'Kyambura Gorge Chimp Tracking', 'price_ugx' => 370000, 'unit' => 'entry', 'type' => 'Primate Trek', 'website' => null, 'description' => 'Descend into the sunken Valley of Apes rainforest to track isolated communities of chimpanzees.'],
                    ['name' => 'Ishasha Tree-Climbing Lion Guided Drive', 'price_ugx' => 110000, 'unit' => 'entry', 'type' => 'Ranger Guided Safari', 'website' => null, 'description' => 'Ranger-guided safari through Ishasha savannah to spot legendary lions lounging in large fig trees.'],
                ],
                'visit' => [
                    ['name' => 'Lake Katwe Traditional Salt Mines', 'price_ugx' => 25000, 'unit' => 'entry', 'type' => 'Heritage Site', 'website' => null, 'description' => 'Centuries-old volcanic salt lake where local miners harvest pure rock salt using traditional methods.'],
                    ['name' => 'Bunyaruguru Twin Crater Lookout', 'price_ugx' => 15000, 'unit' => 'entry', 'type' => 'Crater Viewpoint', 'website' => null, 'description' => 'Scenic volcanic rim offering breathtaking panoramic views of twin crater lakes and the Rift Valley floor.'],
                    ['name' => 'Kikorongo Equator Monument', 'price_ugx' => 10000, 'unit' => 'entry', 'type' => 'Geographical Landmark', 'website' => null, 'description' => 'Iconic geographic landmark marking 0 degrees latitude with unobstructed views of the Rwenzori foothills.'],
                ],
            ],
            'bwindi' => [
                'eat' => [
                    ['name' => 'Buhoma Community Rest Haven Meals', 'price_ugx' => 35000, 'unit' => 'meal', 'type' => 'Community Restaurant', 'website' => null, 'description' => 'Locally run community restaurant serving organic garden salads, chicken stews, and hot post-trek lunches.'],
                    ['name' => 'Bakiga Lodge Organic Kitchen', 'price_ugx' => 50000, 'unit' => 'meal', 'type' => 'Lodge Dining', 'website' => null, 'description' => 'Farm-to-table organic kitchen serving wholesome hearty meals with panoramic views of Ruhija forest.'],
                    ['name' => 'Silverback Gorilla Bistro', 'price_ugx' => 65000, 'unit' => 'meal', 'type' => 'Fine Dining', 'website' => null, 'description' => 'Highland lodge restaurant offering warm fireplaces, 3-course dinners, and fine wine after mountain gorilla treks.'],
                ],
                'recreation' => [
                    ['name' => 'Batwa Cultural Forest Experience', 'price_ugx' => 150000, 'unit' => 'entry', 'type' => 'Cultural Trail', 'website' => null, 'description' => 'Authentic trail led by indigenous Batwa elders showcasing ancient forest survival, traditional medicine, and music.'],
                    ['name' => 'Munyaga Waterfall Rainforest Walk', 'price_ugx' => 80000, 'unit' => 'entry', 'type' => 'Forest Nature Trail', 'website' => null, 'description' => 'Ranger-guided rainforest trek past ancient ferns and orchid trees to three cascading mountain waterfalls.'],
                    ['name' => 'Bwindi Community Bike Tour', 'price_ugx' => 70000, 'unit' => 'entry', 'type' => 'Cycling Tour', 'website' => null, 'description' => 'Guided cycling tour through tea plantations, local schools, and artisan villages along the park border.'],
                ],
                'visit' => [
                    ['name' => 'Ride 4 a Woman Craft Center', 'price_ugx' => 15000, 'unit' => 'entry', 'type' => 'Artisan Cooperative', 'website' => 'https://ride4awoman.org', 'description' => 'Inspiring women cooperative teaching traditional basket weaving, textile sewing, and cultural storytelling.'],
                    ['name' => 'Buhoma Gorilla Hospital Visitor Wing', 'price_ugx' => 20000, 'unit' => 'entry', 'type' => 'Conservation Education', 'website' => 'https://gorilladoctors.org', 'description' => 'Conservation veterinary center dedicated to saving wild mountain gorillas through veterinary medicine and education.'],
                ],
            ],
            'lake-bunyonyi' => [
                'eat' => [
                    ['name' => 'Bunyonyi Overland Lake Bar & Grill', 'price_ugx' => 28000, 'unit' => 'meal', 'type' => 'Lakeside Grill', 'website' => null, 'description' => 'Lakeside terrace grill serving Lake Bunyonyi crayfish curries, grilled tilapia, and fresh pizzas.'],
                    ['name' => 'Arcadia Highlands Panoramic Restaurant', 'price_ugx' => 45000, 'unit' => 'meal', 'type' => 'Scenic Dining', 'website' => null, 'description' => 'Highland panoramic restaurant serving buffet meals while overlooking all 29 islands of Lake Bunyonyi.'],
                    ['name' => 'BirdNest Belgo-Ugandan Kitchen', 'price_ugx' => 55000, 'unit' => 'meal', 'type' => 'Fine Dining', 'website' => null, 'description' => 'Critically acclaimed culinary kitchen blending authentic Belgian culinary recipes with fresh Ugandan ingredients.'],
                ],
                'recreation' => [
                    ['name' => 'Supreme Adventure Park Zipline over Lake', 'price_ugx' => 80000, 'unit' => 'entry', 'type' => 'Adventure Park', 'website' => null, 'description' => 'High-adrenaline zipline flying directly over the tranquil waters of Lake Bunyonyi and high ropes courses.'],
                    ['name' => 'Bunyonyi Motorized Canoe Safari', 'price_ugx' => 60000, 'unit' => 'entry', 'type' => 'Boat Cruise', 'website' => null, 'description' => 'Guided island-hopping motorboat cruise visiting historical Punishment Island, Bushara, and Kyahugye.'],
                    ['name' => 'Traditional Dugout Canoe Rental & Lesson', 'price_ugx' => 30000, 'unit' => 'entry', 'type' => 'Water Sports', 'website' => null, 'description' => 'Learn the ancient art of paddling a traditional handcrafted wooden dugout canoe across calm waters.'],
                ],
                'visit' => [
                    ['name' => 'Akampene (Punishment Island) Historical Tour', 'price_ugx' => 35000, 'unit' => 'entry', 'type' => 'Historic Island', 'website' => null, 'description' => 'Somber and historic island where pregnant unmarried Bakiga girls were once abandoned, now an educational site.'],
                    ['name' => 'Kyahugye Island Zebra & Impala Sanctuary', 'price_ugx' => 50000, 'unit' => 'entry', 'type' => 'Island Wildlife Reserve', 'website' => null, 'description' => 'Privately protected island sanctuary where zebras, impalas, and waterbucks roam amidst highland lake scenery.'],
                    ['name' => 'Arcadia 360-degree Hills Viewpoint', 'price_ugx' => 15000, 'unit' => 'entry', 'type' => 'Scenic Viewpoint', 'website' => null, 'description' => 'The most photographed panoramic viewpoint in southwestern Uganda, looking across 29 serene islands.'],
                ],
            ],
            'fort-portal' => [
                'eat' => [
                    ['name' => 'Gardens Restaurant Fort Portal', 'price_ugx' => 25000, 'unit' => 'meal', 'type' => 'Local & Continental', 'website' => null, 'description' => 'Popular Fort Portal dining garden serving tasty local matooke, smoked beef, and continental specials.'],
                    ['name' => 'The Dutchess European Diner', 'price_ugx' => 38000, 'unit' => 'meal', 'type' => 'Bistro & Pizzeria', 'website' => null, 'description' => 'Renowned boutique restaurant famous for stone-baked pizzas, goat milk cheeses, and gourmet burgers.'],
                    ['name' => 'Mountains of the Moon Verandah', 'price_ugx' => 50000, 'unit' => 'meal', 'type' => 'Hotel Dining', 'website' => null, 'description' => 'Grand colonial hotel verandah restaurant overlooking manicured lawns, serving multi-course meals.'],
                ],
                'recreation' => [
                    ['name' => 'Ndali-Kasenda Guided Crater Bike Tour', 'price_ugx' => 75000, 'unit' => 'entry', 'type' => 'Cycling Excursion', 'website' => null, 'description' => 'Guided mountain biking across volcanic ridges connecting over a dozen emerald-green crater lakes.'],
                    ['name' => 'Mpanga Tea Estate Tour & Tasting', 'price_ugx' => 35000, 'unit' => 'entry', 'type' => 'Agro-Tourism', 'website' => null, 'description' => 'Walk through rolling emerald tea fields, learn plucking techniques, and taste fresh processed tea.'],
                    ['name' => 'Top of the World Viewpoint Hike', 'price_ugx' => 25000, 'unit' => 'entry', 'type' => 'Scenic Trek', 'website' => null, 'description' => 'Rewarding hilltop trek offering panoramic views of three volcanic craters and Mount Stanley peaks.'],
                ],
                'visit' => [
                    ['name' => 'Amabere Ga Nyina Mwiru Caves & Waterfalls', 'price_ugx' => 25000, 'unit' => 'entry', 'type' => 'Stalactite Caves', 'website' => null, 'description' => 'Limestone stalactites and plunging waterfalls steeped in rich Tooro Kingdom folklore and royal legends.'],
                    ['name' => 'Karuzika Palace of Tooro Kingdom', 'price_ugx' => 20000, 'unit' => 'entry', 'type' => 'Royal Heritage', 'website' => null, 'description' => 'The circular hilltop royal palace of King Oyo, commanding 360-degree vistas across Fort Portal city.'],
                    ['name' => 'Kyaninga Crater Rim Trail', 'price_ugx' => 20000, 'unit' => 'entry', 'type' => 'Crater Lake', 'website' => null, 'description' => 'Scenic nature trail circumscribing the rim of Lake Kyaninga, an ancient and pristine explosion crater.'],
                ],
            ],
            'rwenzori' => [
                'eat' => [
                    ['name' => 'Trekkers Rest Canteen Kilembe', 'price_ugx' => 28000, 'unit' => 'meal', 'type' => 'Mountain Canteen', 'website' => null, 'description' => 'Cozy riverside mountaineering canteen serving hearty pasta, hot stews, and breakfasts for hikers.'],
                    ['name' => 'Equator Snow Alpine Diner', 'price_ugx' => 50000, 'unit' => 'meal', 'type' => 'Lodge Dining', 'website' => null, 'description' => 'Stone fireplace dining room serving warming four-course dinners beside the rushing Mubuku mountain river.'],
                    ['name' => 'Kasese Spring International Cafe', 'price_ugx' => 22000, 'unit' => 'meal', 'type' => 'Town Cafe', 'website' => null, 'description' => 'Convenient town cafe serving espresso, Ugandan buffet dishes, and packed lunches for expeditions.'],
                ],
                'recreation' => [
                    ['name' => '1-Day Mahoma Nature Trail Hike', 'price_ugx' => 150000, 'unit' => 'entry', 'type' => 'Guided Trek', 'website' => null, 'description' => 'Superb 1-day guided alpine trek traversing bamboo zones, moorland plants, and glacial river valleys.'],
                    ['name' => 'Ruboni Community Village Cultural Walk', 'price_ugx' => 45000, 'unit' => 'entry', 'type' => 'Cultural Trail', 'website' => null, 'description' => 'Authentic Bakonzo village tour visiting traditional blacksmiths, herbalists, and folk basket weavers.'],
                    ['name' => 'River Mubuku Whitewater Scramble', 'price_ugx' => 70000, 'unit' => 'entry', 'type' => 'Mountain Activity', 'website' => null, 'description' => 'Adrenaline river scramble over ancient glacier-sculpted granite boulders and mountain torrents.'],
                ],
                'visit' => [
                    ['name' => 'Nyakalengija Trailhead Interpretive Center', 'price_ugx' => 20000, 'unit' => 'entry', 'type' => 'Mountaineering Center', 'website' => null, 'description' => 'The official starting point of the Central Circuit with exhibits on mountaineering history and botany.'],
                    ['name' => 'Ruboni Hilltop Viewpoint of Mount Stanley', 'price_ugx' => 25000, 'unit' => 'entry', 'type' => 'Mountain Lookout', 'website' => null, 'description' => 'Hilltop viewpoint offering breathtaking clear-day vistas of the glistening Margherita glaciers.'],
                ],
            ],
            'kidepo' => [
                'eat' => [
                    ['name' => 'Apoka Rest Camp Canteen', 'price_ugx' => 30000, 'unit' => 'meal', 'type' => 'Camp Canteen', 'website' => null, 'description' => 'UWA camp canteen serving cold sodas, beers, and simple freshly cooked Ugandan dishes.'],
                    ['name' => 'Kidepo Savannah Lodge Open-Air Dining', 'price_ugx' => 55000, 'unit' => 'meal', 'type' => 'Lodge Dining', 'website' => null, 'description' => 'Thatched wooden deck dining with uninterrupted views of wild game moving across Narus Valley.'],
                    ['name' => 'Apoka Safari Lodge Gourmet Table', 'price_ugx' => 95000, 'unit' => 'meal', 'type' => 'Luxury Dining', 'website' => null, 'description' => 'Fine multi-course safari dining crafted from fresh regional ingredients, served under Karamoja stars.'],
                ],
                'recreation' => [
                    ['name' => 'Lorukul Cultural Karamojong Manyattas Walk', 'price_ugx' => 60000, 'unit' => 'entry', 'type' => 'Cultural Immersion', 'website' => null, 'description' => 'Respectful cultural visit into traditional Karamojong homesteads to witness music, cattle herding, and lifestyle.'],
                    ['name' => 'Guided Bush Nature Walk in Narus', 'price_ugx' => 90000, 'unit' => 'entry', 'type' => 'Walking Safari', 'website' => null, 'description' => 'Unforgettable on-foot savannah walk with armed rangers tracking wildlife along Narus River pools.'],
                    ['name' => 'Night Spotlight Game Drive', 'price_ugx' => 140000, 'unit' => 'entry', 'type' => 'Night Safari', 'website' => null, 'description' => 'Thrilling night drive using powerful spotlights to detect nocturnal predators like leopards and hyenas.'],
                ],
                'visit' => [
                    ['name' => 'Kanangorok Hot Springs on South Sudan Border', 'price_ugx' => 25000, 'unit' => 'entry', 'type' => 'Geothermal Springs', 'website' => null, 'description' => 'Natural geothermal springs bubbling at 50 degrees Celsius nestled between the rugged Lotukei Mountains.'],
                    ['name' => 'Narus Valley Wildlife Waterhole Hide', 'price_ugx' => 20000, 'unit' => 'entry', 'type' => 'Wildlife Hide', 'website' => null, 'description' => 'Concealed wildlife observation hide overlooking the primary waterholes where animals gather in dry months.'],
                ],
            ],
            'entebbe' => [
                'eat' => [
                    ['name' => 'Goretti\'s Pizzeria on the Beach', 'price_ugx' => 35000, 'unit' => 'meal', 'type' => 'Beach Restaurant', 'website' => 'https://facebook.com/GorettisPizzeria', 'description' => 'Laid-back beachfront pizzeria where diners enjoy stone-baked pizzas with their feet in the sand of Lake Victoria.'],
                    ['name' => 'Cafe Javas Entebbe Mall', 'price_ugx' => 38000, 'unit' => 'meal', 'type' => 'Modern Casual', 'website' => 'https://cafejavas.co.ug', 'description' => 'Famous Ugandan casual dining restaurant renowned for generous portions, rich coffee, and waffles.'],
                    ['name' => '2 Friends Waterfront Seafood Bar', 'price_ugx' => 55000, 'unit' => 'meal', 'type' => 'Lakeside Dining', 'website' => null, 'description' => 'Charming open-air lakeside terrace serving fresh Lake Victoria Nile perch, calamari, and cocktails.'],
                ],
                'recreation' => [
                    ['name' => 'Ngamba Island Day Excursion & Speedboat', 'price_ugx' => 380000, 'unit' => 'entry', 'type' => 'Sanctuary Cruise', 'website' => 'https://ngambaisland.org', 'description' => 'Speedboat cruise across Lake Victoria to the 100-acre forested sanctuary protecting orphaned chimpanzees.'],
                    ['name' => 'Mabamba Swamp Shoebill Wooden Canoe', 'price_ugx' => 120000, 'unit' => 'entry', 'type' => 'Birding Safari', 'website' => null, 'description' => 'Traditional wooden boat safari through Papyrus channels to observe the prehistoric Shoebill stork.'],
                    ['name' => 'Sunset Yacht Cruise on Lake Victoria', 'price_ugx' => 140000, 'unit' => 'entry', 'type' => 'Lake Cruise', 'website' => null, 'description' => 'Relaxing late-afternoon boat cruise sailing past islands with complimentary drinks as the sun sets.'],
                ],
                'visit' => [
                    ['name' => 'Entebbe National Botanical Gardens', 'price_ugx' => 10000, 'unit' => 'entry', 'type' => 'Botanical Park', 'website' => null, 'description' => 'Established in 1898, this 40-hectare park features giant rainforest trees, Colobus monkeys, and exotic birds.'],
                    ['name' => 'UWEC (Uganda Wildlife Conservation Zoo)', 'price_ugx' => 15000, 'unit' => 'entry', 'type' => 'Wildlife Zoo', 'website' => 'https://uwec.ug', 'description' => 'Renowned wildlife rescue center where visitors see rescued lions, rhinos, chimps, and shoebills up close.'],
                    ['name' => 'Uganda Reptile Village', 'price_ugx' => 20000, 'unit' => 'entry', 'type' => 'Reptile Sanctuary', 'website' => null, 'description' => 'Educational community sanctuary caring for mambas, cobras, pythons, tortoises, and chameleons.'],
                ],
            ],
            'kampala' => [
                'eat' => [
                    ['name' => '2K Restaurant Nakasero (Local Cuisine)', 'price_ugx' => 25000, 'unit' => 'meal', 'type' => 'Authentic Local', 'website' => null, 'description' => 'Kampala legendary home of steamed matooke, peanut paste with smoked fish, beef, and local greens.'],
                    ['name' => 'Cafe Javas Oasis Mall', 'price_ugx' => 38000, 'unit' => 'meal', 'type' => 'Modern Casual', 'website' => 'https://cafejavas.co.ug', 'description' => 'Top-tier casual dining hub in central Kampala famous for loaded burgers, milkshakes, and breakfasts.'],
                    ['name' => 'Fang Fang Chinese Restaurant', 'price_ugx' => 48000, 'unit' => 'meal', 'type' => 'Asian Dining', 'website' => null, 'description' => 'Long-standing upscale Chinese culinary institution serving authentic sizzling platters and dim sum in Nakasero.'],
                    ['name' => 'The Lawns Wild Game & Grill Kololo', 'price_ugx' => 65000, 'unit' => 'meal', 'type' => 'Steakhouse', 'website' => 'https://thelawns.co.ug', 'description' => 'Fine dining garden restaurant on Kololo hill serving cuts of steak, wild game meats, and fine wines.'],
                ],
                'recreation' => [
                    ['name' => 'Ndere Cultural Centre Troupe Night Show', 'price_ugx' => 60000, 'unit' => 'entry', 'type' => 'Cultural Theater', 'website' => 'https://ndere.com', 'description' => 'World-renowned high-energy folklore dance performance showcasing music and dance from all 50+ Ugandan tribes.'],
                    ['name' => 'Kampala Rolex & Street Food Walking Safari', 'price_ugx' => 50000, 'unit' => 'entry', 'type' => 'Culinary Tour', 'website' => null, 'description' => 'Guided street food walk through lively student and market districts tasting hot Rolex, samosas, and sugar cane juice.'],
                    ['name' => 'Uganda National Theatre Performing Arts', 'price_ugx' => 35000, 'unit' => 'entry', 'type' => 'Live Theater', 'website' => null, 'description' => 'The hub of Ugandan performing arts, hosting live drama, musical concerts, comedy nights, and craft markets.'],
                ],
                'visit' => [
                    ['name' => 'Kasubi Royal Tombs UNESCO World Heritage', 'price_ugx' => 25000, 'unit' => 'entry', 'type' => 'Historical Heritage', 'website' => null, 'description' => 'The spiritual heart of the Buganda Kingdom, housing the grand thatched royal mausoleum of four historic Kabakas.'],
                    ['name' => 'Uganda National Museum Kira Road', 'price_ugx' => 15000, 'unit' => 'entry', 'type' => 'National Museum', 'website' => null, 'description' => 'Uganda oldest museum, showcasing ethnographical collections, hunting artifacts, and playable traditional instruments.'],
                    ['name' => 'Gaddafi National Mosque Minaret Tower', 'price_ugx' => 20000, 'unit' => 'entry', 'type' => 'Architectural Landmark', 'website' => null, 'description' => 'The largest mosque in East Africa perched on Old Kampala Hill; climb the 304 steps of the minaret for 360-degree city views.'],
                    ['name' => 'Bahai Temple of Africa Gardens', 'price_ugx' => 0, 'unit' => 'entry', 'type' => 'Spiritual Sanctuary', 'website' => null, 'description' => 'The only Bahai Mother Temple on the African continent, set amid 52 acres of tranquil, beautifully landscaped hilltop gardens.'],
                ],
            ],
            'ssese-islands' => [
                'eat' => [
                    ['name' => 'Kalangala Beach Camp Fish Fry', 'price_ugx' => 25000, 'unit' => 'meal', 'type' => 'Beach BBQ', 'website' => null, 'description' => 'Rustic beach cookout serving fresh whole grilled Nile tilapia and chips beside Lake Victoria bonfires.'],
                    ['name' => 'Brovad Sands Lakeside Buffet', 'price_ugx' => 50000, 'unit' => 'meal', 'type' => 'Resort Dining', 'website' => null, 'description' => 'Sumptuous resort buffet featuring fresh lake catches, continental curries, salads, and island desserts.'],
                    ['name' => 'Victoria Forest Verandah Grill', 'price_ugx' => 55000, 'unit' => 'meal', 'type' => 'Island Bistro', 'website' => null, 'description' => 'Shaded verandah restaurant looking through palm trees to the beach, serving gourmet grilled specialties.'],
                ],
                'recreation' => [
                    ['name' => 'Ssese Island Quad Bike Trail Safari', 'price_ugx' => 120000, 'unit' => 'entry', 'type' => 'Off-road Trail', 'website' => null, 'description' => 'Exciting quad bike ride through red-dirt island tracks, palm oil estates, and scenic coastal lookouts.'],
                    ['name' => 'Lake Victoria Nile Perch Sport Fishing', 'price_ugx' => 180000, 'unit' => 'entry', 'type' => 'Sport Fishing', 'website' => null, 'description' => 'Trophy sport fishing expedition targeting monster Nile perch in the deep waters of the archipelago.'],
                    ['name' => 'Bugala Island Forest Monkey Walk', 'price_ugx' => 35000, 'unit' => 'entry', 'type' => 'Nature Trail', 'website' => null, 'description' => 'Guided nature stroll through primary island rainforest to spot vervet monkeys and colourful hornbills.'],
                ],
                'visit' => [
                    ['name' => 'Lutoboka Bay Pier & White Sands', 'price_ugx' => 10000, 'unit' => 'entry', 'type' => 'Sandy Beach', 'website' => null, 'description' => 'The main passenger ferry gateway on Bugala Island with broad white sand beaches and beachfront bars.'],
                    ['name' => 'Nanziri Sacred Falls & Cave Shrine', 'price_ugx' => 25000, 'unit' => 'entry', 'type' => 'Cultural Shrine', 'website' => null, 'description' => 'Sacred waterfall and ancient cave shrine venerated by locals as the dwelling place of traditional island spirits.'],
                ],
            ],
            'lake-mburo-np' => [
                'eat' => [
                    ['name' => 'Rwakobo Rock Sunset Diner', 'price_ugx' => 35000, 'unit' => 'meal', 'type' => 'Eco-Camp Dining', 'website' => null, 'description' => 'Granite kopje dining terrace offering panoramic savannah views, home-cooked roasts, and cold beers.'],
                    ['name' => 'Arcadia Cottages Lakeside Grill', 'price_ugx' => 48000, 'unit' => 'meal', 'type' => 'Lodge Dining', 'website' => null, 'description' => 'Peaceful lakefront restaurant serving grilled meat skewers, fresh salads, and soups inside the national park.'],
                    ['name' => 'Mihingo Lodge Cliff Restaurant', 'price_ugx' => 80000, 'unit' => 'meal', 'type' => 'Fine Dining', 'website' => null, 'description' => 'Gourmet 3-course dining experience atop a high cliff overlooking a floodlit waterhole visited by wildlife.'],
                ],
                'recreation' => [
                    ['name' => 'Guided Savannah Walking Safari on Foot', 'price_ugx' => 90000, 'unit' => 'entry', 'type' => 'Walking Safari', 'website' => null, 'description' => 'Unrivaled on-foot walking safari with an armed ranger moving safely alongside herds of zebras, elands, and impalas.'],
                    ['name' => 'Mihingo Horseback Wildlife Safari (2hr)', 'price_ugx' => 350000, 'unit' => 'entry', 'type' => 'Horse Riding', 'website' => null, 'description' => 'Peaceful horseback ride through the savannah; wild zebras and giraffes curiously approach horses without fear.'],
                    ['name' => 'Lake Mburo 2hr Motorboat Cruise', 'price_ugx' => 110000, 'unit' => 'entry', 'type' => 'Boat Cruise', 'website' => null, 'description' => 'UWA boat cruise around the shores of Lake Mburo observing basking hippos, giant crocodiles, and African fish eagles.'],
                ],
                'visit' => [
                    ['name' => 'Kazuma Hill Lookout Panoramic Deck', 'price_ugx' => 20000, 'unit' => 'entry', 'type' => 'Lookout Deck', 'website' => null, 'description' => 'The park highest viewpoint with wooden observation platforms showing 8 of Lake Mburo surrounding lakes.'],
                    ['name' => 'Ankole Cultural Cattle Sanctuary', 'price_ugx' => 30000, 'unit' => 'entry', 'type' => 'Living Heritage', 'website' => null, 'description' => 'Traditional Bahima pastoralist cultural centre celebrating the regal, long-horned Ankole cattle and milk processing traditions.'],
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
                            'description' => $item['description'] ?? "Popular {$cat} destination in {$dest->name}.",
                            'website' => $item['website'] ?? null,
                            'image_path' => $this->resolvePlaceImage($cat, $item['name'], $dest),
                        ]
                    );
                }
            }
        }
    }

    protected function resolveStayImage(string $slug, string $name, string $style): string
    {
        $dedicated = 'images/hotels/' . Str::slug($name) . '.webp';
        if (file_exists(public_path($dedicated))) {
            return $dedicated;
        }

        $noAt = 'images/hotels/' . Str::slug(str_replace('@', '', $name)) . '.webp';
        if (file_exists(public_path($noAt))) {
            return $noAt;
        }

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
        $folder = match ($category) {
            'eat' => 'restaurants',
            'recreation' => 'recreation-centres',
            default => 'destinations',
        };
        $dedicated = "images/{$folder}/" . Str::slug($name) . '.webp';
        if (file_exists(public_path($dedicated))) {
            return $dedicated;
        }

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
                'Adrift River Adventures Rafting' => 'images/recreation-centres/jinja-nile-rafting.webp',
                'Nile River Tubing Crew' => 'images/recreation-centres/zipline-adventure.webp',
                'All Terrain Quad Adventures' => 'images/recreation-centres/jinja-qaud-biking-1024x678-1.webp',
                'Nile Horseback Safaris' => 'images/recreation-centres/horseback-riding-spots-kampala.webp',
                // Sipi Falls
                'Sipi Falls Abseiling Experience' => 'images/recreation-centres/Forest-park-resort-Buloba-1.webp',
                'Chebonet River Rock Scramble' => 'images/recreation-centres/rwenzori-nature-trail.webp',
                'Elgon Ridge Mountain Biking' => 'images/recreation-centres/jinja-qaud-biking-1024x678-1.webp',
                // Murchison Falls
                'Nile Launch Boat to Base of Falls' => 'images/destinations/boat-cruise-elephants.webp',
                'Budongo Forest Chimpanzee Trek' => 'images/destinations/chimpanzee-trekking.webp',
                'Albert Nile Delta Wildlife Boat' => 'images/recreation-centres/shoebill-wetland-canoe.webp',
                // Queen Elizabeth
                'UWA Kazinga Channel 2hr Boat Safari' => 'images/destinations/boat-cruise-elephants.webp',
                'Kyambura Gorge Chimp Tracking' => 'images/destinations/chimpanzee-trekking.webp',
                'Ishasha Tree-Climbing Lion Guided Drive' => 'images/recreation-centres/tree-climbing-lions.webp',
                // Bwindi
                'Batwa Cultural Forest Experience' => 'images/recreation-centres/ndere-cultural-dance.webp',
                'Munyaga Waterfall Rainforest Walk' => 'images/recreation-centres/rwenzori-nature-trail.webp',
                'Bwindi Community Bike Tour' => 'images/recreation-centres/jinja-qaud-biking-1024x678-1.webp',
                // Lake Bunyonyi
                'Supreme Adventure Park Zipline over Lake' => 'images/recreation-centres/zipline-adventure.webp',
                'Bunyonyi Motorized Canoe Safari' => 'images/destinations/lake-bunyonyi.webp',
                'Traditional Dugout Canoe Rental & Lesson' => 'images/recreation-centres/bunyonyi-canoes.webp',
                // Fort Portal
                'Ndali-Kasenda Guided Crater Bike Tour' => 'images/recreation-centres/jinja-qaud-biking-1024x678-1.webp',
                'Mpanga Tea Estate Tour & Tasting' => 'images/destinations/fort-portal-crater-lakes.webp',
                'Top of the World Viewpoint Hike' => 'images/recreation-centres/rwenzori-nature-trail.webp',
                // Rwenzori
                '1-Day Mahoma Nature Trail Hike' => 'images/recreation-centres/rwenzori-nature-trail.webp',
                'Ruboni Community Village Cultural Walk' => 'images/recreation-centres/ndere-cultural-dance.webp',
                'River Mubuku Whitewater Scramble' => 'images/recreation-centres/jinja-nile-rafting.webp',
                // Kidepo
                'Lorukul Cultural Karamojong Manyattas Walk' => 'images/recreation-centres/ndere-cultural-dance.webp',
                'Guided Bush Nature Walk in Narus' => 'images/recreation-centres/savanna-game-drive.webp',
                'Night Spotlight Game Drive' => 'images/destinations/buffalo-herd-savanna.webp',
                // Entebbe
                'Ngamba Island Day Excursion & Speedboat' => 'images/destinations/entebbe-lake-victoria.webp',
                'Mabamba Swamp Shoebill Wooden Canoe' => 'images/recreation-centres/shoebill-wetland-canoe.webp',
                'Sunset Yacht Cruise on Lake Victoria' => 'images/recreation-centres/bunyonyi-canoes.webp',
                // Kampala
                'Ndere Cultural Centre Troupe Night Show' => 'images/recreation-centres/ndere-cultural-dance.webp',
                'Kampala Rolex & Street Food Walking Safari' => 'images/restaurants/ugandan-rolex-street.webp',
                'Uganda National Theatre Performing Arts' => 'images/recreation-centres/Kavumba-Recreation-Center-Kids-Park-Wakiso-Uganda-TortoisePathcom-1.webp',
                // Ssese Islands
                'Ssese Island Quad Bike Trail Safari' => 'images/recreation-centres/jinja-qaud-biking-1024x678-1.webp',
                'Lake Victoria Nile Perch Sport Fishing' => 'images/destinations/ssese-islands.webp',
                'Bugala Island Forest Monkey Walk' => 'images/recreation-centres/rwenzori-nature-trail.webp',
                // Lake Mburo
                'Guided Savannah Walking Safari on Foot' => 'images/recreation-centres/savanna-game-drive.webp',
                'Mihingo Horseback Wildlife Safari (2hr)' => 'images/recreation-centres/horseback-riding-spots-kampala.webp',
                'Lake Mburo 2hr Motorboat Cruise' => 'images/destinations/boat-cruise-elephants.webp',
            ],
            'visit' => [
                // Jinja
                'Source of the River Nile Monument' => 'images/destinations/source-of-the-nile.webp',
                'Busowoko Falls Eco Park' => 'images/destinations/sipi-falls.webp',
                'Itanda Rapids Viewpoint' => 'images/recreation-centres/jinja-nile-rafting.webp',
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
                'Akampene (Punishment Island) Historical Tour' => 'images/recreation-centres/bunyonyi-canoes.webp',
                'Kyahugye Island Zebra & Impala Sanctuary' => 'images/destinations/lake-mburo-zebras.webp',
                'Arcadia 360-degree Hills Viewpoint' => 'images/destinations/lake-bunyonyi.webp',
                // Fort Portal
                'Amabere Ga Nyina Mwiru Caves & Waterfalls' => 'images/destinations/amabere-caves-waterfall.webp',
                'Karuzika Palace of Tooro Kingdom' => 'images/destinations/kasubi-royal-tombs.webp',
                'Kyaninga Crater Rim Trail' => 'images/destinations/fort-portal-crater-lakes.webp',
                // Rwenzori
                'Nyakalengija Trailhead Interpretive Center' => 'images/recreation-centres/rwenzori-nature-trail.webp',
                'Ruboni Hilltop Viewpoint of Mount Stanley' => 'images/destinations/rwenzori-mountains.webp',
                // Kidepo
                'Kanangorok Hot Springs on South Sudan Border' => 'images/destinations/sempaya-hot-springs.webp',
                'Narus Valley Wildlife Waterhole Hide' => 'images/recreation-centres/savanna-game-drive.webp',
                // Entebbe
                'Entebbe National Botanical Gardens' => 'images/destinations/entebbe-lake-victoria.webp',
                'UWEC (Uganda Wildlife Conservation Zoo)' => 'images/destinations/chimpanzee-trekking.webp',
                'Uganda Reptile Village' => 'images/recreation-centres/tree-climbing-lions.webp',
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
                return 'images/recreation-centres/jinja-nile-rafting.webp';
            }
            if (str_contains($lower, 'zipline') || str_contains($lower, 'ropes') || str_contains($lower, 'adventure') || str_contains($lower, 'tubing')) {
                return 'images/recreation-centres/zipline-adventure.webp';
            }
            if (str_contains($lower, 'lion') || str_contains($lower, 'reptile')) {
                return 'images/recreation-centres/tree-climbing-lions.webp';
            }
            if (str_contains($lower, 'dance') || str_contains($lower, 'troupe') || str_contains($lower, 'cultural') || str_contains($lower, 'theatre')) {
                return 'images/recreation-centres/ndere-cultural-dance.webp';
            }
            if (str_contains($lower, 'shoebill') || str_contains($lower, 'delta') || str_contains($lower, 'swamp')) {
                return 'images/recreation-centres/shoebill-wetland-canoe.webp';
            }
            if (str_contains($lower, 'canoe') || str_contains($lower, 'boat') || str_contains($lower, 'cruise') || str_contains($lower, 'yacht')) {
                return 'images/recreation-centres/bunyonyi-canoes.webp';
            }
            if (str_contains($lower, 'quad') || str_contains($lower, 'bike') || str_contains($lower, 'biking') || str_contains($lower, 'off-road')) {
                return 'images/recreation-centres/jinja-qaud-biking-1024x678-1.webp';
            }
            if (str_contains($lower, 'horse') || str_contains($lower, 'equine')) {
                return 'images/recreation-centres/horseback-riding-spots-kampala.webp';
            }
            if (str_contains($lower, 'chimp') || str_contains($lower, 'primate')) {
                return 'images/destinations/chimpanzee-trekking.webp';
            }
            if (str_contains($lower, 'trail') || str_contains($lower, 'hike') || str_contains($lower, 'scramble') || str_contains($lower, 'walk')) {
                return 'images/recreation-centres/rwenzori-nature-trail.webp';
            }
            if (str_contains($lower, 'safari') || str_contains($lower, 'game drive')) {
                return 'images/recreation-centres/savanna-game-drive.webp';
            }

            $recPool = [
                'images/recreation-centres/jinja-nile-rafting.webp',
                'images/recreation-centres/zipline-adventure.webp',
                'images/recreation-centres/tree-climbing-lions.webp',
                'images/recreation-centres/ndere-cultural-dance.webp',
                'images/recreation-centres/bunyonyi-canoes.webp',
                'images/recreation-centres/shoebill-wetland-canoe.webp',
                'images/recreation-centres/rwenzori-nature-trail.webp',
                'images/recreation-centres/savanna-game-drive.webp',
                'images/recreation-centres/horseback-riding-spots-kampala.webp',
                'images/recreation-centres/jinja-qaud-biking-1024x678-1.webp',
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
