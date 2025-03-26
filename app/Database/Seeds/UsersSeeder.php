<?php

namespace App\Database\Seeds;

use App\Models\ParticipantsModel;
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
                'role' => 'ADMIN',
                'active' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        }
        // Cek apakah mentor sudah ada berdasarkan email
        $existingMentor = $userModel->where('email', 'pembimbing@example.com')->first();
        if (!$existingMentor) {
            $mentor = $userModel->create([
                'email' => 'pembimbing@example.com',
                'username' => 'mentor',
                'password_hash' => Password::hash('password'), // Ubah password sesuai kebutuhan
                'status' => 'Active',
                'role' => 'MENTOR',
                'active' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        }
        // Cek apakah participant sudah ada berdasarkan email
        $existingParticipant = $userModel->where('email', 'peserta@example.com')->first();
        if (!$existingParticipant) {
            $participant = $userModel->create([
                'email' => 'peserta@example.com',
                'username' => 'participant',
                'password_hash' => Password::hash('password'), // Ubah password sesuai kebutuhan
                'status' => 'Active',
                'role' => 'participant',
                'active' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);

            $mentor_id = UserModel::where('role', 'MENTOR')->inRandomOrder()->first()->id;

            ParticipantsModel::create([
                'user_id' => $participant->id,
                'full_name' => $faker->name(),
                'institution' => $faker->company(),
                'level' => $faker->randomElement(['SMA', 'SMK', 'D3', 'S1', 'S2', 'Other']),
                'start_date' => $faker->date('Y-m-d', 'now'),
                'end_date' => $faker->date('Y-m-d', '+1 year'),
                'status' => $faker->randomElement(['Active', 'Completed', 'Dropped']),
                'created_at' => $faker->dateTimeBetween('-1 year', 'now')->format('Y-m-d H:i:s'),
                'updated_at' => $faker->dateTimeBetween('-6 months', 'now')->format('Y-m-d H:i:s'),
                'mentor_id' => $mentor_id,
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
                'role' => $faker->randomElement(['ADMIN', 'MENTOR']),
            ]);
        }

        echo "Data users berhasil di-seed!\n";
    }
}
