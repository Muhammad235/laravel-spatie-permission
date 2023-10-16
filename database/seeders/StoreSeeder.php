<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Store;
use App\Models\UserProfile;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fashionStore = Store::factory()->create();

        User::factory()->count(1)
        ->has(UserProfile::factory())
        ->has($fashionStore)
        ->create()
        ->each(
            function($user){
                $user->assignRole('store-owner');
            }
        );
    }
}

