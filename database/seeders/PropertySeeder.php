<?php

namespace Database\Seeders;

use App\Models\Field;
use App\Models\Property;
use App\Models\PropertyType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PropertySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $property = Property::create([
            'name' => 'Awesome land near Smolice!',
            'address' => 'Somewhere road, Nr. 42',
            'property_type_id' => PropertyType::find(1)->id,
        ]);

        $property->fields()->saveMany([
            Field::create([
                'name' => 'rooms',
                'value' => 6
            ]),
            Field::create([
                'name' => 'price',
                'value' => 140000
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

        $property2 = Property::create([
            'name' => 'Awesome land near Podrime!',
            'address' => 'Anywhere road, Nr. 42',
            'property_type_id' => PropertyType::find(1)->id,
        ]);

        $property2->fields()->saveMany([
            Field::create([
                'name' => 'rooms',
                'value' => 4
            ]),
            Field::create([
                'name' => 'price',
                'value' => 1500000
            ]),
        ]);
    }
}
