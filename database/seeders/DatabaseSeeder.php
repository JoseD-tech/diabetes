<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Estado;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Estado::create([
            'estado' => 'Pendiente'
        ]);

        Estado::create([
            'estado' => 'Revisado'
        ]);

        //Crea los Roles
        $role1 = Role::create(['name' => 'admin']);
        $role2 = Role::create(['name' => 'doctor']);
        $role3 = Role::create(['name' => 'secretario']);

        // Usuarios de Prueba admin/usuario
        User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123'),
        ]);

        User::create([
            'name' => 'doctor',
            'email' => 'doctor@gmail.com',
            'password' => Hash::make('doctor123'),
        ]);

        User::create([
            'name' => 'secretario',
            'email' => 'secretario@gmail.com',
            'password' => Hash::make('secretario123'),
        ]);

        $user = User::find(1);
        $user->assignRole($role1);

        $user2 = User::find(2);
        $user2->assignRole($role2);

        $user3 = User::find(3);
        $user3->assignRole($role3);
    }
}
