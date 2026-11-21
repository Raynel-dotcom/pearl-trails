-- Pearl Trails Uganda Database Export
-- Generated for MySQL 5.7+ / MySQL 8.0+ / MariaDB / XAMPP phpMyAdmin
-- Ready to Import via phpMyAdmin

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = 'NO_AUTO_VALUE_ON_ZERO';
START TRANSACTION;
SET time_zone = '+00:00';

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

-- --------------------------------------------------------
-- Table structure for table `migrations`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table `migrations` (11 records)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
  (1, '0001_01_01_000000_create_users_table', 1),
  (2, '0001_01_01_000001_create_cache_table', 1),
  (3, '0001_01_01_000002_create_jobs_table', 1),
  (4, '2026_10_21_000001_create_destinations_table', 1),
  (5, '2026_10_21_000002_create_places_table', 1),
  (6, '2026_10_21_000003_create_listings_and_activities_table', 1),
  (7, '2026_10_21_000004_create_saved_trips_table', 1),
  (8, '2026_10_21_000005_add_image_path_to_places_and_listings_tables', 1),
  (9, '2026_11_06_000001_create_contact_messages_table', 2),
  (10, '2026_11_18_000001_add_website_to_places_table', 3),
  (11, '2026_11_18_132626_create_hero_slides_table', 4);

-- --------------------------------------------------------
-- Table structure for table `users`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'visitor',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table `users` (5 records)
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
  (1, 'Admin User', 'admin@exploreuganda.test', '2026-11-18 17:13:24', '$2y$12$xMXIO.bcIHsWjxGEEk/79.QoBHdpGF9szRtv5R8oOWWzZFSyM5tO2', 'admin', NULL, '2026-11-03 17:36:42', '2026-11-18 17:13:24'),
  (2, 'Safari Vendor', 'vendor@exploreuganda.test', '2026-11-18 17:13:24', '$2y$12$1NNnyb4yn/0P331a.0gBRutuktJbSUwIjSTB714TEm5M7GGwcnx.C', 'vendor', NULL, '2026-11-03 17:36:43', '2026-11-18 17:13:24'),
  (3, 'Happy Traveler', 'visitor@exploreuganda.test', '2026-11-18 17:13:25', '$2y$12$YT78l6dSikR8CFOfNOHp1OU1KcgnN26nEIkkCexk5mwMZXtHBhwmu', 'visitor', NULL, '2026-11-03 17:36:43', '2026-11-18 17:13:25'),
  (4, 'natukunda raynel', 'natukundaraynel@gmail.com', NULL, '$2y$12$pDFKAl8JmBit8CIDE5RduOVKOtDoZwhhdWaLCrJxNzpgNJgT9F.9W', 'visitor', NULL, '2026-11-20 14:21:20', '2026-11-20 14:21:20'),
  (5, 'von', 'natukundaraynel1@gmail.com', NULL, '$2y$12$vYtubo2onfrGVsfEp2PLvuZsh8pO7mDq2UUZ.ZWqJ3vktbiyzkyYu', 'vendor', NULL, '2026-11-20 14:28:15', '2026-11-20 14:28:15');

