<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use UserRoleSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        // Disable foreign key checks
        if (env('DB_CONNECTION') == 'mysql') {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        }

        // Seed users
        $this->call(UsersTableSeeder::class);

        // Enable foreign key checks
        if (env('DB_CONNECTION') == 'mysql') {
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        }

        // Seed roles
        $roles = [
            ['name' => 'admin'],
            ['name' => 'news_manager'],
            ['name' => 'post_manager'],
        ];

        foreach ($roles as $role) {
            \App\Models\Role::create($role);
        }

        // Assign roles to users
        $userIdsWithRoles = [
            1 => [1], // User ID => Role IDs
            2 => [2],
            3 => [3],
        ];

        foreach ($userIdsWithRoles as $userId => $roleIds) {
            $user = \App\Models\User::find($userId);
            if ($user) {
                $user->roles()->attach($roleIds);
            } else {
                // Handle error: User not found
                logger()->error("User with ID $userId not found.");
            }
        }
    }

}
