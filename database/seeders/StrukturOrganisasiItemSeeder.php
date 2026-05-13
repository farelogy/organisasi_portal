<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\StrukturOrganisasiItem;

class StrukturOrganisasiItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            [
                'name' => 'Badan Kejuruan Sipil',
                'logo' => 'https://placehold.co/400x400/orange/white?text=Sipil',
                'link' => 'https://pii.or.id/bk-sipil',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Badan Kejuruan Mesin',
                'logo' => 'https://placehold.co/400x400/orange/white?text=Mesin',
                'link' => 'https://pii.or.id/bk-mesin',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'Badan Kejuruan Elektro',
                'logo' => 'https://placehold.co/400x400/orange/white?text=Elektro',
                'link' => 'https://pii.or.id/bk-elektro',
                'order' => 3,
                'is_active' => true,
            ],
            [
                'name' => 'Badan Kejuruan Kimia',
                'logo' => 'https://placehold.co/400x400/orange/white?text=Kimia',
                'link' => 'https://pii.or.id/bk-kimia',
                'order' => 4,
                'is_active' => true,
            ],
            [
                'name' => 'Badan Kejuruan Tambang',
                'logo' => 'https://placehold.co/400x400/orange/white?text=Tambang',
                'link' => 'https://pii.or.id/bk-tambang',
                'order' => 5,
                'is_active' => true,
            ],
            [
                'name' => 'Badan Kejuruan Geologi',
                'logo' => 'https://placehold.co/400x400/orange/white?text=Geologi',
                'link' => 'https://pii.or.id/bk-geologi',
                'order' => 6,
                'is_active' => true,
            ],
            [
                'name' => 'Badan Kejuruan Industri',
                'logo' => 'https://placehold.co/400x400/orange/white?text=Industri',
                'link' => 'https://pii.or.id/bk-industri',
                'order' => 7,
                'is_active' => true,
            ],
            [
                'name' => 'Badan Kejuruan Pertanian',
                'logo' => 'https://placehold.co/400x400/orange/white?text=Pertanian',
                'link' => 'https://pii.or.id/bk-pertanian',
                'order' => 8,
                'is_active' => true,
            ],
            [
                'name' => 'Badan Kejuruan Perkapalan',
                'logo' => 'https://placehold.co/400x400/orange/white?text=Perkapalan',
                'link' => 'https://pii.or.id/bk-perkapalan',
                'order' => 9,
                'is_active' => true,
            ],
            [
                'name' => 'Badan Kejuruan Informatika',
                'logo' => 'https://placehold.co/400x400/orange/white?text=Informatika',
                'link' => 'https://pii.or.id/bk-informatika',
                'order' => 10,
                'is_active' => true,
            ],
        ];

        foreach ($items as $item) {
            StrukturOrganisasiItem::create($item);
        }
    }
}