-- --------------------------------------------------------
-- Table structure for table `password_reset_tokens`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for table `sessions`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `sessions`;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table `sessions` (1 records)
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
  ('Ri8Ksk3cUh7jYR9rjF5CoUjabDHiQZBjy6qHN9Fo', 5, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/158.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiZmE2ZnJuejF5QVRCam9SVHFmUHB6dEtidkQzWkpLeDNaNHBSOElXeiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9saXN0LXlvdXItYnVzaW5lc3MiO3M6NToicm91dGUiO3M6MTg6Imxpc3QteW91ci1idXNpbmVzcyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjU7czoxNzoicGFzc3dvcmRfaGFzaF93ZWIiO3M6NjQ6ImQzM2RhNjE3YzNkYWUyZmE5YWM4ZTE2Mjc0OGY1NzU3YTc5YzRlMDVmOWJmMWY4ODlmMzUxOGUxNmQ5ZTk5YTkiO30=', 1795208758);

-- --------------------------------------------------------
-- Table structure for table `cache`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `cache`;
CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for table `cache_locks`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `cache_locks`;
CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for table `jobs`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `jobs`;
CREATE TABLE `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for table `job_batches`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `job_batches`;
CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for table `failed_jobs`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for table `destinations`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `destinations`;
CREATE TABLE `destinations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `region` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lat` decimal(10,7) NOT NULL,
  `lon` decimal(10,7) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `attractions` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `activities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `interests` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `styles` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `groups` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `difficulty` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Easy',
  `best_time` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `min_days` int(11) NOT NULL DEFAULT 1,
  `max_days` int(11) NOT NULL DEFAULT 7,
  `rec_days` int(11) NOT NULL DEFAULT 3,
  `accommodation_costs` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `food_cost` int(11) NOT NULL DEFAULT 30000,
  `activity_cost` int(11) NOT NULL DEFAULT 50000,
  `local_transport_cost` int(11) NOT NULL DEFAULT 20000,
  `preferred_trip_types` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hotel_names` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tips` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `safety` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gradient_from` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '#0F4C3A',
  `gradient_to` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '#D4AF37',
  `image_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `destinations_slug_unique` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table `destinations` (13 records)
INSERT INTO `destinations` (`id`, `slug`, `name`, `region`, `lat`, `lon`, `description`, `attractions`, `activities`, `interests`, `styles`, `groups`, `difficulty`, `best_time`, `min_days`, `max_days`, `rec_days`, `accommodation_costs`, `food_cost`, `activity_cost`, `local_transport_cost`, `preferred_trip_types`, `hotel_names`, `tips`, `safety`, `gradient_from`, `gradient_to`, `image_path`, `created_at`, `updated_at`) VALUES
  (1, 'jinja', 'Jinja', 'East', 0.43, 33.2, 'The adrenaline capital of East Africa and historic Source of the Nile River, offering world-class whitewater rafting, sunset boat cruises, and vibrant craft markets.', '["Source of the Nile","Itanda Falls","Busowoko Falls","Owen Falls Dam","Nile Discovery Beach"]', '["Whitewater Rafting","Kayaking","Bungee Jumping","Quad Biking","Tubing the Nile","Sunset Cruise","Horseback Riding"]', '["Adventure","Nature","Beaches\\/Lakes","Nightlife","Food","Culture"]', '["Budget","Moderate","Luxury"]', '["Solo","Couple","Family","Friends","Group"]', 'Moderate', 'Year-round; January to February & June to September are best for river rapids.', 1, 4, 2, '{"Budget":55000,"Moderate":550000,"Luxury":1450000}', 35000, 120000, 20000, '["Adventurous","Social","Relaxing"]', '{"Budget":"Nile River Camp & Backpackers","Moderate":"Haven Eco River Lodge","Luxury":"Lemala Wildwaters Lodge"}', 'Pack quick-dry swimwear, waterproof sunscreen, and secure footwear for water activities. Book rafting permits in advance.', 'Life jackets and helmets are mandatory for river adventures. Stick to certified rafting operators and avoid walking alone after dark along unlit river banks.', '#0F4C3A', '#1B7B59', 'images/destinations/jinja-quad-biking.webp', '2026-11-03 17:36:43', '2026-11-18 09:06:12'),
  (2, 'sipi-falls', 'Sipi Falls', 'East', 1.34, 34.36, 'A romantic series of three dramatic waterfalls cascading down the foothills of Mount Elgon, famous for lush Arabica coffee plantations and panoramic Karamoja plains views.', '["Three Sipi Cascades (100m, 85m, 75m)","Mount Elgon Foothills","Chebonet Falls","Tewei Forest","Coffee Farms"]', '["Waterfall Hiking","Abseiling Sipi Falls","Coffee Tour & Brewing","Sunset Viewpoint Walks","Bird Watching"]', '["Nature","Hiking","Adventure","Photography","Relaxation","Food"]', '["Budget","Moderate","Luxury"]', '["Solo","Couple","Friends","Group"]', 'Moderate', 'June to August & December to March for clear walking trails.', 2, 5, 3, '{"Budget":65000,"Moderate":370000,"Luxury":550000}', 30000, 80000, 25000, '["Romantic","Adventurous","Relaxing"]', '{"Budget":"Crow\'s Nest Rest Camp","Moderate":"Rafiki Lodge Sipi","Luxury":"Sipi River Lodge"}', 'Bring sturdy hiking boots with excellent grip as trails can be slippery after mist and rain. Carry cash for local community guides.', 'Always hire an accredited local guide for the 3-falls trek; steep cliffs have few guardrails.', '#1B7B59', '#D4AF37', 'images/destinations/sipi-falls.webp', '2026-11-03 17:36:43', '2026-11-18 09:06:12'),
  (3, 'murchison-falls-np', 'Murchison Falls NP', 'North', 2.28, 31.78, 'Uganda\'s oldest and largest conservation reserve, where the mighty River Nile explodes through a narrow 7-meter gorge before plunging 43 meters into the devil\'s cauldron.', '["Top of the Falls Gorge","Nile Delta","Budongo Chimpanzee Forest","Paraa River Crossing","Karuma Falls"]', '["Game Drives","Boat Cruise to Falls Base","Delta Boat Safari","Hike to Top of Falls","Chimpanzee Trekking"]', '["Wildlife","Nature","Adventure","Photography"]', '["Budget","Moderate","Luxury"]', '["Couple","Family","Friends","Group"]', 'Easy', 'December to February & June to September when wildlife gathers along the Nile.', 3, 6, 3, '{"Budget":150000,"Moderate":750000,"Luxury":1500000}', 50000, 180000, 40000, '["Adventurous","Educational","Family-friendly"]', '{"Budget":"Red Chilli Rest Camp","Moderate":"Pakuba Safari Lodge","Luxury":"Chobe Safari Lodge"}', 'Early morning game drives starting by 6:30 AM yield the best sightings of lions and leopards. Bring insect repellent for tsetse flies in woodland patches.', 'Do not exit safari vehicles in the savannah except at designated ranger viewpoints. Respect park speed limits.', '#0F4C3A', '#E68A00', 'images/destinations/murchison-falls.webp', '2026-11-03 17:36:43', '2026-11-18 09:06:12'),
  (4, 'queen-elizabeth-np', 'Queen Elizabeth NP', 'West', -0.21, 30, 'A UNESCO biosphere reserve nestled against the Albertine Rift, renowned for tree-climbing lions in Ishasha, the Kazinga Channel boat safari, and dramatic volcanic explosion craters.', '["Kazinga Channel","Ishasha Sector","Katwe Salt Lake","Kyambura Gorge","Bunyaruguru Crater Lakes"]', '["Boat Cruise on Kazinga","Savannah Game Drives","Chimpanzee Tracking in Kyambura","Lion Tracking Research","Salt Mine Tour"]', '["Wildlife","Nature","Photography","Educational","Adventure"]', '["Budget","Moderate","Luxury"]', '["Couple","Family","Friends","Group"]', 'Easy', 'January to February & June to July for dry game tracks.', 3, 6, 4, '{"Budget":185000,"Moderate":850000,"Luxury":1450000}', 45000, 160000, 35000, '["Educational","Adventurous","Family-friendly"]', '{"Budget":"Engiri Game Lodge & Campsite","Moderate":"Marafiki Safari Lodge","Luxury":"Mweya Safari Lodge"}', 'The afternoon boat cruise on Kazinga Channel has the highest concentration of hippos and bathing elephants in Africa.', 'Stay vigilant when around lodge grounds at night; wild animals roam freely between savannah and water.', '#14281F', '#1B7B59', 'images/destinations/boat-cruise-elephants.webp', '2026-11-03 17:36:43', '2026-11-18 09:06:12'),
  (5, 'bwindi', 'Bwindi Impenetrable NP', 'Southwest', -1.05, 29.7, 'An ancient rainforest dating back over 25,000 years, safeguarding almost half of the world\'s remaining endangered mountain gorillas amid mist-covered rugged ridges.', '["Mountain Gorilla Families","Buhoma, Ruhija, Rushaga, Nkuringo Sectors","Mubwindi Swamp","Batwa Heritage Communities"]', '["Gorilla Trekking","Gorilla Habituation Experience","Batwa Cultural Trail","Forest Canopy Walks","Birding in Buhoma"]', '["Wildlife","Hiking","Nature","Culture","Photography"]', '["Budget","Moderate","Luxury"]', '["Solo","Couple","Friends","Group"]', 'Challenging', 'June to August & December to February for manageable hiking slopes.', 3, 6, 3, '{"Budget":75000,"Moderate":650000,"Luxury":3200000}', 50000, 350000, 45000, '["Adventurous","Educational","Romantic"]', '{"Budget":"Bwindi Backpackers Lodge","Moderate":"Bakiga Lodge Ruhija","Luxury":"Bwindi Lodge by Volcanoes Safaris"}', 'Hire a local porter for gorilla trekking; you support community livelihood and save your stamina on steep muddy trails.', 'Strict 7-meter distance from gorillas must be maintained. Do not trek if feeling unwell to protect primates from human viruses.', '#0F4C3A', '#083327', 'images/destinations/bwindi-gorilla-1.webp', '2026-11-03 17:36:43', '2026-11-18 09:06:12'),
  (6, 'lake-bunyonyi', 'Lake Bunyonyi', 'Southwest', -1.29, 29.92, 'Often referred to as the place of little birds, this serpentine freshwater lake boasts 29 idyllic emerald islands, bilharzia-free waters, and breathtaking terraced hillsides.', '["29 Islands (Akampene\\/Punishment Island, Bushara, Kyahugye)","Terraced Kigezi Highlands","Supreme Adventure Park"]', '["Canoeing & Dugout Boat Cruises","Swimming","Island Hopping","High Ropes & Ziplining","Community & Cultural Walks"]', '["Relaxation","Nature","Beaches\\/Lakes","Romance","Adventure","Photography"]', '["Budget","Moderate","Luxury"]', '["Solo","Couple","Family","Friends","Group"]', 'Easy', 'Year-round, with June to September having clearest weather.', 2, 5, 3, '{"Budget":150000,"Moderate":550000,"Luxury":480000}', 30000, 60000, 20000, '["Relaxing","Romantic","Family-friendly"]', '{"Budget":"Bunyonyi Overland Resort","Moderate":"Arcadia Cottages Bunyonyi","Luxury":"BirdNest Resort @ Lake Bunyonyi"}', 'Order fresh Lake Bunyonyi crayfish dishes—a local delicacy prepared boiled, curried, or grilled.', 'The lake is bilharzia-free and safe to swim in, but it is extremely deep (up to 900m). Always wear a life vest in canoes.', '#1B7B59', '#0F4C3A', 'images/destinations/lake-bunyonyi.webp', '2026-11-03 17:36:43', '2026-11-18 09:06:12'),
  (7, 'fort-portal', 'Fort Portal Tourism City', 'West', 0.65, 30.28, 'Uganda\'s designated tourism capital, surrounded by lush rolling tea estates, over 50 volcanic crater lakes, and the majestic snow-capped peaks of the Rwenzori Mountains.', '["Amabere Ga Nyina Mwiru Caves","Ndali-Kasenda Crater Lakes","Tooro Kingdom Palace (Karuzika)","Kibale Forest Gateway","Mpanga Tea Estates"]', '["Crater Lake Cycling","Cave Exploration","Tooro Cultural Tours","Tea Tasting & Factory Walk","Chimpanzee Habituation"]', '["Culture","Nature","History","Adventure","Relaxation","Food"]', '["Budget","Moderate","Luxury"]', '["Solo","Couple","Family","Friends","Group"]', 'Easy', 'December to February & June to August.', 2, 5, 3, '{"Budget":175000,"Moderate":420000,"Luxury":1600000}', 30000, 70000, 20000, '["Educational","Relaxing","Family-friendly"]', '{"Budget":"Rwenzori View Guesthouse","Moderate":"Mountains of the Moon Hotel","Luxury":"Kyaninga Lodge"}', 'Rent a bicycle or boda-boda for a day to tour the Ndali-Kasenda crater belt viewpoints and Amabere caves.', 'Fort Portal is one of Uganda\'s safest and cleanest urban centres. Use registered taxi operators for out-of-town crater excursions.', '#0F4C3A', '#D4AF37', 'images/destinations/chimpanzee-trekking.webp', '2026-11-03 17:36:43', '2026-11-18 09:06:12'),
  (8, 'rwenzori', 'Rwenzori Mountains NP', 'West', 0.38, 29.9, 'The mythical "Mountains of the Moon", home to permanent glaciers, equatorial snow fields, otherworldly giant lobelias, and Mount Stanley\'s Margherita Peak (5,109m).', '["Margherita Peak (5,109m)","Lake Bujuku & Kitandara","Giant Groundsels & Lobelias","Central Circuit Trail","Kilembe Trail"]', '["High-Altitude Mountaineering","1-Day Nature Foothill Hikes","Bakonzo Cultural Village Trails","Glacial Lake Trekking"]', '["Hiking","Adventure","Nature","Photography"]', '["Budget","Moderate","Luxury"]', '["Solo","Couple","Friends","Group"]', 'Strenuous', 'January to February & July to August for dry ascents and optimal trail conditions.', 3, 9, 5, '{"Budget":80000,"Moderate":220000,"Luxury":1100000}', 45000, 280000, 30000, '["Adventurous","Educational"]', '{"Budget":"Rwenzori Trekkers Hostel & Cottages","Moderate":"Rwenzori Basecamp Guesthouse","Luxury":"Equator Snow Lodge"}', 'Acclimatize properly. Bring technical alpine gear (crampons, waterproof thermal jackets, gaiters) for peak expeditions.', 'Never hike without certified park rangers and mountain guides. High-altitude mountain sickness requires immediate descent if symptoms arise.', '#14281F', '#526B5E', 'images/destinations/rwenzori-mountains.webp', '2026-11-03 17:36:43', '2026-11-18 09:06:12'),
  (9, 'kidepo', 'Kidepo Valley NP', 'North', 3.87, 33.85, 'Uganda\'s most remote and breathtaking wilderness, featuring expansive golden savannah, dramatic rugged massifs, cheetahs, ostriches, and ancient indigenous tribes.', '["Narus Valley Waterholes","Kidepo River Sand Bed","Kanangorok Hot Springs","Mount Morungole","Lorukul Cultural Village"]', '["Savannah Game Drives","Night Game Drives","Ik & Karamojong Cultural Encounters","Guided Bush Nature Walks","Birding in Narus"]', '["Wildlife","Culture","Nature","Photography","Adventure"]', '["Budget","Moderate","Luxury"]', '["Solo","Couple","Friends","Group"]', 'Moderate', 'September to March when wildlife concentrates heavily around Narus Valley pools.', 4, 7, 4, '{"Budget":80000,"Moderate":300000,"Luxury":3500000}', 50000, 200000, 50000, '["Adventurous","Educational"]', '{"Budget":"UWA Bandas & Student Hostel","Moderate":"Kidepo Savannah Lodge","Luxury":"Apoka Safari Lodge"}', 'Opt for a 4x4 with strong air conditioning and suspension due to long distances and sun exposure. Consider domestic scheduled flights from Entebbe.', 'Stick to designated ranger tracks. High midday temperatures require hydration electrolytes.', '#E68A00', '#D4AF37', 'images/destinations/buffalo-herd-savanna.webp', '2026-11-03 17:36:43', '2026-11-18 09:06:12'),
  (10, 'entebbe', 'Entebbe Peninsula', 'Central', 0.06, 32.46, 'A tranquil lakeside garden city on Lake Victoria, home to the national botanical gardens, wildlife conservation centres, pristine beaches, and gateway to international travel.', '["Entebbe Botanical Gardens","Uganda Wildlife Conservation Education Centre (UWEC Zoo)","Ngamba Island Chimpanzee Sanctuary","Mabamba Swamp (Shoebill)","Aero Beach & Lido Beach"]', '["Shoebill Canoe Excursion","Behind-the-Scenes Zoo Experience","Sunset Lake Victoria Cruises","Botanical Forest Walks","Craft Shopping"]', '["Wildlife","Nature","Beaches\\/Lakes","Relaxation","Family-friendly","Food"]', '["Budget","Moderate","Luxury"]', '["Solo","Couple","Family","Friends","Group"]', 'Easy', 'Year-round; perfect for arriving or departing itineraries.', 1, 3, 2, '{"Budget":60000,"Moderate":500000,"Luxury":850000}', 40000, 80000, 20000, '["Relaxing","Family-friendly","Romantic"]', '{"Budget":"Entebbe Backpackers Hostel","Moderate":"2 Friends Beach Hotel","Luxury":"Protea Hotel Entebbe Resort"}', 'Take an early morning canoe into Mabamba Swamp to spot the elusive prehistoric Shoebill stork.', 'Entebbe is calm and secure with strong security presence. Be mindful of belongings at busy public lakeside beaches.', '#0F4C3A', '#1B7B59', 'images/destinations/entebbe-lake-victoria.webp', '2026-11-03 17:36:43', '2026-11-18 09:06:13'),
  (11, 'kampala', 'Kampala City', 'Central', 0.35, 32.58, 'The vibrant 7-hills capital of Uganda, pulsating with East African arts, bustling open-air markets, rich Buganda royal heritage, and world-renowned 24/7 nightlife.', '["Kasubi Royal Tombs (UNESCO)","Uganda National Museum","Gaddafi National Mosque","Bahai Mother Temple of Africa","Nakasero Food Market","Owino Flea Market"]', '["Kampala City Walking Tour","Street Food Safari (Rolex & Nyama Choma)","Nightlife & Live Music Hop","Art Gallery Tours","Craft Shopping at National Theatre"]', '["Culture","History","Food","Nightlife","Photography","Social"]', '["Budget","Moderate","Luxury"]', '["Solo","Couple","Friends","Group"]', 'Easy', 'Year-round. Evenings and weekends offer lively cultural showcases.', 1, 4, 2, '{"Budget":75000,"Moderate":450000,"Luxury":1150000}', 35000, 50000, 25000, '["Social","Educational","Adventurous"]', '{"Budget":"Bushpig Backpackers Hostel Kololo","Moderate":"Fairway Hotel & Spa","Luxury":"Kampala Serena Hotel"}', 'Taste an authentic "Ugandan Rolex" (warm chapati rolled with seasoned eggs and tomatoes) from a trusted street food artisan in Wandegeya or Kololo.', 'Watch your pockets and bags in crowded markets like Owino and the Old Taxi Park. Use ride-hailing apps like SafeBoda or Uber at night.', '#D4AF37', '#0F4C3A', 'images/recreation-centres/horseback-riding-spots-kampala.webp', '2026-11-03 17:36:43', '2026-11-18 09:06:13'),
  (12, 'ssese-islands', 'Ssese Islands (Kalangala)', 'Central', -0.35, 32.2, 'An archipelago of 84 lush tropical islands in Lake Victoria featuring untouched palm-fringed sandy beaches, forest trails, bonfire nights, and ultimate serene island relaxation.', '["Bugala Island White Beaches","Lutoboka Bay","Nanziri Falls & Caves","Palm Oil Plantations","Bukasa Island"]', '["Beach Bonfires & Sunset Lounging","Quad Biking on Island Trails","Sport Fishing on Lake Victoria","Nature & Forest Hiking","Ferry Crossing Cruise"]', '["Relaxation","Beaches\\/Lakes","Nature","Nightlife","Romance","Adventure"]', '["Budget","Moderate","Luxury"]', '["Solo","Couple","Friends","Group"]', 'Easy', 'December to March & June to September for sunny beach weather.', 2, 5, 3, '{"Budget":70000,"Moderate":450000,"Luxury":650000}', 35000, 70000, 20000, '["Relaxing","Romantic","Social"]', '{"Budget":"Hornbill Campsite & Cottages","Moderate":"Brovad Sands Lodge","Luxury":"Victoria Forest Resort Kalangala"}', 'The modern MV Kalangala ferry departs Nakiwogo pier in Entebbe daily at 2:00 PM; arrive an hour early to secure tickets.', 'Only swim at designated resort beachfronts where water clarity and safety have been vetted.', '#1B7B59', '#0F4C3A', 'images/destinations/ssese-islands.webp', '2026-11-03 17:36:43', '2026-11-18 09:06:13'),
  (13, 'lake-mburo-np', 'Lake Mburo NP', 'Southwest', -0.6, 30.95, 'Uganda\'s most accessible savannah park, characterized by acacia woodlands, rolling grasslands, herds of zebras and impalas, night bush walks, and horse-riding safaris.', '["Lake Mburo Waters","Kazuma Lookout Point","Rubanga Forest","Salt Licks","Ankole Long-Horned Cattle Herds"]', '["Walking Safaris (On Foot)","Horseback Riding Safari","Night Game Drives for Leopards","Boat Cruise on Lake Mburo","Mountain Biking in Savannah"]', '["Wildlife","Nature","Adventure","Photography","Family-friendly"]', '["Budget","Moderate","Luxury"]', '["Solo","Couple","Family","Friends","Group"]', 'Easy', 'Year-round; June to August and December to February are especially dry for easy game viewing.', 1, 4, 2, '{"Budget":200000,"Moderate":450000,"Luxury":1650000}', 40000, 130000, 25000, '["Family-friendly","Adventurous","Relaxing"]', '{"Budget":"Rwakobo Rock Eco Camp","Moderate":"Arcadia Cottages Mburo","Luxury":"Mihingo Safari Lodge"}', 'Take the guided walking safari on foot with an armed ranger—it is one of the only parks in Uganda where you can safely walk among wild zebras and giraffes.', 'Listen carefully to ranger briefing during walking or horse-riding excursions. Maintain safe distance from wildlife.', '#0F4C3A', '#E68A00', 'images/destinations/lake-mburo-zebras.webp', '2026-11-03 17:36:43', '2026-11-18 09:06:13');

-- --------------------------------------------------------
-- Table structure for table `places`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `places`;
CREATE TABLE `places` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `destination_id` bigint(20) unsigned NOT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price_ugx` int(11) NOT NULL,
  `unit` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `image_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `places_destination_id_foreign` (`destination_id`),
  CONSTRAINT `places_destination_id_foreign` FOREIGN KEY (`destination_id`) REFERENCES `destinations` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table `places` (155 records)
INSERT INTO `places` (`id`, `destination_id`, `category`, `name`, `price_ugx`, `unit`, `type`, `description`, `created_at`, `updated_at`, `image_path`, `website`) VALUES
  (1, 1, 'stay', 'Nile River Camp & Backpackers', 55000, 'night', 'Hostel/Budget', 'Riverside backpackers camp on the Nile with dorms, safari tents, swimming pool, and sunset bar.', '2026-11-03 17:36:43', '2026-11-18 09:06:23', 'images/hotels/nile-river-camp-backpackers.webp', 'https://camponthenile.com'),
  (2, 1, 'stay', 'Haven Eco River Lodge', 550000, 'night', 'Lodge/Moderate', 'Tranquil eco-lodge on the Nile banks with private bungalows, river view swimming pool, and bird sanctuary trails.', '2026-11-03 17:36:43', '2026-11-18 10:33:03', 'images/hotels/haven-eco-river-lodge.webp', 'https://thehaven-uganda.com'),
  (3, 1, 'stay', 'Lemala Wildwaters Lodge', 1450000, 'night', 'Hotel/Luxury', 'Ultra-luxury lodge secluded on its own private rainforest island amidst roaring rapids of the River Nile.', '2026-11-03 17:36:43', '2026-11-18 10:33:03', 'images/hotels/lemala-wildwaters-lodge.webp', 'https://lemalacamps.com'),
  (4, 2, 'stay', 'Crow\'s Nest Rest Camp', 65000, 'night', 'Hostel/Budget', 'Rustic mountain camp on the slopes of Mount Elgon with direct front-row views of Sipi Falls cascade.', '2026-11-03 17:36:43', '2026-11-18 10:33:03', 'images/hotels/crows-nest-rest-camp.webp', NULL),
  (5, 2, 'stay', 'Rafiki Lodge Sipi', 370000, 'night', 'Lodge/Moderate', 'Cliffside lodge overlooking the Sipi valley with stone cottages, swimming pool, and guided coffee walks.', '2026-11-03 17:36:44', '2026-11-18 09:06:23', 'images/hotels/rafiki-lodge-sipi.webp', 'https://rafikilodgesipi.com'),
  (6, 2, 'stay', 'Sipi River Lodge', 550000, 'night', 'Hotel/Luxury', 'Heritage lodge set amidst lush coffee farms and waterfalls with cozy fireplaces and gourmet dining.', '2026-11-03 17:36:44', '2026-11-18 10:33:03', 'images/hotels/sipi-river-lodge.webp', 'https://sipiheritagelodge.com'),
  (7, 3, 'stay', 'Red Chilli Rest Camp', 150000, 'night', 'Hostel/Budget', 'Iconic safari camp inside the park at Paraa offering safari tents, en-suite bandas, and open-air bar.', '2026-11-03 17:36:44', '2026-11-18 09:06:23', 'images/hotels/red-chilli-rest-camp.webp', 'https://redchillihideaway.com'),
  (8, 3, 'stay', 'Pakuba Safari Lodge', 750000, 'night', 'Lodge/Moderate', 'Elevated safari lodge on the Eastern bank of the Albert Nile with panoramic views and swimming pool.', '2026-11-03 17:36:44', '2026-11-18 09:06:23', 'images/hotels/pakuba-safari-lodge.webp', 'https://pakubasafarilodge.com'),
  (9, 3, 'stay', 'Chobe Safari Lodge', 1500000, 'night', 'Hotel/Luxury', 'Five-star Marasa Africa luxury resort with multi-tiered infinity pools overlooking the Victoria Nile.', '2026-11-03 17:36:44', '2026-11-18 09:06:23', 'images/hotels/chobe-safari-lodge.webp', 'https://chobelodgeuganda.com'),
  (10, 4, 'stay', 'Engiri Game Lodge & Campsite', 185000, 'night', 'Hostel/Budget', 'Eco-campsite and safari lodge nestled near Kazinga Channel with permanent tents, bandas, and campfire nights.', '2026-11-03 17:36:44', '2026-11-18 09:06:23', 'images/hotels/engiri-game-lodge-campsite.webp', 'https://engirigamelodge.com'),
  (11, 4, 'stay', 'Marafiki Safari Lodge', 850000, 'night', 'Lodge/Moderate', 'Eco-luxury safari tents and thatched cottages perched on a volcanic ridge overlooking Lake George.', '2026-11-03 17:36:44', '2026-11-18 09:06:23', 'images/hotels/marafiki-safari-lodge.webp', 'https://marafikisafaris.com'),
  (12, 4, 'stay', 'Mweya Safari Lodge', 1450000, 'night', 'Hotel/Luxury', 'Legendary peninsula lodge surrounded by the Kazinga Channel with infinity pool and sunset safari deck.', '2026-11-03 17:36:44', '2026-11-18 09:06:23', 'images/hotels/mweya-safari-lodge.webp', 'https://mweyalodge.com'),
  (13, 5, 'stay', 'Bwindi Backpackers Lodge', 75000, 'night', 'Hostel/Budget', 'Community-oriented backpackers lodge at the edge of the gorilla forest with dorms and private cottages.', '2026-11-03 17:36:44', '2026-11-18 10:33:03', 'images/hotels/bwindi-backpackers-lodge.webp', NULL),
  (14, 5, 'stay', 'Bakiga Lodge Ruhija', 650000, 'night', 'Lodge/Moderate', 'Non-profit eco-lodge in the misty Ruhija gorilla sector with valley-facing private balconies.', '2026-11-03 17:36:44', '2026-11-18 09:06:24', 'images/hotels/bakiga-lodge-ruhija.webp', 'https://bakigalodge.org'),
  (15, 5, 'stay', 'Bwindi Lodge by Volcanoes Safaris', 3200000, 'night', 'Hotel/Luxury', 'Ultra-luxury forest lodge featuring handcrafted stone bandas, personalized butler service, and forest spa.', '2026-11-03 17:36:44', '2026-11-18 09:06:24', 'images/hotels/bwindi-lodge-by-volcanoes-safaris.webp', 'https://volcanoessafaris.com'),
  (16, 6, 'stay', 'Bunyonyi Overland Resort', 150000, 'night', 'Hostel/Budget', 'Lakeside retreat with tiered gardens, furnished safari tents, swimming pier, and motorized canoe tours.', '2026-11-03 17:36:44', '2026-11-18 10:33:03', 'images/hotels/bunyonyi-overland-resort.webp', NULL),
  (17, 6, 'stay', 'Arcadia Cottages Bunyonyi', 550000, 'night', 'Lodge/Moderate', 'Panoramic highland lodge set atop a ridge with 360-degree views across all 29 islands of Lake Bunyonyi.', '2026-11-03 17:36:44', '2026-11-18 09:06:24', 'images/hotels/arcadia-cottages-bunyonyi.webp', 'https://arcadialodges.com'),
  (18, 6, 'stay', 'BirdNest Resort @ Lake Bunyonyi', 480000, 'night', 'Hotel/Luxury', 'Belgian-Ugandan luxury resort on the water edge with ecological pool and renowned fine dining.', '2026-11-03 17:36:44', '2026-11-18 09:06:24', 'images/hotels/birdnest-resort-at-lake-bunyonyi.webp', 'https://birdnestresort.com'),
  (19, 7, 'stay', 'Rwenzori View Guesthouse', 175000, 'night', 'Hostel/Budget', 'Quiet family-run guesthouse renowned for communal evening dinners and lush tropical gardens.', '2026-11-03 17:36:44', '2026-11-18 10:33:03', 'images/hotels/rwenzori-view-guesthouse.webp', NULL),
  (20, 7, 'stay', 'Mountains of the Moon Hotel', 420000, 'night', 'Lodge/Moderate', 'Colonial-style hotel surrounded by 15 acres of landscaped gardens with an Olympic pool and wellness spa.', '2026-11-03 17:36:44', '2026-11-18 10:33:03', 'images/hotels/mountains-of-the-moon-hotel.webp', 'https://motmh.com'),
  (21, 7, 'stay', 'Kyaninga Lodge', 1600000, 'night', 'Hotel/Luxury', 'Architectural log lodge raised above Lake Kyaninga crater with backdrop views of the Rwenzori peaks.', '2026-11-03 17:36:44', '2026-11-18 10:33:03', 'images/hotels/kyaninga-lodge.webp', 'https://kyaningalodge.com'),
  (22, 8, 'stay', 'Rwenzori Basecamp Guesthouse', 220000, 'night', 'Lodge/Moderate', 'Alpine guesthouse at the foothills of Mount Stanley supporting Central Circuit hikers and cultural walks.', '2026-11-03 17:36:44', '2026-11-18 10:33:03', 'images/hotels/rwenzori-basecamp-guesthouse.webp', NULL),
  (23, 8, 'stay', 'Equator Snow Lodge', 1100000, 'night', 'Hotel/Luxury', 'Luxury mountain lodge built from river pebbles of the Mubuku River with roaring open fireplaces.', '2026-11-03 17:36:44', '2026-11-18 09:06:24', 'images/hotels/equator-snow-lodge.webp', 'https://geolodgesafrica.com'),
  (24, 8, 'stay', 'Rwenzori Trekkers Hostel & Cottages', 80000, 'night', 'Hostel/Budget', 'The beloved mountain base of Rwenzori Trekking Services along the river in Kyanjuki with dorms and private rooms.', '2026-11-03 17:36:44', '2026-11-18 10:33:03', 'images/hotels/rwenzori-trekkers-hostel-cottages.webp', 'https://rwenzoritrekking.com'),
  (25, 9, 'stay', 'UWA Bandas & Student Hostel', 80000, 'night', 'Hostel/Budget', 'Official UWA rest camp in Narus Valley where zebras and warthogs graze between self-contained bandas.', '2026-11-03 17:36:44', '2026-11-18 10:33:04', 'images/hotels/uwa-bandas-student-hostel.webp', NULL),
  (26, 9, 'stay', 'Kidepo Savannah Lodge', 300000, 'night', 'Lodge/Moderate', 'Nature Lodges camp perched on a rocky kopje overlooking the Narus Valley grasslands with open-air dining.', '2026-11-03 17:36:44', '2026-11-18 09:06:24', 'images/hotels/kidepo-savannah-lodge.webp', 'https://naturelodgesuganda.com'),
  (27, 9, 'stay', 'Apoka Safari Lodge', 3500000, 'night', 'Hotel/Luxury', 'Top-tier luxury safari lodge carved into granite kopje with private natural stone outdoor plunge tubs.', '2026-11-03 17:36:44', '2026-11-18 09:06:24', 'images/hotels/apoka-safari-lodge.webp', 'https://wildplacesafrica.com'),
  (28, 10, 'stay', 'Entebbe Backpackers Hostel', 60000, 'night', 'Hostel/Budget', 'Friendly backpackers hostel with camping grounds, leafy shade trees, and quick access to Entebbe Airport.', '2026-11-03 17:36:44', '2026-11-18 10:33:04', 'images/hotels/entebbe-backpackers-hostel.webp', NULL),
  (29, 10, 'stay', '2 Friends Beach Hotel', 500000, 'night', 'Lodge/Moderate', 'Boutique hotel situated right along the shores of Lake Victoria with outdoor pool and beach club dining.', '2026-11-03 17:36:44', '2026-11-18 10:33:04', 'images/hotels/2-friends-beach-hotel.webp', 'https://2friendshotel.com'),
  (30, 10, 'stay', 'Protea Hotel Entebbe Resort', 850000, 'night', 'Hotel/Luxury', 'Four-star Marriott resort located 1km from the international airport with sweeping lakeside terrace and spa.', '2026-11-03 17:36:44', '2026-11-18 10:33:04', 'images/hotels/protea-hotel-entebbe-resort.webp', 'https://marriott.com'),
  (31, 11, 'stay', 'Bushpig Backpackers Hostel Kololo', 75000, 'night', 'Hostel/Budget', 'Top-rated urban hostel in upscale Kololo featuring artisan sourdough pizza, craft beer, and travel hub.', '2026-11-03 17:36:44', '2026-11-18 09:06:24', 'images/hotels/bushpig-backpackers-hostel-kololo.webp', 'https://bushpigkampala.com'),
  (32, 11, 'stay', 'Fairway Hotel & Spa', 450000, 'night', 'Lodge/Moderate', 'Historic boutique hotel with lush tropical courtyards in Nakasero, Asian Fusion restaurant, spa, and pool.', '2026-11-03 17:36:44', '2026-11-18 09:06:24', 'images/hotels/fairway-hotel-spa.webp', 'https://fairwayhotel.co.ug'),
  (33, 11, 'stay', 'Kampala Serena Hotel', 1150000, 'night', 'Hotel/Luxury', 'Five-star luxury oasis featuring 17 acres of water gardens, cascading waterfalls, and world-class dining.', '2026-11-03 17:36:44', '2026-11-18 10:33:04', 'images/hotels/kampala-serena-hotel.webp', 'https://serenahotels.com'),
  (34, 12, 'stay', 'Hornbill Campsite & Cottages', 70000, 'night', 'Hostel/Budget', 'Peaceful white-sand beach campsite tucked inside a bay of Bugala Island, surrounded by tropical forest.', '2026-11-03 17:36:44', '2026-11-18 10:33:04', 'images/hotels/hornbill-campsite-cottages.webp', NULL),
  (35, 12, 'stay', 'Brovad Sands Lodge', 450000, 'night', 'Lodge/Moderate', 'Tropical beach resort with private white sands on Bugala Island, beach hammocks, and swimming pool.', '2026-11-03 17:36:44', '2026-11-18 10:33:04', 'images/hotels/brovad-sands-lodge.webp', 'https://brovadsandslodge.com'),
  (36, 12, 'stay', 'Victoria Forest Resort Kalangala', 650000, 'night', 'Hotel/Luxury', 'Premier island resort set against natural rain forest with private beach frontage and forest trails.', '2026-11-03 17:36:44', '2026-11-18 09:06:24', 'images/hotels/victoria-forest-resort-kalangala.webp', 'https://victoriaforestresort.com'),
  (37, 13, 'stay', 'Rwakobo Rock Eco Camp', 550000, 'night', 'Hostel/Budget', 'Spectacular eco-camp perched on a massive granite outcrop overlooking Lake Mburo with solar showers and pool.', '2026-11-03 17:36:44', '2026-11-18 10:33:04', 'images/hotels/rwakobo-rock-eco-camp.webp', 'https://rwakoborock.com'),
  (38, 13, 'stay', 'Arcadia Cottages Mburo', 450000, 'night', 'Lodge/Moderate', 'Intimate lodge located inside the park with peaceful views across Lake Mburo and resident warthogs on lawn.', '2026-11-03 17:36:44', '2026-11-18 09:06:24', 'images/hotels/arcadia-cottages-mburo.webp', 'https://arcadialodges.com'),
  (39, 13, 'stay', 'Mihingo Safari Lodge', 1650000, 'night', 'Hotel/Luxury', 'Magical luxury wilderness retreat built into rock kopjes featuring an iconic infinity pool and horseback safaris.', '2026-11-03 17:36:44', '2026-11-18 09:06:24', 'images/hotels/mihingo-safari-lodge.webp', 'https://mihingolodge.com'),
  (40, 1, 'eat', 'All Friends Food Bar & Grill', 28000, 'meal', 'Restaurant', 'Popular open-air bar and grill on Jackson Crescent serving tender steaks, local tilapia, and chilled beverages.', '2026-11-03 17:36:44', '2026-11-18 10:33:04', 'images/restaurants/all-friends-food-bar-grill.webp', NULL),
  (41, 1, 'eat', 'The Source Cafe Jinja', 22000, 'meal', 'Cafe', 'Historic Jinja cafe serving fresh Uganda espresso, fresh sandwiches, smoothies, and baked goods.', '2026-11-03 17:36:44', '2026-11-18 10:33:04', 'images/restaurants/the-source-cafe-jinja.webp', NULL),
  (42, 1, 'eat', 'Java House Jinja', 35000, 'meal', 'Casual Dining', 'Modern East African casual dining chain serving burgers, breakfast platters, and gourmet coffees.', '2026-11-03 17:36:44', '2026-11-18 09:06:24', 'images/restaurants/java-house-jinja.webp', 'https://javahouseafrica.com'),
  (43, 1, 'eat', 'Igar Cafe & Bakery', 18000, 'meal', 'Bakery & Snacks', 'Central bakery and snack cafe serving authentic Ugandan rolex, pastries, samosas, and iced drinks.', '2026-11-03 17:36:44', '2026-11-18 10:33:04', 'images/restaurants/igar-cafe-bakery.webp', NULL),
  (44, 1, 'recreation', 'Adrift River Adventures Rafting', 520000, 'entry', 'Activity Centre', 'Uganda premier white-water rafting outfitter tackling the world-famous grade 5 rapids of the River Nile.', '2026-11-03 17:36:44', '2026-11-18 09:06:24', 'images/recreation-centres/adrift-river-adventures-rafting.webp', 'https://adrift.ug'),
  (45, 1, 'recreation', 'Nile River Tubing Crew', 75000, 'entry', 'River Recreation', 'Relaxing and adventure river tubing expeditions drifting along scenic sections of the Upper Nile.', '2026-11-03 17:36:44', '2026-11-18 09:06:24', 'images/recreation-centres/nile-river-tubing-crew.webp', 'https://tubingthenile.com'),
  (46, 1, 'recreation', 'All Terrain Quad Adventures', 185000, 'entry', 'Off-road Park', 'Guided all-terrain quad biking along rural dirt trails, farmland, and riverbanks of the Nile.', '2026-11-03 17:36:44', '2026-11-18 09:06:24', 'images/recreation-centres/all-terrain-quad-adventures.webp', 'https://atvadventuresuganda.com'),
  (47, 1, 'recreation', 'Nile Horseback Safaris', 150000, 'entry', 'Equine Trails', 'Scenic horseback safaris along riverbanks and local village trails suitable for beginner and experienced riders.', '2026-11-03 17:36:44', '2026-11-18 09:06:24', 'images/recreation-centres/nile-horseback-safaris.webp', 'https://nilehorsebacksafaris.com'),
  (48, 1, 'visit', 'Source of the River Nile Monument', 10000, 'entry', 'Historical Monument', 'The historic geographical spot where the Nile emerges from Lake Victoria on its journey to the Mediterranean.', '2026-11-03 17:36:44', '2026-11-18 10:33:04', 'images/destinations/source-of-the-river-nile-monument.webp', NULL),
  (49, 1, 'visit', 'Busowoko Falls Eco Park', 15000, 'entry', 'Natural Waterfall', 'Dramatic foaming cascades along the Nile with boardwalks, scenic picnic grounds, and swimming pools.', '2026-11-03 17:36:45', '2026-11-18 10:33:04', 'images/destinations/busowoko-falls-eco-park.webp', NULL),
  (50, 1, 'visit', 'Itanda Rapids Viewpoint', 10000, 'entry', 'Scenic River Rapids', 'Spectacular thunderous river rapids famous for extreme kayaking and powerful white-water hydraulics.', '2026-11-03 17:36:45', '2026-11-18 10:33:04', 'images/destinations/itanda-rapids-viewpoint.webp', NULL),
  (51, 2, 'eat', 'Sipi Coffee View Cafe', 18000, 'meal', 'Cafe', 'Perched cafe offering steaming freshly brewed Mount Elgon Arabica coffee and scenic valley terrace views.', '2026-11-03 17:36:45', '2026-11-18 10:33:04', 'images/restaurants/sipi-coffee-view-cafe.webp', NULL),
  (52, 2, 'eat', 'Lacam Verandah Diner', 32000, 'meal', 'Restaurant', 'Cliffside verandah restaurant serving hearty homemade soups, grilled meats, and local Ugandan dishes.', '2026-11-03 17:36:45', '2026-11-18 10:33:04', 'images/restaurants/lacam-verandah-diner.webp', NULL),
  (53, 2, 'eat', 'Rafiki Terrace Dining', 40000, 'meal', 'Bistro', 'Open-air bistro with panoramic sunset views over Sipi valley, serving fresh wood-fired meals and cocktails.', '2026-11-03 17:36:45', '2026-11-18 10:33:04', 'images/restaurants/rafiki-terrace-dining.webp', NULL),
  (54, 2, 'recreation', 'Sipi Falls Abseiling Experience', 180000, 'entry', 'Extreme Sports', 'Exhilarating 100-meter abseil descent alongside the thunderous main waterfall of Sipi Falls.', '2026-11-03 17:36:45', '2026-11-18 10:33:04', 'images/recreation-centres/sipi-falls-abseiling-experience.webp', NULL),
  (55, 2, 'recreation', 'Chebonet River Rock Scramble', 45000, 'entry', 'Guided Trek', 'Guided boulder hike along Chebonet mountain stream with natural stone pools and hidden river caves.', '2026-11-03 17:36:45', '2026-11-18 10:33:04', 'images/recreation-centres/chebonet-river-rock-scramble.webp', NULL),
  (56, 2, 'recreation', 'Elgon Ridge Mountain Biking', 80000, 'entry', 'Bike Trail', 'Thrilling downhill mountain biking through coffee farms, cliff ridges, and high Mount Elgon trails.', '2026-11-03 17:36:45', '2026-11-18 10:33:04', 'images/recreation-centres/elgon-ridge-mountain-biking.webp', NULL),
  (57, 2, 'visit', 'Sipi Three-Falls Trail Access', 35000, 'entry', 'Waterfall Trail', 'Guided trek exploring all three magnificent waterfalls of Sipi cascading 100m, 85m, and 75m down the mountain.', '2026-11-03 17:36:45', '2026-11-18 10:33:04', 'images/destinations/sipi-three-falls-trail-access.webp', NULL),
  (58, 2, 'visit', 'Bugisu Arabica Coffee Farm Walk', 30000, 'entry', 'Agro-Tourism', 'Immersive hands-on coffee tour from picking beans to roasting, grinding, and brewing fresh Arabica.', '2026-11-03 17:36:45', '2026-11-18 10:33:04', 'images/destinations/bugisu-arabica-coffee-farm-walk.webp', NULL),
  (59, 2, 'visit', 'Tewei Forest Sanctuary', 15000, 'entry', 'Forest Reserve', 'Peaceful evergreen forest pocket home to chameleons, black-and-white colobus monkeys, and exotic birds.', '2026-11-03 17:36:45', '2026-11-18 10:33:04', 'images/destinations/tewei-forest-sanctuary.webp', NULL),
  (60, 3, 'eat', 'Red Chilli River Camp Restaurant', 35000, 'meal', 'Safari Camp Diner', 'Casual safari diner serving pizzas, full English breakfasts, and cold Nile Special beers under open skies.', '2026-11-03 17:36:45', '2026-11-18 10:33:04', 'images/restaurants/red-chilli-river-camp-restaurant.webp', NULL),
  (61, 3, 'eat', 'Pakuba Safari Restaurant', 60000, 'meal', 'Lodge Dining', 'Full-board lodge restaurant with panoramic views of Albert Nile, serving international and local buffet courses.', '2026-11-03 17:36:45', '2026-11-18 10:33:04', 'images/restaurants/pakuba-safari-restaurant.webp', NULL),
  (62, 3, 'eat', 'Paraa Safari Riverside Terrace', 75000, 'meal', 'Fine Dining', 'Elevated terrace restaurant overlooking the flowing Nile with colonial charm and international wine selection.', '2026-11-03 17:36:45', '2026-11-18 10:33:04', 'images/restaurants/paraa-safari-riverside-terrace.webp', NULL),
  (63, 3, 'recreation', 'Nile Launch Boat to Base of Falls', 110000, 'entry', 'River Cruise', 'Official UWA boat safari sailing past pods of hippos and giant crocodiles to the bottom of the roaring falls.', '2026-11-03 17:36:45', '2026-11-18 10:33:04', 'images/recreation-centres/nile-launch-boat-to-base-of-falls.webp', NULL),
  (64, 3, 'recreation', 'Budongo Forest Chimpanzee Trek', 350000, 'entry', 'Primate Sanctuary', 'Guided tracking through mahogany rainforest to encounter habituated wild chimpanzee communities.', '2026-11-03 17:36:45', '2026-11-18 10:33:04', 'images/recreation-centres/budongo-forest-chimpanzee-trek.webp', NULL),
  (65, 3, 'recreation', 'Albert Nile Delta Wildlife Boat', 180000, 'entry', 'Birding Safari', 'Specialized river cruise heading into the Lake Albert delta in search of rare shoebill storks and elephant herds.', '2026-11-03 17:36:45', '2026-11-18 10:33:04', 'images/recreation-centres/albert-nile-delta-wildlife-boat.webp', NULL),
  (66, 3, 'visit', 'Top of Murchison Falls Gorge Trail', 35000, 'entry', 'National Park Site', 'Dramatic viewpoint where the full volume of the Victoria Nile surges violently through a 7-meter rock crevice.', '2026-11-03 17:36:45', '2026-11-18 10:33:04', 'images/destinations/top-of-murchison-falls-gorge-trail.webp', NULL),
  (67, 3, 'visit', 'Paraa Ferry Nile Crossing', 25000, 'entry', 'Scenic Crossing', 'Scenic vehicle and passenger ferry connecting northern game tracks with southern forest sectors across the Nile.', '2026-11-03 17:36:45', '2026-11-18 10:33:04', 'images/destinations/paraa-ferry-nile-crossing.webp', NULL),
  (68, 3, 'visit', 'Kaniyo Pabidi Mahogany Forest', 45000, 'entry', 'Nature Reserve', 'Ancient ironwood forest trail with towering mahogany trees, baboon troops, and diverse forest bird species.', '2026-11-03 17:36:45', '2026-11-18 10:33:04', 'images/destinations/kaniyo-pabidi-mahogany-forest.webp', NULL),
  (69, 4, 'eat', 'Tembo Canteen & Grill', 28000, 'meal', 'Local Grill', 'Ranger canteen serving freshly cooked matooke, beef stew, tilapia, and chapati near park headquarters.', '2026-11-03 17:36:45', '2026-11-18 10:33:04', 'images/restaurants/tembo-canteen-grill.webp', NULL),
  (70, 4, 'eat', 'Kazinga Channel Lookout Bistro', 50000, 'meal', 'Lodge Dining', 'Lodge bistro overlooking the waterway with wildlife views and continental dining.', '2026-11-03 17:36:45', '2026-11-18 10:33:04', 'images/restaurants/kazinga-channel-lookout-bistro.webp', NULL),
  (71, 4, 'eat', 'Bush Lodge River View Diner', 55000, 'meal', 'Eco-Diner', 'Romantic open-air dining terrace illuminated by hurricane lanterns, serving multi-course evening meals.', '2026-11-03 17:36:45', '2026-11-18 10:33:04', 'images/restaurants/bush-lodge-river-view-diner.webp', NULL),
  (72, 4, 'recreation', 'UWA Kazinga Channel 2hr Boat Safari', 110000, 'entry', 'Channel Cruise', 'The world-famous boat safari delivering close-up sightings of hippos, bathing buffalos, and water birds.', '2026-11-03 17:36:45', '2026-11-18 10:33:04', 'images/recreation-centres/uwa-kazinga-channel-2hr-boat-safari.webp', NULL),
  (73, 4, 'recreation', 'Kyambura Gorge Chimp Tracking', 370000, 'entry', 'Primate Trek', 'Descend into the sunken Valley of Apes rainforest to track isolated communities of chimpanzees.', '2026-11-03 17:36:45', '2026-11-18 10:33:04', 'images/recreation-centres/kyambura-gorge-chimp-tracking.webp', NULL),
  (74, 4, 'recreation', 'Ishasha Tree-Climbing Lion Guided Drive', 110000, 'entry', 'Ranger Guided Safari', 'Ranger-guided safari through Ishasha savannah to spot legendary lions lounging in large fig trees.', '2026-11-03 17:36:45', '2026-11-18 10:33:04', 'images/recreation-centres/ishasha-tree-climbing-lion-guided-drive.webp', NULL),
  (75, 4, 'visit', 'Lake Katwe Traditional Salt Mines', 25000, 'entry', 'Heritage Site', 'Centuries-old volcanic salt lake where local miners harvest pure rock salt using traditional methods.', '2026-11-03 17:36:45', '2026-11-18 10:33:04', 'images/destinations/lake-katwe-traditional-salt-mines.webp', NULL),
  (76, 4, 'visit', 'Bunyaruguru Twin Crater Lookout', 15000, 'entry', 'Crater Viewpoint', 'Scenic volcanic rim offering breathtaking panoramic views of twin crater lakes and the Rift Valley floor.', '2026-11-03 17:36:45', '2026-11-18 10:33:04', 'images/destinations/bunyaruguru-twin-crater-lookout.webp', NULL),
  (77, 4, 'visit', 'Kikorongo Equator Monument', 10000, 'entry', 'Geographical Landmark', 'Iconic geographic landmark marking 0 degrees latitude with unobstructed views of the Rwenzori foothills.', '2026-11-03 17:36:45', '2026-11-18 10:33:04', 'images/destinations/kikorongo-equator-monument.webp', NULL),
  (78, 5, 'eat', 'Buhoma Community Rest Haven Meals', 35000, 'meal', 'Community Restaurant', 'Locally run community restaurant serving organic garden salads, chicken stews, and hot post-trek lunches.', '2026-11-03 17:36:45', '2026-11-18 10:33:04', 'images/restaurants/buhoma-community-rest-haven-meals.webp', NULL),
  (79, 5, 'eat', 'Bakiga Lodge Organic Kitchen', 50000, 'meal', 'Lodge Dining', 'Farm-to-table organic kitchen serving wholesome hearty meals with panoramic views of Ruhija forest.', '2026-11-03 17:36:45', '2026-11-18 10:33:04', 'images/restaurants/bakiga-lodge-organic-kitchen.webp', NULL),
  (80, 5, 'eat', 'Silverback Gorilla Bistro', 65000, 'meal', 'Fine Dining', 'Highland lodge restaurant offering warm fireplaces, 3-course dinners, and fine wine after mountain gorilla treks.', '2026-11-03 17:36:45', '2026-11-18 10:33:04', 'images/restaurants/silverback-gorilla-bistro.webp', NULL),
  (81, 5, 'recreation', 'Batwa Cultural Forest Experience', 150000, 'entry', 'Cultural Trail', 'Authentic trail led by indigenous Batwa elders showcasing ancient forest survival, traditional medicine, and music.', '2026-11-03 17:36:45', '2026-11-18 10:33:04', 'images/recreation-centres/batwa-cultural-forest-experience.webp', NULL),
  (82, 5, 'recreation', 'Munyaga Waterfall Rainforest Walk', 80000, 'entry', 'Forest Nature Trail', 'Ranger-guided rainforest trek past ancient ferns and orchid trees to three cascading mountain waterfalls.', '2026-11-03 17:36:45', '2026-11-18 10:33:04', 'images/recreation-centres/munyaga-waterfall-rainforest-walk.webp', NULL),
  (83, 5, 'recreation', 'Bwindi Community Bike Tour', 70000, 'entry', 'Cycling Tour', 'Guided cycling tour through tea plantations, local schools, and artisan villages along the park border.', '2026-11-03 17:36:45', '2026-11-18 10:33:04', 'images/recreation-centres/bwindi-community-bike-tour.webp', NULL),
  (84, 5, 'visit', 'Ride 4 a Woman Craft Center', 15000, 'entry', 'Artisan Cooperative', 'Inspiring women cooperative teaching traditional basket weaving, textile sewing, and cultural storytelling.', '2026-11-03 17:36:45', '2026-11-18 09:06:25', 'images/destinations/ride-4-a-woman-craft-center.webp', 'https://ride4awoman.org'),
  (85, 5, 'visit', 'Buhoma Gorilla Hospital Visitor Wing', 20000, 'entry', 'Conservation Education', 'Conservation veterinary center dedicated to saving wild mountain gorillas through veterinary medicine and education.', '2026-11-03 17:36:45', '2026-11-18 09:06:25', 'images/destinations/buhoma-gorilla-hospital-visitor-wing.webp', 'https://gorilladoctors.org'),
  (86, 6, 'eat', 'Bunyonyi Overland Lake Bar & Grill', 28000, 'meal', 'Lakeside Grill', 'Lakeside terrace grill serving Lake Bunyonyi crayfish curries, grilled tilapia, and fresh pizzas.', '2026-11-03 17:36:45', '2026-11-18 10:33:04', 'images/restaurants/bunyonyi-overland-lake-bar-grill.webp', NULL),
  (87, 6, 'eat', 'Arcadia Highlands Panoramic Restaurant', 45000, 'meal', 'Scenic Dining', 'Highland panoramic restaurant serving buffet meals while overlooking all 29 islands of Lake Bunyonyi.', '2026-11-03 17:36:45', '2026-11-18 10:33:04', 'images/restaurants/arcadia-highlands-panoramic-restaurant.webp', NULL),
  (88, 6, 'eat', 'BirdNest Belgo-Ugandan Kitchen', 55000, 'meal', 'Fine Dining', 'Critically acclaimed culinary kitchen blending authentic Belgian culinary recipes with fresh Ugandan ingredients.', '2026-11-03 17:36:45', '2026-11-18 10:33:04', 'images/restaurants/birdnest-belgo-ugandan-kitchen.webp', NULL),
  (89, 6, 'recreation', 'Supreme Adventure Park Zipline over Lake', 80000, 'entry', 'Adventure Park', 'High-adrenaline zipline flying directly over the tranquil waters of Lake Bunyonyi and high ropes courses.', '2026-11-03 17:36:45', '2026-11-18 10:33:04', 'images/recreation-centres/supreme-adventure-park-zipline-over-lake.webp', NULL),
  (90, 6, 'recreation', 'Bunyonyi Motorized Canoe Safari', 60000, 'entry', 'Boat Cruise', 'Guided island-hopping motorboat cruise visiting historical Punishment Island, Bushara, and Kyahugye.', '2026-11-03 17:36:45', '2026-11-18 10:33:04', 'images/recreation-centres/bunyonyi-motorized-canoe-safari.webp', NULL),
  (91, 6, 'recreation', 'Traditional Dugout Canoe Rental & Lesson', 30000, 'entry', 'Water Sports', 'Learn the ancient art of paddling a traditional handcrafted wooden dugout canoe across calm waters.', '2026-11-03 17:36:45', '2026-11-18 10:33:04', 'images/recreation-centres/traditional-dugout-canoe-rental-lesson.webp', NULL),
  (92, 6, 'visit', 'Akampene (Punishment Island) Historical Tour', 35000, 'entry', 'Historic Island', 'Somber and historic island where pregnant unmarried Bakiga girls were once abandoned, now an educational site.', '2026-11-03 17:36:45', '2026-11-18 10:33:04', 'images/destinations/akampene-punishment-island-historical-tour.webp', NULL),
  (93, 6, 'visit', 'Kyahugye Island Zebra & Impala Sanctuary', 50000, 'entry', 'Island Wildlife Reserve', 'Privately protected island sanctuary where zebras, impalas, and waterbucks roam amidst highland lake scenery.', '2026-11-03 17:36:45', '2026-11-18 10:33:04', 'images/destinations/kyahugye-island-zebra-impala-sanctuary.webp', NULL),
  (94, 6, 'visit', 'Arcadia 360-degree Hills Viewpoint', 15000, 'entry', 'Scenic Viewpoint', 'The most photographed panoramic viewpoint in southwestern Uganda, looking across 29 serene islands.', '2026-11-03 17:36:45', '2026-11-18 10:33:04', 'images/destinations/arcadia-360-degree-hills-viewpoint.webp', NULL),
  (95, 7, 'eat', 'Gardens Restaurant Fort Portal', 25000, 'meal', 'Local & Continental', 'Popular Fort Portal dining garden serving tasty local matooke, smoked beef, and continental specials.', '2026-11-03 17:36:45', '2026-11-18 10:33:04', 'images/restaurants/gardens-restaurant-fort-portal.webp', NULL),
  (96, 7, 'eat', 'The Dutchess European Diner', 38000, 'meal', 'Bistro & Pizzeria', 'Renowned boutique restaurant famous for stone-baked pizzas, goat milk cheeses, and gourmet burgers.', '2026-11-03 17:36:45', '2026-11-18 10:33:04', 'images/restaurants/the-dutchess-european-diner.webp', NULL),
  (97, 7, 'eat', 'Mountains of the Moon Verandah', 50000, 'meal', 'Hotel Dining', 'Grand colonial hotel verandah restaurant overlooking manicured lawns, serving multi-course meals.', '2026-11-03 17:36:45', '2026-11-18 10:33:05', 'images/restaurants/mountains-of-the-moon-verandah.webp', NULL),
  (98, 7, 'recreation', 'Ndali-Kasenda Guided Crater Bike Tour', 75000, 'entry', 'Cycling Excursion', 'Guided mountain biking across volcanic ridges connecting over a dozen emerald-green crater lakes.', '2026-11-03 17:36:46', '2026-11-18 10:33:05', 'images/recreation-centres/ndali-kasenda-guided-crater-bike-tour.webp', NULL),
  (99, 7, 'recreation', 'Mpanga Tea Estate Tour & Tasting', 35000, 'entry', 'Agro-Tourism', 'Walk through rolling emerald tea fields, learn plucking techniques, and taste fresh processed tea.', '2026-11-03 17:36:46', '2026-11-18 10:33:05', 'images/recreation-centres/mpanga-tea-estate-tour-tasting.webp', NULL),
  (100, 7, 'recreation', 'Top of the World Viewpoint Hike', 25000, 'entry', 'Scenic Trek', 'Rewarding hilltop trek offering panoramic views of three volcanic craters and Mount Stanley peaks.', '2026-11-03 17:36:46', '2026-11-18 10:33:05', 'images/recreation-centres/top-of-the-world-viewpoint-hike.webp', NULL),
  (101, 7, 'visit', 'Amabere Ga Nyina Mwiru Caves & Waterfalls', 25000, 'entry', 'Stalactite Caves', 'Limestone stalactites and plunging waterfalls steeped in rich Tooro Kingdom folklore and royal legends.', '2026-11-03 17:36:46', '2026-11-18 10:33:05', 'images/destinations/amabere-ga-nyina-mwiru-caves-waterfalls.webp', NULL),
  (102, 7, 'visit', 'Karuzika Palace of Tooro Kingdom', 20000, 'entry', 'Royal Heritage', 'The circular hilltop royal palace of King Oyo, commanding 360-degree vistas across Fort Portal city.', '2026-11-03 17:36:46', '2026-11-18 10:33:05', 'images/destinations/karuzika-palace-of-tooro-kingdom.webp', NULL),
  (103, 7, 'visit', 'Kyaninga Crater Rim Trail', 20000, 'entry', 'Crater Lake', 'Scenic nature trail circumscribing the rim of Lake Kyaninga, an ancient and pristine explosion crater.', '2026-11-03 17:36:46', '2026-11-18 10:33:05', 'images/destinations/kyaninga-crater-rim-trail.webp', NULL),
  (104, 8, 'eat', 'Trekkers Rest Canteen Kilembe', 28000, 'meal', 'Mountain Canteen', 'Cozy riverside mountaineering canteen serving hearty pasta, hot stews, and breakfasts for hikers.', '2026-11-03 17:36:46', '2026-11-18 10:33:05', 'images/restaurants/trekkers-rest-canteen-kilembe.webp', NULL),
  (105, 8, 'eat', 'Equator Snow Alpine Diner', 50000, 'meal', 'Lodge Dining', 'Stone fireplace dining room serving warming four-course dinners beside the rushing Mubuku mountain river.', '2026-11-03 17:36:46', '2026-11-18 10:33:05', 'images/restaurants/equator-snow-alpine-diner.webp', NULL),
  (106, 8, 'eat', 'Kasese Spring International Cafe', 22000, 'meal', 'Town Cafe', 'Convenient town cafe serving espresso, Ugandan buffet dishes, and packed lunches for expeditions.', '2026-11-03 17:36:46', '2026-11-18 10:33:05', 'images/restaurants/kasese-spring-international-cafe.webp', NULL),
  (107, 8, 'recreation', '1-Day Mahoma Nature Trail Hike', 150000, 'entry', 'Guided Trek', 'Superb 1-day guided alpine trek traversing bamboo zones, moorland plants, and glacial river valleys.', '2026-11-03 17:36:46', '2026-11-18 10:33:05', 'images/recreation-centres/1-day-mahoma-nature-trail-hike.webp', NULL),
  (108, 8, 'recreation', 'Ruboni Community Village Cultural Walk', 45000, 'entry', 'Cultural Trail', 'Authentic Bakonzo village tour visiting traditional blacksmiths, herbalists, and folk basket weavers.', '2026-11-03 17:36:46', '2026-11-18 10:33:05', 'images/recreation-centres/ruboni-community-village-cultural-walk.webp', NULL),
  (109, 8, 'recreation', 'River Mubuku Whitewater Scramble', 70000, 'entry', 'Mountain Activity', 'Adrenaline river scramble over ancient glacier-sculpted granite boulders and mountain torrents.', '2026-11-03 17:36:46', '2026-11-18 10:33:05', 'images/recreation-centres/river-mubuku-whitewater-scramble.webp', NULL),
  (110, 8, 'visit', 'Nyakalengija Trailhead Interpretive Center', 20000, 'entry', 'Mountaineering Center', 'The official starting point of the Central Circuit with exhibits on mountaineering history and botany.', '2026-11-03 17:36:46', '2026-11-18 10:33:05', 'images/destinations/nyakalengija-trailhead-interpretive-center.webp', NULL),
  (111, 8, 'visit', 'Ruboni Hilltop Viewpoint of Mount Stanley', 25000, 'entry', 'Mountain Lookout', 'Hilltop viewpoint offering breathtaking clear-day vistas of the glistening Margherita glaciers.', '2026-11-03 17:36:46', '2026-11-18 10:33:05', 'images/destinations/ruboni-hilltop-viewpoint-of-mount-stanley.webp', NULL),
  (112, 9, 'eat', 'Apoka Rest Camp Canteen', 30000, 'meal', 'Camp Canteen', 'UWA camp canteen serving cold sodas, beers, and simple freshly cooked Ugandan dishes.', '2026-11-03 17:36:46', '2026-11-18 10:33:05', 'images/restaurants/apoka-rest-camp-canteen.webp', NULL),
  (113, 9, 'eat', 'Kidepo Savannah Lodge Open-Air Dining', 55000, 'meal', 'Lodge Dining', 'Thatched wooden deck dining with uninterrupted views of wild game moving across Narus Valley.', '2026-11-03 17:36:46', '2026-11-18 10:33:05', 'images/restaurants/kidepo-savannah-lodge-open-air-dining.webp', NULL),
  (114, 9, 'eat', 'Apoka Safari Lodge Gourmet Table', 95000, 'meal', 'Luxury Dining', 'Fine multi-course safari dining crafted from fresh regional ingredients, served under Karamoja stars.', '2026-11-03 17:36:46', '2026-11-18 10:33:05', 'images/restaurants/apoka-safari-lodge-gourmet-table.webp', NULL),
  (115, 9, 'recreation', 'Lorukul Cultural Karamojong Manyattas Walk', 60000, 'entry', 'Cultural Immersion', 'Respectful cultural visit into traditional Karamojong homesteads to witness music, cattle herding, and lifestyle.', '2026-11-03 17:36:46', '2026-11-18 10:33:05', 'images/recreation-centres/lorukul-cultural-karamojong-manyattas-walk.webp', NULL),
  (116, 9, 'recreation', 'Guided Bush Nature Walk in Narus', 90000, 'entry', 'Walking Safari', 'Unforgettable on-foot savannah walk with armed rangers tracking wildlife along Narus River pools.', '2026-11-03 17:36:46', '2026-11-18 10:33:05', 'images/recreation-centres/guided-bush-nature-walk-in-narus.webp', NULL),
  (117, 9, 'recreation', 'Night Spotlight Game Drive', 140000, 'entry', 'Night Safari', 'Thrilling night drive using powerful spotlights to detect nocturnal predators like leopards and hyenas.', '2026-11-03 17:36:46', '2026-11-18 10:33:05', 'images/recreation-centres/night-spotlight-game-drive.webp', NULL),
  (118, 9, 'visit', 'Kanangorok Hot Springs on South Sudan Border', 25000, 'entry', 'Geothermal Springs', 'Natural geothermal springs bubbling at 50 degrees Celsius nestled between the rugged Lotukei Mountains.', '2026-11-03 17:36:46', '2026-11-18 10:33:05', 'images/destinations/kanangorok-hot-springs-on-south-sudan-border.webp', NULL),
  (119, 9, 'visit', 'Narus Valley Wildlife Waterhole Hide', 20000, 'entry', 'Wildlife Hide', 'Concealed wildlife observation hide overlooking the primary waterholes where animals gather in dry months.', '2026-11-03 17:36:46', '2026-11-18 10:33:05', 'images/destinations/narus-valley-wildlife-waterhole-hide.webp', NULL),
  (120, 10, 'eat', 'Goretti\'s Pizzeria on the Beach', 35000, 'meal', 'Beach Restaurant', 'Laid-back beachfront pizzeria where diners enjoy stone-baked pizzas with their feet in the sand of Lake Victoria.', '2026-11-03 17:36:46', '2026-11-18 09:06:26', 'images/restaurants/gorettis-pizzeria-on-the-beach.webp', 'https://facebook.com/GorettisPizzeria'),
  (121, 10, 'eat', 'Cafe Javas Entebbe Mall', 38000, 'meal', 'Modern Casual', 'Famous Ugandan casual dining restaurant renowned for generous portions, rich coffee, and waffles.', '2026-11-03 17:36:46', '2026-11-18 09:06:26', 'images/restaurants/cafe-javas-entebbe-mall.webp', 'https://cafejavas.co.ug'),
  (122, 10, 'eat', '2 Friends Waterfront Seafood Bar', 55000, 'meal', 'Lakeside Dining', 'Charming open-air lakeside terrace serving fresh Lake Victoria Nile perch, calamari, and cocktails.', '2026-11-03 17:36:46', '2026-11-18 10:33:05', 'images/restaurants/2-friends-waterfront-seafood-bar.webp', NULL),
  (123, 10, 'recreation', 'Ngamba Island Day Excursion & Speedboat', 380000, 'entry', 'Sanctuary Cruise', 'Speedboat cruise across Lake Victoria to the 100-acre forested sanctuary protecting orphaned chimpanzees.', '2026-11-03 17:36:46', '2026-11-18 09:06:26', 'images/recreation-centres/ngamba-island-day-excursion-speedboat.webp', 'https://ngambaisland.org'),
  (124, 10, 'recreation', 'Mabamba Swamp Shoebill Wooden Canoe', 120000, 'entry', 'Birding Safari', 'Traditional wooden boat safari through Papyrus channels to observe the prehistoric Shoebill stork.', '2026-11-03 17:36:46', '2026-11-18 10:33:05', 'images/recreation-centres/mabamba-swamp-shoebill-wooden-canoe.webp', NULL),
  (125, 10, 'recreation', 'Sunset Yacht Cruise on Lake Victoria', 140000, 'entry', 'Lake Cruise', 'Relaxing late-afternoon boat cruise sailing past islands with complimentary drinks as the sun sets.', '2026-11-03 17:36:46', '2026-11-18 10:33:05', 'images/recreation-centres/sunset-yacht-cruise-on-lake-victoria.webp', NULL),
  (126, 10, 'visit', 'Entebbe National Botanical Gardens', 10000, 'entry', 'Botanical Park', 'Established in 1898, this 40-hectare park features giant rainforest trees, Colobus monkeys, and exotic birds.', '2026-11-03 17:36:46', '2026-11-18 10:33:05', 'images/destinations/entebbe-national-botanical-gardens.webp', NULL),
  (127, 10, 'visit', 'UWEC (Uganda Wildlife Conservation Zoo)', 15000, 'entry', 'Wildlife Zoo', 'Renowned wildlife rescue center where visitors see rescued lions, rhinos, chimps, and shoebills up close.', '2026-11-03 17:36:46', '2026-11-18 09:06:26', 'images/destinations/uwec-uganda-wildlife-conservation-zoo.webp', 'https://uwec.ug'),
  (128, 10, 'visit', 'Uganda Reptile Village', 20000, 'entry', 'Reptile Sanctuary', 'Educational community sanctuary caring for mambas, cobras, pythons, tortoises, and chameleons.', '2026-11-03 17:36:46', '2026-11-18 10:33:05', 'images/destinations/uganda-reptile-village.webp', NULL),
  (129, 11, 'eat', '2K Restaurant Nakasero (Local Cuisine)', 25000, 'meal', 'Authentic Local', 'Kampala legendary home of steamed matooke, peanut paste with smoked fish, beef, and local greens.', '2026-11-03 17:36:46', '2026-11-18 10:33:05', 'images/restaurants/2k-restaurant-nakasero-local-cuisine.webp', NULL),
  (130, 11, 'eat', 'Cafe Javas Oasis Mall', 38000, 'meal', 'Modern Casual', 'Top-tier casual dining hub in central Kampala famous for loaded burgers, milkshakes, and breakfasts.', '2026-11-03 17:36:46', '2026-11-18 09:06:26', 'images/restaurants/cafe-javas-oasis-mall.webp', 'https://cafejavas.co.ug'),
  (131, 11, 'eat', 'Fang Fang Chinese Restaurant', 48000, 'meal', 'Asian Dining', 'Long-standing upscale Chinese culinary institution serving authentic sizzling platters and dim sum in Nakasero.', '2026-11-03 17:36:46', '2026-11-18 10:33:05', 'images/restaurants/fang-fang-chinese-restaurant.webp', NULL),
  (132, 11, 'eat', 'The Lawns Wild Game & Grill Kololo', 65000, 'meal', 'Steakhouse', 'Fine dining garden restaurant on Kololo hill serving cuts of steak, wild game meats, and fine wines.', '2026-11-03 17:36:46', '2026-11-18 09:06:26', 'images/restaurants/the-lawns-wild-game-grill-kololo.webp', 'https://thelawns.co.ug'),
  (133, 11, 'recreation', 'Ndere Cultural Centre Troupe Night Show', 60000, 'entry', 'Cultural Theater', 'World-renowned high-energy folklore dance performance showcasing music and dance from all 50+ Ugandan tribes.', '2026-11-03 17:36:46', '2026-11-18 09:06:26', 'images/recreation-centres/ndere-cultural-centre-troupe-night-show.webp', 'https://ndere.com'),
  (134, 11, 'recreation', 'Kampala Rolex & Street Food Walking Safari', 50000, 'entry', 'Culinary Tour', 'Guided street food walk through lively student and market districts tasting hot Rolex, samosas, and sugar cane juice.', '2026-11-03 17:36:46', '2026-11-18 10:33:05', 'images/recreation-centres/kampala-rolex-street-food-walking-safari.webp', NULL),
  (135, 11, 'recreation', 'Uganda National Theatre Performing Arts', 35000, 'entry', 'Live Theater', 'The hub of Ugandan performing arts, hosting live drama, musical concerts, comedy nights, and craft markets.', '2026-11-03 17:36:46', '2026-11-18 10:33:05', 'images/recreation-centres/uganda-national-theatre-performing-arts.webp', NULL),
  (136, 11, 'visit', 'Kasubi Royal Tombs UNESCO World Heritage', 25000, 'entry', 'Historical Heritage', 'The spiritual heart of the Buganda Kingdom, housing the grand thatched royal mausoleum of four historic Kabakas.', '2026-11-03 17:36:46', '2026-11-18 10:33:05', 'images/destinations/kasubi-royal-tombs-unesco-world-heritage.webp', NULL),
  (137, 11, 'visit', 'Uganda National Museum Kira Road', 15000, 'entry', 'National Museum', 'Uganda oldest museum, showcasing ethnographical collections, hunting artifacts, and playable traditional instruments.', '2026-11-03 17:36:46', '2026-11-18 10:33:05', 'images/destinations/uganda-national-museum-kira-road.webp', NULL),
  (138, 11, 'visit', 'Gaddafi National Mosque Minaret Tower', 20000, 'entry', 'Architectural Landmark', 'The largest mosque in East Africa perched on Old Kampala Hill; climb the 304 steps of the minaret for 360-degree city views.', '2026-11-03 17:36:47', '2026-11-18 10:33:05', 'images/destinations/gaddafi-national-mosque-minaret-tower.webp', NULL),
  (139, 11, 'visit', 'Bahai Temple of Africa Gardens', 0, 'entry', 'Spiritual Sanctuary', 'The only Bahai Mother Temple on the African continent, set amid 52 acres of tranquil, beautifully landscaped hilltop gardens.', '2026-11-03 17:36:47', '2026-11-18 10:33:05', 'images/destinations/bahai-temple-of-africa-gardens.webp', NULL),
  (140, 12, 'eat', 'Kalangala Beach Camp Fish Fry', 25000, 'meal', 'Beach BBQ', 'Rustic beach cookout serving fresh whole grilled Nile tilapia and chips beside Lake Victoria bonfires.', '2026-11-03 17:36:47', '2026-11-18 10:33:05', 'images/restaurants/kalangala-beach-camp-fish-fry.webp', NULL),
  (141, 12, 'eat', 'Brovad Sands Lakeside Buffet', 50000, 'meal', 'Resort Dining', 'Sumptuous resort buffet featuring fresh lake catches, continental curries, salads, and island desserts.', '2026-11-03 17:36:47', '2026-11-18 10:33:05', 'images/restaurants/brovad-sands-lakeside-buffet.webp', NULL),
  (142, 12, 'eat', 'Victoria Forest Verandah Grill', 55000, 'meal', 'Island Bistro', 'Shaded verandah restaurant looking through palm trees to the beach, serving gourmet grilled specialties.', '2026-11-03 17:36:47', '2026-11-18 10:33:05', 'images/restaurants/victoria-forest-verandah-grill.webp', NULL),
  (143, 12, 'recreation', 'Ssese Island Quad Bike Trail Safari', 120000, 'entry', 'Off-road Trail', 'Exciting quad bike ride through red-dirt island tracks, palm oil estates, and scenic coastal lookouts.', '2026-11-03 17:36:47', '2026-11-18 10:33:06', 'images/recreation-centres/ssese-island-quad-bike-trail-safari.webp', NULL),
  (144, 12, 'recreation', 'Lake Victoria Nile Perch Sport Fishing', 180000, 'entry', 'Sport Fishing', 'Trophy sport fishing expedition targeting monster Nile perch in the deep waters of the archipelago.', '2026-11-03 17:36:47', '2026-11-18 10:33:06', 'images/recreation-centres/lake-victoria-nile-perch-sport-fishing.webp', NULL),
  (145, 12, 'recreation', 'Bugala Island Forest Monkey Walk', 35000, 'entry', 'Nature Trail', 'Guided nature stroll through primary island rainforest to spot vervet monkeys and colourful hornbills.', '2026-11-03 17:36:47', '2026-11-18 10:33:06', 'images/recreation-centres/bugala-island-forest-monkey-walk.webp', NULL),
  (146, 12, 'visit', 'Lutoboka Bay Pier & White Sands', 10000, 'entry', 'Sandy Beach', 'The main passenger ferry gateway on Bugala Island with broad white sand beaches and beachfront bars.', '2026-11-03 17:36:47', '2026-11-18 10:33:06', 'images/destinations/lutoboka-bay-pier-white-sands.webp', NULL),
  (147, 12, 'visit', 'Nanziri Sacred Falls & Cave Shrine', 25000, 'entry', 'Cultural Shrine', 'Sacred waterfall and ancient cave shrine venerated by locals as the dwelling place of traditional island spirits.', '2026-11-03 17:36:47', '2026-11-18 10:33:06', 'images/destinations/nanziri-sacred-falls-cave-shrine.webp', NULL),
  (148, 13, 'eat', 'Rwakobo Rock Sunset Diner', 35000, 'meal', 'Eco-Camp Dining', 'Granite kopje dining terrace offering panoramic savannah views, home-cooked roasts, and cold beers.', '2026-11-03 17:36:47', '2026-11-18 10:33:06', 'images/restaurants/rwakobo-rock-sunset-diner.webp', NULL),
  (149, 13, 'eat', 'Arcadia Cottages Lakeside Grill', 48000, 'meal', 'Lodge Dining', 'Peaceful lakefront restaurant serving grilled meat skewers, fresh salads, and soups inside the national park.', '2026-11-03 17:36:47', '2026-11-18 10:33:06', 'images/restaurants/arcadia-cottages-lakeside-grill.webp', NULL),
  (150, 13, 'eat', 'Mihingo Lodge Cliff Restaurant', 80000, 'meal', 'Fine Dining', 'Gourmet 3-course dining experience atop a high cliff overlooking a floodlit waterhole visited by wildlife.', '2026-11-03 17:36:47', '2026-11-18 10:33:06', 'images/restaurants/mihingo-lodge-cliff-restaurant.webp', NULL),
  (151, 13, 'recreation', 'Guided Savannah Walking Safari on Foot', 90000, 'entry', 'Walking Safari', 'Unrivaled on-foot walking safari with an armed ranger moving safely alongside herds of zebras, elands, and impalas.', '2026-11-03 17:36:47', '2026-11-18 10:33:06', 'images/recreation-centres/guided-savannah-walking-safari-on-foot.webp', NULL),
  (152, 13, 'recreation', 'Mihingo Horseback Wildlife Safari (2hr)', 350000, 'entry', 'Horse Riding', 'Peaceful horseback ride through the savannah; wild zebras and giraffes curiously approach horses without fear.', '2026-11-03 17:36:47', '2026-11-18 10:33:06', 'images/recreation-centres/mihingo-horseback-wildlife-safari-2hr.webp', NULL),
  (153, 13, 'recreation', 'Lake Mburo 2hr Motorboat Cruise', 110000, 'entry', 'Boat Cruise', 'UWA boat cruise around the shores of Lake Mburo observing basking hippos, giant crocodiles, and African fish eagles.', '2026-11-03 17:36:47', '2026-11-18 10:33:06', 'images/recreation-centres/lake-mburo-2hr-motorboat-cruise.webp', NULL),
  (154, 13, 'visit', 'Kazuma Hill Lookout Panoramic Deck', 20000, 'entry', 'Lookout Deck', 'The park highest viewpoint with wooden observation platforms showing 8 of Lake Mburo surrounding lakes.', '2026-11-03 17:36:47', '2026-11-18 10:33:06', 'images/destinations/kazuma-hill-lookout-panoramic-deck.webp', NULL),
  (155, 13, 'visit', 'Ankole Cultural Cattle Sanctuary', 30000, 'entry', 'Living Heritage', 'Traditional Bahima pastoralist cultural centre celebrating the regal, long-horned Ankole cattle and milk processing traditions.', '2026-11-03 17:36:47', '2026-11-18 10:33:06', 'images/destinations/ankole-cultural-cattle-sanctuary.webp', NULL);

-- --------------------------------------------------------
-- Table structure for table `listings`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `listings`;
CREATE TABLE `listings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `destination_id` bigint(20) unsigned DEFAULT NULL,
  `custom_location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price_ugx` int(11) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `image_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `listings_user_id_foreign` (`user_id`),
  KEY `listings_destination_id_foreign` (`destination_id`),
  CONSTRAINT `listings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `listings_destination_id_foreign` FOREIGN KEY (`destination_id`) REFERENCES `destinations` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table `listings` (4 records)
INSERT INTO `listings` (`id`, `user_id`, `type`, `name`, `destination_id`, `custom_location`, `price_ugx`, `description`, `website`, `contact`, `status`, `created_at`, `updated_at`, `image_path`) VALUES
  (1, 2, 'Recreation centre', 'Nile Canopy Adventure Hub', 1, NULL, 35000, 'A premier community adventure hub overlooking the Nile rapids featuring high ropes, river swings, and local craft sessions.', 'https://nilecanopyadventures.example.com', '+256 772 123456', 'approved', '2026-11-03 17:36:47', '2026-11-18 17:13:25', 'images/recreation-centres/Forest-park-resort-Buloba-1.webp'),
  (2, 2, 'Tourist site', 'Habuharo Island Cultural Sanctuary', 6, NULL, 25000, 'An authentic indigenous living museum on Habuharo island sharing centuries-old Bakiga folklore, herbal medicine walks, and drumming.', 'https://habuharosanctuary.example.ug', '+256 701 987654', 'approved', '2026-11-03 17:36:47', '2026-11-03 17:36:47', 'images/destinations/boat-cruise-elephants.webp'),
  (3, 2, 'Restaurant', 'Roots Cultural Kitchen & Grill', 11, NULL, 28000, 'Farm-to-table traditional Ugandan delicacies, Luwombo, matooke, and organic juices in a relaxing garden setting.', 'https://rootskitchen.example.ug', '+256 782 555666', 'approved', '2026-11-03 17:36:47', '2026-11-03 17:36:47', 'images/restaurants/ugandan-food-platter.webp'),
  (4, 2, 'Recreation centre', 'Kireka Hill Rock Climbers Park', NULL, 'Kireka, Wakiso', 20000, 'Bouldering and outdoor rock climbing spot for weekend fitness enthusiasts just outside Kampala.', 'https://kirekaclimbers.example.ug', '+256 752 444333', 'pending', '2026-11-03 17:36:47', '2026-11-18 17:13:25', 'images/recreation-centres/jinja-qaud-biking-1024x678-1.webp');

-- --------------------------------------------------------
-- Table structure for table `listing_activities`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `listing_activities`;
CREATE TABLE `listing_activities` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `listing_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fee_ugx` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `listing_activities_listing_id_foreign` (`listing_id`),
  CONSTRAINT `listing_activities_listing_id_foreign` FOREIGN KEY (`listing_id`) REFERENCES `listings` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table `listing_activities` (4 records)
INSERT INTO `listing_activities` (`id`, `listing_id`, `name`, `fee_ugx`, `created_at`, `updated_at`) VALUES
  (1, 1, 'High Ropes Challenge Course', 45000, '2026-11-03 17:36:47', '2026-11-03 17:36:47'),
  (2, 1, 'Nile River Rope Swing', 20000, '2026-11-03 17:36:47', '2026-11-03 17:36:47'),
  (3, 2, 'Traditional Drumming & Dance Session', 30000, '2026-11-03 17:36:47', '2026-11-03 17:36:47'),
  (4, 2, 'Herbal Medicine Forest Walk', 20000, '2026-11-03 17:36:47', '2026-11-03 17:36:47');

-- --------------------------------------------------------
-- Table structure for table `saved_trips`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `saved_trips`;
CREATE TABLE `saved_trips` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `session_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `destination_id` bigint(20) unsigned NOT NULL,
  `days` int(11) NOT NULL DEFAULT 3,
  `style` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Moderate',
  `total_ugx` int(11) NOT NULL,
  `details` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `saved_trips_destination_id_foreign` (`destination_id`),
  CONSTRAINT `saved_trips_destination_id_foreign` FOREIGN KEY (`destination_id`) REFERENCES `destinations` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for table `contact_messages`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `contact_messages`;
CREATE TABLE `contact_messages` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table `contact_messages` (4 records)
INSERT INTO `contact_messages` (`id`, `name`, `email`, `subject`, `message`, `created_at`, `updated_at`) VALUES
  (1, 'natukunda raynel', 'natukundaraynel@gmail.com', 'jussssst', 'help me', '2026-11-18 19:45:24', '2026-11-18 19:45:24'),
  (2, 'natukunda raynel', 'natukundaraynel@gmail.com', 'jussssst', 'help me', '2026-11-18 20:01:31', '2026-11-18 20:01:31'),
  (3, 'Raynel-dotcom\'s Org', 'natukundaraynel@gmail.com', 'jussssst', 'help me', '2026-11-18 20:33:42', '2026-11-18 20:33:42'),
  (4, 'natukunda raynel', 'natukundaraynel@gmail.com', 'jussssst', 'help me', '2026-11-20 14:24:10', '2026-11-20 14:24:10');

-- --------------------------------------------------------
-- Table structure for table `hero_slides`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `hero_slides`;
CREATE TABLE `hero_slides` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `image_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subtitle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '/destinations',
  `order` int(11) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table `hero_slides` (5 records)
INSERT INTO `hero_slides` (`id`, `image_path`, `title`, `subtitle`, `link`, `order`, `is_active`, `created_at`, `updated_at`) VALUES
  (1, 'images/hero/hero-gorilla.webp', 'Discover Uganda. / Feel Alive.', 'From mist-covered mountains and breathtaking wildlife to hidden lakes and unforgettable adventures.', '/destinations', 1, 1, '2026-11-18 13:28:19', '2026-11-18 13:28:19'),
  (2, 'images/hero/hero-falls.webp', 'Murchison Falls. / Untamed Power.', 'Witness the world\'s most powerful waterfall where the Nile crashes through a 7-meter gorge.', '/destinations/murchison-falls', 2, 1, '2026-11-18 13:28:19', '2026-11-18 13:28:19'),
  (3, 'images/hero/hero-bunyonyi.webp', 'Lake Bunyonyi. / Sacred Tranquility.', 'Glide across 29 emerald islands enveloped by the terraced hills of southwestern Uganda.', '/destinations/lake-bunyonyi', 3, 1, '2026-11-18 13:28:19', '2026-11-18 13:28:19'),
  (4, 'images/hero/hero-savanna.webp', 'Golden Savannah. / Endless Horizons.', 'Experience untamed wildlife under breathtaking African sunsets across vast wilderness expanses.', '/destinations/kidepo-valley', 4, 1, '2026-11-18 19:24:49', '2026-11-18 19:24:49'),
  (5, 'images/hero/hero-sipi.webp', 'Sipi Falls. / Majestic Cascades.', 'Trek the legendary triple waterfalls on the lush slopes of volcanic Mount Elgon.', '/destinations/sipi-falls', 5, 1, '2026-11-18 19:24:49', '2026-11-18 19:24:49');

COMMIT;
SET FOREIGN_KEY_CHECKS=1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;