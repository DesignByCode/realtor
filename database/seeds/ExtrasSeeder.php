<?php


use Designbycode\Tagger\Models\Tag;
use Illuminate\Database\Seeder;

class ExtrasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = [
            [
                'name' => 'Balcony',
                'slug' => 'balcony'
            ],
            [
                'name' => 'Enterance Hall',
                'slug' => 'enterance-hall'
            ],
            [
                'name' => 'Family/TV Room',
                'slug' => 'family-tv-room'
            ],
            [
                'name' => 'Flalet',
                'slug' => 'flalet'
            ],
            [
                'name' => 'Garden Cottage',
                'slug' => 'garden-cottage'
            ],
            [
                'name' => 'Guest Toilet',
                'slug' => 'guest-toilet'
            ],
            [
                'name' => 'Kitchen',
                'slug' => 'kitchen'
            ],
            [
                'name' => 'Pantry',
                'slug' => 'pantry'
            ],
            [
                'name' => 'Scullery',
                'slug' => 'scullery'
            ],
            [
                'name' => 'Staff Quarters',
                'slug' => 'staff-quarters'
            ],
            [
                'name' => 'Study',
                'slug' => 'study'
            ],
            [
                'name' => 'Access Gate',
                'slug' => 'access-gate'
            ],
            [
                'name' => 'Alarm',
                'slug' => 'alarm'
            ],
            [
                'name' => 'Electric Fencing',
                'slug' => 'electric-fencing'
            ],
            [
                'name' => 'Fence',
                'slug' => 'fence'
            ],
            [
                'name' => 'Intercom',
                'slug' => 'intercom'
            ],
            [
                'name' => 'Security Post',
                'slug' => 'security-post'
            ],
            [
                'name' => 'Clubhouse',
                'slug' => 'clubhouse'
            ],
            [
                'name' => 'Golf',
                'slug' => 'golf'
            ],
            [
                'name' => 'Gym',
                'slug' => 'gym'
            ],
            [
                'name' => 'Handicap Avalible',
                'slug' => 'handicap-avalible'
            ],
            [
                'name' => 'Spa Bath',
                'slug' => 'spa-bath'
            ],
            [
                'name' => 'Pet Friendly',
                'slug' => 'pet-friendly'
            ],
            [
                'name' => 'Squash Court',
                'slug' => 'squash-court'
            ],
            [
                'name' => 'Tennis Court',
                'slug' => 'tennis-court'
            ],
            [
                'name' => 'Aircon',
                'slug' => 'aircon'
            ],
            [
                'name' => 'Borehole',
                'slug' => 'borehole'
            ],
            [
                'name' => 'Built-in-Braai',
                'slug' => 'built-in-braai'
            ],
            [
                'name' => 'Built-in Cupboards',
                'slug' => 'built-in-cupboards'
            ],
            [
                'name' => 'Deck',
                'slug' => 'deck'
            ],
            [
                'name' => 'Fireplace',
                'slug' => 'fireplace'
            ],
            [
                'name' => 'Furnished',
                'slug' => 'furnished'
            ],
            [
                'name' => 'Garden',
                'slug' => 'garden'
            ],
            [
                'name' => 'Irragation System',
                'slug' => 'irragation-system'
            ],
            [
                'name' => 'Lapa',
                'slug' => 'lapa'
            ],
            [
                'name' => 'Patio',
                'slug' => 'patio'
            ],
            [
                'name' => 'Pool',
                'slug' => 'pool'
            ],
            [
                'name' => 'Satelite',
                'slug' => 'satelite'
            ],
            [
                'name' => 'Scenic View',
                'slug' => 'scenic-view'
            ],
            [
                'name' => 'Ocean View',
                'slug' => 'ocean-view'
            ],
            [
                'name' => 'TV',
                'slug' => 'tv'
            ],
            [
                'name' => 'Walk-in Closet',
                'slug' => 'walk-in-closet'
            ]

        ];

        Tag::insert($tags);

    }
}
