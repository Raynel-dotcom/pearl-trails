<?php

return [
    'default' => 'UGX',
    'supported' => ['UGX', 'USD', 'EUR', 'GBP'],
    
    // Approximate rates: UGX per 1 unit of foreign currency
    'rates' => [
        'UGX' => 1,
        'USD' => 3650,
        'EUR' => 4200,
        'GBP' => 4900,
    ],

    'symbols' => [
        'UGX' => 'UGX ',
        'USD' => '$',
        'EUR' => '€',
        'GBP' => '£',
    ],

    // Budget bands per currency
    'bands' => [
        'UGX' => [
            ['id' => '100k', 'label' => 'Under 100,000', 'min' => 0, 'max' => 100000],
            ['id' => '300k', 'label' => '100,000 to 300,000', 'min' => 100000, 'max' => 300000],
            ['id' => '500k', 'label' => '300,000 to 500,000', 'min' => 300000, 'max' => 500000],
            ['id' => '1m',   'label' => '500,000 to 1,000,000', 'min' => 500000, 'max' => 1000000],
            ['id' => 'above','label' => 'Above 1,000,000', 'min' => 1000000, 'max' => 3000000], // limit 3,000 units equivalent
        ],
        'USD' => [
            ['id' => '100',  'label' => 'Under $100', 'min' => 0, 'max' => 100],
            ['id' => '250',  'label' => '$100 to $250', 'min' => 100, 'max' => 250],
            ['id' => '500',  'label' => '$250 to $500', 'min' => 250, 'max' => 500],
            ['id' => '1000', 'label' => '$500 to $1,000', 'min' => 500, 'max' => 1000],
            ['id' => 'above','label' => 'Above $1,000', 'min' => 1000, 'max' => 3000],
        ],
        'EUR' => [
            ['id' => '100',  'label' => 'Under €100', 'min' => 0, 'max' => 100],
            ['id' => '250',  'label' => '€100 to €250', 'min' => 100, 'max' => 250],
            ['id' => '500',  'label' => '€250 to €500', 'min' => 250, 'max' => 500],
            ['id' => '1000', 'label' => '€500 to €1,000', 'min' => 500, 'max' => 1000],
            ['id' => 'above','label' => 'Above €1,000', 'min' => 1000, 'max' => 3000],
        ],
        'GBP' => [
            ['id' => '100',  'label' => 'Under £100', 'min' => 0, 'max' => 100],
            ['id' => '250',  'label' => '£100 to £250', 'min' => 100, 'max' => 250],
            ['id' => '500',  'label' => '£250 to £500', 'min' => 250, 'max' => 500],
            ['id' => '1000', 'label' => '£500 to £1,000', 'min' => 500, 'max' => 1000],
            ['id' => 'above','label' => 'Above £1,000', 'min' => 1000, 'max' => 3000],
        ],
    ],
];
