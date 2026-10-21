<?php

return [
    'origins' => [
        'Kampala' => ['lat' => 0.35, 'lon' => 32.58],
        'Entebbe' => ['lat' => 0.06, 'lon' => 32.46],
        'Jinja'   => ['lat' => 0.43, 'lon' => 33.20],
        'Mbale'   => ['lat' => 1.08, 'lon' => 34.17],
        'Mbarara' => ['lat' => -0.61, 'lon' => 30.65],
        'Other'   => ['lat' => 0.35, 'lon' => 32.58], // defaults to Kampala
    ],

    'time_options' => [
        '1 day'    => 1,
        'Weekend'  => 2,
        '3 days'   => 3,
        '5 days'   => 5,
        '7+ days'  => 7,
    ],

    'style_multipliers' => [
        'Budget' => [
            'transport'  => 1.0,
            'food'       => 0.6,
            'activities' => 0.8,
        ],
        'Moderate' => [
            'transport'  => 1.5,
            'food'       => 1.0,
            'activities' => 1.0,
        ],
        'Luxury' => [
            'transport'  => 3.0,
            'food'       => 2.0,
            'activities' => 1.3,
        ],
    ],

    'interests' => [
        'Wildlife',
        'Adventure',
        'Nature',
        'Beaches/Lakes',
        'Hiking',
        'Culture',
        'History',
        'Food',
        'Photography',
        'Relaxation',
        'Nightlife',
    ],

    'groups' => [
        'Solo',
        'Couple',
        'Family',
        'Friends',
        'Group',
    ],

    'styles' => [
        'Budget',
        'Moderate',
        'Luxury',
    ],

    'preferences' => [
        'Relaxing',
        'Adventurous',
        'Educational',
        'Romantic',
        'Family-friendly',
        'Social',
    ],

    'regions' => [
        'Central',
        'East',
        'North',
        'West',
        'Southwest',
    ],

    'listing_types' => [
        'Hotel',
        'Lodge',
        'Hostel',
        'Restaurant',
        'Tourist site',
        'Recreation centre',
    ],
];
