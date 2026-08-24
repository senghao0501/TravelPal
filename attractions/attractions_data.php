<?php



$attraction_regions = [
    'johor' => [
        'name' => 'Johor',
        'city' => 'Johor Bahru',
        'label' => 'Johor · Johor Bahru',
        'query' => 'Johor Bahru, Johor, Malaysia'
    ],
    'melaka' => [
        'name' => 'Melaka',
        'city' => 'Melaka',
        'label' => 'Melaka',
        'query' => 'Melaka, Malaysia'
    ],
    'selangor' => [
        'name' => 'Selangor',
        'city' => 'Selangor',
        'label' => 'Selangor',
        'query' => 'Selangor, Malaysia'
    ],
    'perak' => [
        'name' => 'Perak',
        'city' => 'Ipoh',
        'label' => 'Perak · Ipoh',
        'query' => 'Ipoh, Perak, Malaysia'
    ],
    'penang' => [
        'name' => 'Penang',
        'city' => 'George Town',
        'label' => 'Penang',
        'query' => 'Penang, Malaysia'
    ],
    'pahang' => [
        'name' => 'Pahang',
        'city' => 'Pahang',
        'label' => 'Pahang',
        'query' => 'Pahang, Malaysia'
    ],
    'sabah' => [
        'name' => 'Sabah',
        'city' => 'Kota Kinabalu',
        'label' => 'Sabah',
        'query' => 'Kota Kinabalu, Sabah, Malaysia'
    ],
    'sarawak' => [
        'name' => 'Sarawak',
        'city' => 'Kuching',
        'label' => 'Sarawak',
        'query' => 'Kuching, Sarawak, Malaysia'
    ]
];


