<?php

namespace Database\Seeders;

use App\Models\Addon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AddonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (Addon::count() == 0) {
            DB::table('addons')->insert([
                [
                    'package_id' => 1,
                    'title' => 'Add Personalized Cover Letter',
                    'description' => 'Show recruiters that you’re serious with a custom cover letter',
                    'price' => 60.00,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'package_id' => 1,
                    'title' => 'Add LinkedIn Makeover',
                    'description' => 'Boost your online presence',
                    'price' => 140.00,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'package_id' => 1,
                    'title' => 'Express Delivery',
                    'description' => 'Get it done faster',
                    'price' => 50.00,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'package_id' => 4,
                    'title' => 'Add Personalized Cover Letter',
                    'description' => "Show recruiters that you're serious with a custom cover letter",
                    'price' => 60.00,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'package_id' => 4,
                    'title' => 'Resume',
                    'description' => 'Get it done faster',
                    'price' => 169.00,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'package_id' => 4,
                    'title' => 'Add LinkedIn Makeover',
                    'description' => 'Boost your online presence',
                    'price' => 140.00,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'package_id' => 4,
                    'title' => 'Express Delivery',
                    'description' => 'Get it done faster',
                    'price' => 50.00,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'package_id' => 2,
                    'title' => 'Add LinkedIn Makeover',
                    'description' => 'Boost your online presence',
                    'price' => 149.00,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'package_id' => 2,
                    'title' => 'Express Delivery',
                    'description' => 'Get it done faster',
                    'price' => 50.00,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'package_id' => 3,
                    'title' => 'Express Delivery',
                    'description' => 'Get it done faster',
                    'price' => 50.00,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ]);
        }
    }
}
