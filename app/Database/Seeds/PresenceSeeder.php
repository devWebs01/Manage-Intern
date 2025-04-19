<?php

namespace App\Database\Seeds;

use App\Models\PresencesModel;
use App\Models\ParticipantsModel;
use Carbon\Carbon;
use CodeIgniter\Database\Seeder;
use Faker\Factory;

class PresenceSeeder extends Seeder
{
    public function run()
    {
        require_once APPPATH . 'Config/Eloquent.php';

        $faker = Factory::create('id_ID');

        $checkIn = $faker->dateTimeBetween('08:00:00', '09:30:00');
        $checkOut = (clone $checkIn)->modify('+8 hours'); // asumsi kerja 8 jam
        // Ambil semua tanggal di bulan ini
        $start = Carbon::now()->startOfMonth();
        $end = Carbon::now()->endOfMonth();

        $dates = [];

        while ($start <= $end) {
            $dates[] = $start->format('Y-m-d');
            $start->addDay();
        }

        // Acak urutan tanggal
        shuffle($dates);

        // Misal kamu mau generate 20 data logbook
        $jumlahData = min(20, count($dates)); // supaya nggak error kalau hari di bulan ini kurang dari jumlah yang diinginkan


        for ($i = 0; $i < $jumlahData; $i++) {

            $participant_id = ParticipantsModel::inRandomOrder()->first()->id;

            PresencesModel::create([
                'participant_id' => $participant_id,
                'date' => $dates[$i], // tanggal unik
                'check_in' => $checkIn->format('H:i:s'),
                'check_out' => $checkOut->format('H:i:s'),
            ]);
        }

        echo "Data absensi berhasil di-seed!\n";

    }
}