$featured_attractions_by_region = [
    'johor' => [
        [
            'id' => 'johor-legoland-malaysia',
            'name' => 'LEGOLAND Malaysia Resort',
            'type' => 'Theme Parks',
            'price' => 'From RM 199',
            'rating' => 4.6,
            'review_count' => 12840,
            'image' => '/TravelPal/images/attractions_image/legoland.jpg',
            'description' => 'Malaysia’s first international theme park combines LEGO-inspired rides, a water park and SEA LIFE exhibits in Iskandar Puteri.',
            'activities' => [
                'Explore LEGO-themed rides and family zones',
                'Cool down at LEGOLAND Water Park',
                'Discover marine life at SEA LIFE Malaysia',
                'Meet LEGO characters and enjoy live shows'
            ],
            'hours' => 'Opening hours vary according to the selected date',
            'duration' => 'Full day',
            'best_for' => 'Families and theme-park fans'
        ],
        [
            'id' => 'johor-sultan-abu-bakar-mosque',
            'name' => 'Sultan Abu Bakar State Mosque',
            'type' => 'Heritage & Culture',
            'price' => 'Free',
            'rating' => 4.7,
            'review_count' => 2180,
            'image' => '/TravelPal/images/attractions_image/sultanAbuBakarJohorBahru.jpg',
            'description' => 'A landmark mosque overlooking the Straits of Johor that blends Victorian details with Moorish architecture.',
            'activities' => [
                'Admire the Victorian-Moorish architecture',
                'Walk around the landscaped grounds',
                'Enjoy views towards the Johor Strait',
                'Learn about Johor’s royal heritage'
            ],
            'hours' => 'Visit outside prayer times; modest attire is required',
            'duration' => '1–2 hours',
            'best_for' => 'Architecture, culture and photography'
        ]
    ],

    'melaka' => [
        [
            'id' => 'melaka-a-famosa',
            'name' => 'A Famosa Fort',
            'type' => 'Heritage & Culture',
            'price' => 'Free',
            'rating' => 4.5,
            'review_count' => 9620,
            'image' => '/TravelPal/images/attractions_image/AFamosa.jpg',
            'description' => 'Porta de Santiago is the surviving gateway of the Portuguese A Famosa fortress and one of Melaka’s most recognisable landmarks.',
            'activities' => [
                'See the surviving Portuguese gateway',
                'Walk to nearby St. Paul’s Hill',
                'Explore the surrounding heritage district',
                'Photograph the colonial landmarks'
            ],
            'hours' => 'Open public area; best visited during daylight',
            'duration' => '1–2 hours',
            'best_for' => 'History and heritage walking tours'
        ],
        [
            'id' => 'melaka-river-cruise',
            'name' => 'Melaka River Cruise',
            'type' => 'Heritage & Culture',
            'price' => 'From RM 25',
            'rating' => 4.4,
            'review_count' => 7850,
            'image' => '/TravelPal/images/attractions_image/MelakaRiverCruise.webp',
            'description' => 'A relaxing river journey through historic Melaka, passing colourful murals, bridges, old shophouses and riverside cafés.',
            'activities' => [
                'Cruise through central Melaka',
                'See riverside murals and heritage buildings',
                'Enjoy illuminated views after sunset',
                'Combine the visit with Jonker Street'
            ],
            'hours' => 'Usually operates daily; schedules may change',
            'duration' => 'About 45 minutes',
            'best_for' => 'Couples, families and first-time visitors'
        ]
    ],

    'selangor' => [
        [
            'id' => 'selangor-batu-caves',
            'name' => 'Batu Caves',
            'type' => 'Heritage & Culture',
            'price' => 'Free',
            'rating' => 4.7,
            'review_count' => 34200,
            'image' => '/TravelPal/images/attractions_image/BatuCaves.jpg',
            'description' => 'A dramatic limestone hill and Hindu temple complex famous for its giant Lord Murugan statue and 272 colourful steps.',
            'activities' => [
                'Climb the 272 colourful steps',
                'Visit the main Temple Cave',
                'See the giant Lord Murugan statue',
                'Observe the limestone formations'
            ],
            'hours' => 'Daily from early morning until evening',
            'duration' => '2–3 hours',
            'best_for' => 'Culture, photography and active sightseeing'
        ],
        [
            'id' => 'selangor-sunway-lagoon',
            'name' => 'Sunway Lagoon',
            'type' => 'Theme Parks',
            'price' => 'From RM 213',
            'rating' => 4.6,
            'review_count' => 19870,
            'image' => '/TravelPal/images/attractions_image/SunwayLagoon.jpg',
            'description' => 'A large multi-zone theme park with water attractions, thrill rides, wildlife encounters and family entertainment.',
            'activities' => [
                'Try the water slides and wave pools',
                'Ride amusement-park attractions',
                'Visit the wildlife zone',
                'Watch seasonal shows and events'
            ],
            'hours' => 'Usually Wednesday–Monday; check the selected date',
            'duration' => 'Full day',
            'best_for' => 'Families, groups and thrill seekers'
        ]
    ],

    'perak' => [
        [
            'id' => 'perak-lost-world-tambun',
            'name' => 'Lost World of Tambun',
            'type' => 'Theme Parks',
            'price' => 'From RM 117',
            'rating' => 4.5,
            'review_count' => 11250,
            'image' => '/TravelPal/images/attractions_image/LostWorldofTambun.jpg',
            'description' => 'Surrounded by Ipoh’s limestone hills, this family destination combines a water park, rides, animals and hot springs.',
            'activities' => [
                'Enjoy water-park attractions',
                'Relax in the hot springs at night',
                'Visit the animal and adventure zones',
                'Enjoy the surrounding limestone scenery'
            ],
            'hours' => 'Operating days and night-park hours vary',
            'duration' => 'Half day to full day',
            'best_for' => 'Families and water-park fans'
        ],
        [
            'id' => 'perak-kellies-castle',
            'name' => "Kellie's Castle",
            'type' => 'Heritage & Culture',
            'price' => 'From RM 5',
            'rating' => 4.3,
            'review_count' => 6450,
            'image' => "/TravelPal/images/attractions_image/Kellie'sCastle.jpg",
            'description' => 'An unfinished early-20th-century mansion near Batu Gajah, known for its corridors, rooftop views and mysterious stories.',
            'activities' => [
                'Explore the unfinished mansion',
                'Read about William Kellie Smith',
                'Climb to the rooftop viewpoint',
                'Photograph the historic architecture'
            ],
            'hours' => 'Daily during daytime hours',
            'duration' => '1–2 hours',
            'best_for' => 'History, architecture and photography'
        ]
    ],

    'penang' => [
        [
            'id' => 'penang-hill',
            'name' => 'Penang Hill',
            'type' => 'Nature & Wildlife',
            'price' => 'From RM 30',
            'rating' => 4.6,
            'review_count' => 24800,
            'image' => '/TravelPal/images/attractions_image/PenangHill.jpg',
            'description' => 'Ride the funicular railway into cooler hilltop air for panoramic views, forest walks and heritage buildings.',
            'activities' => [
                'Ride the funicular railway',
                'Enjoy panoramic island views',
                'Walk nature and heritage trails',
                'Visit hilltop viewpoints and cafés'
            ],
            'hours' => 'Daily; funicular schedules may vary',
            'duration' => '3–5 hours',
            'best_for' => 'Nature, views and relaxed exploration'
        ],
        [
            'id' => 'penang-kek-lok-si',
            'name' => 'Kek Lok Si Temple',
            'type' => 'Heritage & Culture',
            'price' => 'Free',
            'rating' => 4.7,
            'review_count' => 13700,
            'image' => '/TravelPal/images/attractions_image/KekLokSiTemple.webp',
            'description' => 'One of Southeast Asia’s largest Buddhist temple complexes, featuring prayer halls, gardens, a pagoda and a Guanyin statue.',
            'activities' => [
                'Explore the temple halls and gardens',
                'See the Pagoda of Ten Thousand Buddhas',
                'Visit the Guanyin statue',
                'Enjoy views across Air Itam'
            ],
            'hours' => 'Daily during daytime hours',
            'duration' => '2–3 hours',
            'best_for' => 'Culture, architecture and photography'
        ]
    ],

    'pahang' => [
        [
            'id' => 'pahang-genting-skyworlds',
            'name' => 'Genting SkyWorlds Theme Park',
            'type' => 'Theme Parks',
            'price' => 'From RM 151',
            'rating' => 4.5,
            'review_count' => 9650,
            'image' => '/TravelPal/images/attractions_image/GentingSkyWorldsThemePark.png',
            'description' => 'A highland outdoor theme park with cinematic worlds, family attractions and thrill rides in Genting Highlands.',
            'activities' => [
                'Explore themed cinematic worlds',
                'Ride family and thrill attractions',
                'Enjoy the cool highland weather',
                'Use the park app to plan ride times'
            ],
            'hours' => 'Operating calendar varies; advance booking is recommended',
            'duration' => 'Full day',
            'best_for' => 'Families, groups and theme-park fans'
        ],
        [
            'id' => 'pahang-taman-negara',
            'name' => 'Taman Negara National Park',
            'type' => 'Nature & Wildlife',
            'price' => 'From RM 1',
            'rating' => 4.7,
            'review_count' => 5820,
            'image' => '/TravelPal/images/attractions_image/TamanNegaraNationalPark.jpg',
            'description' => 'Malaysia’s premier rainforest destination offers jungle trails, river journeys, wildlife and canopy-level views.',
            'activities' => [
                'Walk rainforest trails',
                'Experience the canopy walkway when open',
                'Take a riverboat journey',
                'Join a guided nature or night walk'
            ],
            'hours' => 'Park access daily; activities depend on weather',
            'duration' => '1–3 days recommended',
            'best_for' => 'Nature lovers, hikers and adventure travellers'
        ]
    ],

    'sabah' => [
        [
            'id' => 'sabah-kinabalu-park',
            'name' => 'Kinabalu Park',
            'type' => 'Nature & Wildlife',
            'price' => 'From RM 15',
            'rating' => 4.8,
            'review_count' => 8940,
            'image' => '/TravelPal/images/attractions_image/KinabaluPark.jpg',
            'description' => 'A UNESCO-listed mountain park with exceptional biodiversity, forest trails and dramatic views of Mount Kinabalu.',
            'activities' => [
                'Walk botanical and forest trails',
                'Visit mountain viewpoints',
                'Learn about Sabah’s biodiversity',
                'Plan a permitted Mount Kinabalu climb'
            ],
            'hours' => 'Daily; climbing requires advance permits',
            'duration' => 'Half day to 2 days',
            'best_for' => 'Hikers, nature lovers and photographers'
        ],
        [
            'id' => 'sabah-sepilok-orangutan',
            'name' => 'Sepilok Orangutan Rehabilitation Centre',
            'type' => 'Nature & Wildlife',
            'price' => 'From RM 30',
            'rating' => 4.7,
            'review_count' => 7360,
            'image' => '/TravelPal/images/attractions_image/SepilokOrangutanRehabilitationCentre.jpg',
            'description' => 'A respected rehabilitation centre where visitors can learn about orangutan conservation in protected rainforest.',
            'activities' => [
                'Attend scheduled feeding sessions',
                'Walk along rainforest boardwalks',
                'Visit the nursery viewing area',
                'Learn about orangutan conservation'
            ],
            'hours' => 'Daily with scheduled viewing and feeding sessions',
            'duration' => '2–3 hours',
            'best_for' => 'Wildlife lovers and families'
        ]
    ],

    'sarawak' => [
        [
            'id' => 'sarawak-bako-national-park',
            'name' => 'Bako National Park',
            'type' => 'Nature & Wildlife',
            'price' => 'From RM 20',
            'rating' => 4.7,
            'review_count' => 5260,
            'image' => '/TravelPal/images/attractions_image/BakoNationalPark.jpg',
            'description' => 'Sarawak’s oldest national park contains rainforest trails, coastal cliffs, beaches and proboscis monkey habitat.',
            'activities' => [
                'Hike marked rainforest trails',
                'Look for proboscis monkeys',
                'See coastal rock formations',
                'Travel by boat from Bako village'
            ],
            'hours' => 'Daily, subject to boat and weather conditions',
            'duration' => 'Full day or overnight',
            'best_for' => 'Hiking, wildlife and coastal scenery'
        ],
        [
            'id' => 'sarawak-cultural-village',
            'name' => 'Sarawak Cultural Village',
            'type' => 'Heritage & Culture',
            'price' => 'From RM 60',
            'rating' => 4.6,
            'review_count' => 6870,
            'image' => '/TravelPal/images/attractions_image/SarawakCulturalVillage.jpg',
            'description' => 'A living cultural museum presenting the traditional homes, crafts, music and customs of Sarawak’s communities.',
            'activities' => [
                'Enter traditional community houses',
                'Watch a cultural performance',
                'Meet local craft demonstrators',
                'Learn about Sarawak’s diverse peoples'
            ],
            'hours' => 'Daily; cultural performance times are scheduled',
            'duration' => '3–4 hours',
            'best_for' => 'Culture, families and first-time visitors'
        ]
    ]
];

function getLocalFeaturedAttractions(): array
{
    global $featured_attractions_by_region, $attraction_regions;

    $items = [];

    foreach ($featured_attractions_by_region as $regionKey => $attractions) {
        if (!isset($attraction_regions[$regionKey])) {
            continue;
        }

        $region = $attraction_regions[$regionKey];

        foreach ($attractions as $attraction) {
            $attraction['region_key'] = $regionKey;
            $attraction['state'] = $region['name'];
            $attraction['city'] = $region['city'];
            $attraction['location'] = $region['label'];
            $attraction['query'] = $region['query'];
            $attraction['source'] = 'local';
            $attraction['slug'] = null;
            $items[] = $attraction;
        }
    }

    return $items;
}

function getLocalAttractionsForRegion(string $regionKey): array
{
    return array_values(array_filter(
        getLocalFeaturedAttractions(),
        static fn(array $item): bool =>
            ($item['region_key'] ?? '') === $regionKey
    ));
}

function findLocalAttractionById(string $id): ?array
{
    foreach (getLocalFeaturedAttractions() as $attraction) {
        if (($attraction['id'] ?? '') === $id) {
            return $attraction;
        }
    }

    return null;
}
