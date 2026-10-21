<?php

namespace Database\Seeders;

use App\Models\Destination;
use App\Models\Listing;
use App\Models\ListingActivity;
use App\Models\User;
use Illuminate\Database\Seeder;

class ListingSeeder extends Seeder
{
    public function run(): void
    {
        $vendor = User::where('email', 'vendor@exploreuganda.test')->first() ?? User::first();
        if (!$vendor) return;

        $jinja = Destination::where('slug', 'jinja')->first();
        $kampala = Destination::where('slug', 'kampala')->first();
        $bunyonyi = Destination::where('slug', 'lake-bunyonyi')->first();

        // Approved Recreation Centre listing in Jinja
        $l1 = Listing::updateOrCreate(
            ['name' => 'Nile Canopy Adventure Hub', 'user_id' => $vendor->id],
            [
                'type' => 'Recreation centre',
                'destination_id' => $jinja?->id,
                'custom_location' => null,
                'price_ugx' => 35000, // base entry
                'description' => 'A premier community adventure hub overlooking the Nile rapids featuring high ropes, river swings, and local craft sessions.',
                'website' => 'https://nilecanopyadventures.example.com',
                'contact' => '+256 772 123456',
                'status' => 'approved',
            ]
        );

        ListingActivity::updateOrCreate(
            ['listing_id' => $l1->id, 'name' => 'High Ropes Challenge Course'],
            ['fee_ugx' => 45000]
        );
        ListingActivity::updateOrCreate(
            ['listing_id' => $l1->id, 'name' => 'Nile River Rope Swing'],
            ['fee_ugx' => 20000]
        );

        // Approved Tourist Site in Bunyonyi
        $l2 = Listing::updateOrCreate(
            ['name' => 'Habuharo Island Cultural Sanctuary', 'user_id' => $vendor->id],
            [
                'type' => 'Tourist site',
                'destination_id' => $bunyonyi?->id,
                'custom_location' => null,
                'price_ugx' => 25000,
                'description' => 'An authentic indigenous living museum on Habuharo island sharing centuries-old Bakiga folklore, herbal medicine walks, and drumming.',
                'website' => 'https://habuharosanctuary.example.ug',
                'contact' => '+256 701 987654',
                'status' => 'approved',
            ]
        );

        ListingActivity::updateOrCreate(
            ['listing_id' => $l2->id, 'name' => 'Traditional Drumming & Dance Session'],
            ['fee_ugx' => 30000]
        );
        ListingActivity::updateOrCreate(
            ['listing_id' => $l2->id, 'name' => 'Herbal Medicine Forest Walk'],
            ['fee_ugx' => 20000]
        );

        // Approved Restaurant in Kampala
        $l3 = Listing::updateOrCreate(
            ['name' => 'Roots Cultural Kitchen & Grill', 'user_id' => $vendor->id],
            [
                'type' => 'Restaurant',
                'destination_id' => $kampala?->id,
                'custom_location' => null,
                'price_ugx' => 28000,
                'description' => 'Farm-to-table traditional Ugandan delicacies, Luwombo, matooke, and organic juices in a relaxing garden setting.',
                'website' => 'https://rootskitchen.example.ug',
                'contact' => '+256 782 555666',
                'status' => 'approved',
            ]
        );

        // Pending submission in custom location (e.g. Yumbe or Kireka)
        Listing::updateOrCreate(
            ['name' => 'Kireka Hill Rock Climbers Park', 'user_id' => $vendor->id],
            [
                'type' => 'Recreation centre',
                'destination_id' => null,
                'custom_location' => 'Kireka, Wakiso',
                'price_ugx' => 20000,
                'description' => 'Bouldering and outdoor rock climbing spot for weekend fitness enthusiasts just outside Kampala.',
                'website' => 'https://kirekaclimbers.example.ug',
                'contact' => '+256 752 444333',
                'status' => 'pending',
            ]
        );
    }
}
