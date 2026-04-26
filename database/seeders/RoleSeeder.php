<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        Role::firstOrCreate(['name' => 'admin']);
        Role::firstOrCreate(['name' => 'doctor']);
        Role::firstOrCreate(['name' => 'secretary']);
        Role::firstOrCreate(['name' => 'patient']);

        $admin = User::firstOrCreate(
            ['email' => 'admin@cabinet.com'],
            ['name' => 'Admin Test', 'password' => Hash::make('password123')]
        );
        $admin->assignRole('admin');

        $doctor = User::firstOrCreate(
            ['email' => 'doctor@cabinet.com'],
            ['name' => 'Docteur Test', 'password' => Hash::make('password123')]
        );
        $doctor->assignRole('doctor');

        $secretary = User::firstOrCreate(
            ['email' => 'secretary@cabinet.com'],
            ['name' => 'Secretaire Test', 'password' => Hash::make('password123')]
        );
        $secretary->assignRole('secretary');

        $patient = User::firstOrCreate(
            ['email' => 'patient@cabinet.com'],
            ['name' => 'Patient Test', 'password' => Hash::make('password123')]
        );
        $patient->assignRole('patient');
    }
}
