<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RoleSeeder::class);
        // User::factory(10)->create();

        User::factory()->create([
            'username' => 'admin_postgrado',
            'nombres' => 'postgrado',
            'apellido_paterno' => 'uatf',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('123456789')
        ])->assignRole('administrador');
    }
}
