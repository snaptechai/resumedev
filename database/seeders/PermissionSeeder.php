<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            ['access' => 'View SEO Tag'],
            ['access' => 'Add SEO Tag'],
            ['access' => 'Edit SEO Tag'],
            ['access' => 'Delete SEO Tag'],
            ['access' => 'View Addon'],
            ['access' => 'Edit Addon']
        ];

        foreach ($permissions as $permission) {
            DB::table('access')->updateOrInsert(
                ['access' => $permission['access']],
                $permission
            );
        }

        $accessIds = DB::table('access')->pluck('id')->toArray();

        foreach ($accessIds as $accessId) {
            DB::table('access_user')->updateOrInsert(
                ['user' => 1, 'access' => $accessId],
                [
                    'user' => 1,
                    'access' => $accessId,
                    'added_by' => 1,
                    'added_date' => now()
                ]
            );
        }
    }
}
