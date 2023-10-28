<?php

namespace Database\Seeders;

use App\Models\BuildingType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BuildingTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $buildingTypes = [
            [
                'id' => 1,
                'name_ar' => 'مبنى متعدد الاستخدامات',
                'name_en' => 'Mixed-use Building',
                'image' => ('/building-types/Mixed-use Building.webp')
            ],
            [
                'id' => 2,
                'name_ar' => 'مركز تسوق',
                'name_en' => 'Shopping Centre',
                'image' => ('/building-types/Shopping Centre.webp')
            ],
            [
                'id' => 3,
                'name_ar' => 'مبنى سكني',
                'name_en' => 'Apartment Building',
                'image' => ('/building-types/Apartment Building.webp')
            ],
            [
                'id' => 4,
                'name_ar' => 'Supermarket',
                'name_en' => 'Supermarket',
                'image' => ('/building-types/Supermarket.webp')
            ],
            [
                'id' => 5,
                'name_ar' => 'Shop Unit',
                'name_en' => 'Shop Unit',
                'image' => ('/building-types/Shop Unit.webp')
            ],
            [
                'id' => 6,
                'name_ar' => 'Office Unit',
                'name_en' => 'Office Unit',
                'image' => ('/building-types/Office Unit.webp')
            ],
            [
                'id' => 7,
                'name_ar' => 'Commercial Unit',
                'name_en' => 'Commercial Unit',
                'image' => ('/building-types/Commercial Unit.webp')
            ],
            [
                'id' => 8,
                'name_ar' => 'Restaurant or Cafe',
                'name_en' => 'Restaurant or Cafe',
                'image' => ('/building-types/Restaurant or Cafe.webp')
            ],
            [
                'id' => 9,
                'name_ar' => 'Showroom',
                'name_en' => 'Showroom',
                'image' => ('/building-types/Showroom.webp')
            ],
            [
                'id' => 10,
                'name_ar' => 'Mosque',
                'name_en' => 'Mosque',
                'image' => ('/building-types/Mosque.webp')
            ],
            [
                'id' => 11,
                'name_ar' => 'Museum',
                'name_en' => 'Museum',
                'image' => ('/building-types/Museum.webp')
            ],
            [
                'id' => 12,
                'name_ar' => 'Library',
                'name_en' => 'Library',
                'image' => ('/building-types/Library.webp')
            ],
            [
                'id' => 13,
                'name_ar' => 'Cinema',
                'name_en' => 'Cinema',
                'image' => ('/building-types/Cinema.webp')
            ],
            [
                'id' => 14,
                'name_ar' => 'Car Park Building',
                'name_en' => 'Car Park Building',
                'image' => ('/building-types/Car Park Building.webp')
            ],
            [
                'id' => 15,
                'name_ar' => 'Gym or Spa',
                'name_en' => 'Gym or Spa',
                'image' => ('/building-types/Gym or Spa.webp')
            ],
            [
                'id' => 16,
                'name_ar' => 'Hotel',
                'name_en' => 'Hotel',
                'image' => ('/building-types/Hotel.webp')
            ],
        ];
        foreach ($buildingTypes as $buildingType) {
            BuildingType::updateorcreate(
                ['id' => $buildingType['id']],
                [
                    'id' => $buildingType['id'],
                    'name_ar' => $buildingType['name_ar'],
                    'name_en' => $buildingType['name_en'],
                    'image' => $buildingType['image'],
                ],
            );
        }
    }
}
