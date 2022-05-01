<?php

namespace Database\Seeders;

use App\Models\Field;
use App\Models\PropertyType;
use App\Models\SearchProfile;
use Illuminate\Database\Seeder;

class SearchProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $searchProfile = SearchProfile::create([
            'name' => 'Awesome land near Smolice!',
            'property_type_id' => PropertyType::find(1)->id,
        ]);

        $searchProfile->fields()->saveMany([
            Field::create([
                'name' => 'rooms',
                'value' => 6
            ]),
            Field::create([
                'name' => 'price',
                'value' => [100000, 150000]
            ]),
            Field::create([
                'name' => 'yearOfConstruction',
                'value' => 2018
            ]),
            Field::create([
                'name' => 'return',
                'value' => 2.5
            ]),
        ]);

        $searchProfile2 = SearchProfile::create([
            'name' => 'Awesome land near Smolice!',
            'property_type_id' => PropertyType::find(1)->id,
        ]);

        $searchProfile2->fields()->saveMany([
            Field::create([
                'name' => 'rooms',
                'value' => 4
            ]),
            Field::create([
                'name' => 'price',
                'value' => [100000, 150000]
            ]),
            Field::create([
                // Noticed that the 25% thing here is pretty much useless :P
                'name' => 'yearOfConstruction',
                'value' => [2000, 2017]
            ]),
        ]);

        $searchProfile3 = SearchProfile::create([
            'name' => 'Awesome land near Smolice!',
            'property_type_id' => PropertyType::find(1)->id,
        ]);

        $searchProfile3->fields()->saveMany([
            Field::create([
                'name' => 'rooms',
                'value' => 4
            ]),
            Field::create([
                'name' => 'price',
                'value' => [100000, 150000]
            ]),
        ]);

        $searchProfile4 = SearchProfile::create([
            'name' => 'Awesome land near Smolice!',
            'property_type_id' => PropertyType::find(1)->id,
        ]);

        $searchProfile4->fields()->saveMany([
            Field::create([
                'name' => 'rooms',
                'value' => 4
            ]),
            Field::create([
                'name' => 'price',
                'value' => [120000, null]
            ]),
        ]);
    }
}
