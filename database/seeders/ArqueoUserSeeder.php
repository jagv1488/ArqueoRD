<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ArqueoUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Administrador del Sistema / Ministerio de Cultura
        User::create([
            'name' => 'Admin Ministerio',
            'email' => 'admin@arqueord.gob.do',
            'password' => Hash::make('admin123'),
            'license_number' => 'MIN-0001',
            'institution' => 'Ministerio de Cultura',
            'phone' => '809-555-0000',
            'role' => 'admin',
            'is_verified' => true,
        ]);

        // 2. Arqueólogo Acreditado (Verificado - Acceso total a bitácoras)
        User::create([
            'name' => 'Dr. Fernando Luna',
            'email' => 'fluna@uasd.edu.do',
            'password' => Hash::make('arq123'),
            'license_number' => 'ARQ-0012',
            'institution' => 'Universidad Autónoma de Santo Domingo',
            'phone' => '829-555-1234',
            'role' => 'archaeologist',
            'is_verified' => true,
        ]);

        // 3. Arqueólogo Nuevo (No Verificado - Acceso restringido)
        User::create([
            'name' => 'Lic. Roberto Castillo',
            'email' => 'rcastillo@arqueologo.com',
            'password' => Hash::make('arq123'),
            'license_number' => 'ARQ-0099',
            'institution' => 'Investigador Independiente',
            'phone' => '809-555-9999',
            'role' => 'archaeologist',
            'is_verified' => false,
        ]);


    }
}
