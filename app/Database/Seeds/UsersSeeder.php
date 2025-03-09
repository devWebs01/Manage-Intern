<?php

namespace App\Database\Seeds;

use App\Models\UserModel;
use CodeIgniter\Database\Seeder;
use Faker\Factory;
use Myth\Auth\Password;

class UsersSeeder extends Seeder
{
    public function run()
    {
        // Pastikan Eloquent sudah di-boot
        require_once APPPATH . 'Config/Eloquent.php';

        $userModel = new UserModel();
        $faker = Factory::create('id_ID');
        
        // Cek apakah admin sudah ada berdasarkan email
        $existingAdmin = $userModel->where('email', 'admin@example.com')->first();
        if (!$existingAdmin) {
            $admin = $userModel->create([
                'email' => 'admin@example.com',
                'username' => 'admin',
                'password_hash' => Password::hash('password'), // Ubah password sesuai kebutuhan
                'status' => 'Active',
                'active' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        }

        // Buat pengguna acak
        for ($i = 0; $i < 10; $i++) {
            $userModel->insert([
                'email' => $faker->unique()->safeEmail,
                'username' => $faker->unique()->userName,
                'password_hash' => Password::hash('password123'), // Password default untuk testing
                'status' => $faker->randomElement(['Active', 'Inactive']),
                'active' => $faker->numberBetween(0, 1),
                'created_at' => $faker->dateTimeBetween('-1 year', 'now')->format('Y-m-d H:i:s'),
                'updated_at' => $faker->dateTimeBetween('-6 months', 'now')->format('Y-m-d H:i:s'),
                'deleted_at' => null,
            ]);
        }

        echo "Data users berhasil di-seed!\n";
    }
}
