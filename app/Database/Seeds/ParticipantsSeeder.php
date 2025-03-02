<?php

namespace App\Database\Seeds;

use App\Models\ParticipantsModel;
use App\Models\UserModel;
use CodeIgniter\Database\Seeder;
use Faker\Factory;

class ParticipantsSeeder extends Seeder
{
    public function run()
    {
        $participantsModel = new ParticipantsModel();
        $userModel = new UserModel();
        $faker = Factory::create('id_ID');
        
        // Ambil semua user ID yang ada di tabel users
        $userIDs = $userModel->select('id')->findAll();

        foreach ($userIDs as $user) {
            $participantsModel->insert([
                'user_id'    => $user->id,
                'full_name'  => $faker->name,
                'institution'=> $faker->company,
                'level'      => $faker->randomElement(['Beginner', 'Intermediate', 'Advanced']),
                'start_date' => $faker->date('Y-m-d', 'now'),
                'end_date'   => $faker->date('Y-m-d', '+1 year'),
                'status'     => $faker->randomElement(['Active', 'Completed', 'Dropped']),
                'created_at' => $faker->dateTimeBetween('-1 year', 'now')->format('Y-m-d H:i:s'),
                'updated_at' => $faker->dateTimeBetween('-6 months', 'now')->format('Y-m-d H:i:s'),
                'deleted_at' => null,
            ]);
        }

        echo "Data participants berhasil di-seed!\n";
    }
}
