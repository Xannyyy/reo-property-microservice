<?php

namespace Database\Seeders;

use App\Models\PropertyType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PropertyTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PropertyType::create([
            'name' => 'Land for rent'
        ]);
        PropertyType::create([
            'name' => 'Land for sale'
        ]);
        PropertyType::create([
            'name' => 'House for rent'
        ]);
        PropertyType::create([
            'name' => 'House for sale'
        ]);
    }
}
