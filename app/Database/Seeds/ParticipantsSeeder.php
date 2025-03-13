<?php

namespace App\Database\Seeds;

use App\Models\ParticipantsModel;
use App\Models\UserModel;
use CodeIgniter\Database\Seeder;
use Faker\Factory;
use Myth\Auth\Password;

class ParticipantsSeeder extends Seeder
{
    public function run()
    {

        require_once APPPATH . 'Config/Eloquent.php';

        $faker = Factory::create('id_ID');
 

        // Buat pengguna acak
        for ($i = 0; $i < 30; $i++) {
            $mentor_id = UserModel::where('role', 'MENTOR')->inRandomOrder()->first()->id;

            UserModel::insert([
                'email' => $faker->unique()->safeEmail,
                'username' => $faker->unique()->userName,
                'password_hash' => Password::hash('password123'),
                'status' => $faker->randomElement(['Active', 'Inactive']),
                'active' => $faker->numberBetween(0, 1),
                'created_at' => $faker->dateTimeBetween('-1 year', 'now')->format('Y-m-d H:i:s'),
                'updated_at' => $faker->dateTimeBetween('-6 months', 'now')->format('Y-m-d H:i:s'),
                'deleted_at' => null,
            ]);

            // Ambil ID pengguna terakhir yang di-insert
            $userId = UserModel::first();

            ParticipantsModel::insert([
                'user_id' => $userId->id, // Pastikan user_id tidak null
                'full_name' => $faker->name(),
                'institution' => $faker->company(),
                'level' => $faker->randomElement(['SMA', 'SMK', 'D3', 'S1', 'S2', 'Other']),
                'start_date' => $faker->date('Y-m-d', 'now'),
                'end_date' => $faker->date('Y-m-d', '+1 year'),
                'status' => $faker->randomElement(['Active', 'Completed', 'Dropped']),
                'created_at' => $faker->dateTimeBetween('-1 year', 'now')->format('Y-m-d H:i:s'),
                'updated_at' => $faker->dateTimeBetween('-6 months', 'now')->format('Y-m-d H:i:s'),
                'mentor_id' => $mentor_id
            ]);
        }


        echo "Data users berhasil di-seed!\n";
    }
}
