<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Party;

class PartySeeder extends Seeder
{
    public function run(): void
    {
        Party::create([
            'title' => 'Techno večer v Channel Zero',
            'description' => 'Underground techno noč na Metelkovi z lokalnimi DJ-i in deep techno seti do jutra.',
            'location' => 'Channel Zero, Metelkova, Ljubljana',
            'date_time' => '2026-07-15 21:00:00',
            'category' => 'TEHNOLOŠKA',
            'image' => 'https://images.unsplash.com/photo-1506157786151-b8491531f063?auto=format&fit=crop&w=1200&q=70',
            'user_id' => 1,
        ]);

        Party::create([
            'title' => 'Poletni rooftop večer na Nebotičniku',
            'description' => 'Sproščen poletni večer z DJ glasbo, koktejli in razgledom na Ljubljano ob sončnem zahodu.',
            'location' => 'Nebotičnik Rooftop Bar, Ljubljana',
            'date_time' => '2026-07-16 17:00:00',
            'category' => 'RELAX',
            'image' => 'https://images.unsplash.com/photo-1520975958225-3f61d39a4a46?auto=format&fit=crop&w=1200&q=70',
            'user_id' => 1,
        ]);

        Party::create([
            'title' => 'Študentski večer v klubu K4',
            'description' => 'Ena najbolj znanih študentskih zabav v Ljubljani z elektronsko glasbo in polnim klubom do jutra.',
            'location' => 'Klub K4, Ljubljana',
            'date_time' => '2026-07-16 22:30:00',
            'category' => 'ZABAVA',
            'image' => 'https://images.unsplash.com/photo-1516450360452-9312f5e86fc7?auto=format&fit=crop&w=1200&q=70',
            'user_id' => 1,
        ]);

        Party::create([
            'title' => 'Poletni koncert v Kinu Šiška',
            'description' => 'Live koncertni večer z več slovenskimi in regionalnimi bendi na poletnem odru.',
            'location' => 'Kino Šiška, Ljubljana',
            'date_time' => '2026-07-17 20:00:00',
            'category' => 'KONCERT',
            'image' => 'https://images.unsplash.com/photo-1459749411175-04bf5292ceea?auto=format&fit=crop&w=1200&q=70',
            'user_id' => 1,
        ]);

        Party::create([
            'title' => 'Chill večer ob Ljubljanici',
            'description' => 'Sproščeno druženje ob reki z glasbo, street food ponudbo in poletnim vzdušjem.',
            'location' => 'Špica, Ljubljana',
            'date_time' => '2026-07-18 19:00:00',
            'category' => 'RELAX',
            'image' => 'https://images.unsplash.com/photo-1470225620780-dba8ba36b745?auto=format&fit=crop&w=1200&q=70',
            'user_id' => 1,
        ]);

        Party::create([
            'title' => 'Rave noč v Mariboru',
            'description' => 'Tehno rave v industrijskem prostoru z močnim sound systemom in svetlobnim showom.',
            'location' => 'Tkalski prehod, Maribor',
            'date_time' => '2026-07-19 23:00:00',
            'category' => 'TEHNOLOŠKA',
            'image' => 'https://images.unsplash.com/photo-1533174072545-7a4b6ad7a6c3?auto=format&fit=crop&w=1200&q=70',
            'user_id' => 1,
        ]);
    }
}