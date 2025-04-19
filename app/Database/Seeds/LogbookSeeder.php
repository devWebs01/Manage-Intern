<?php

namespace App\Database\Seeds;

use App\Models\LogbooksModel;
use App\Models\ParticipantsModel;
use Carbon\Carbon;
use CodeIgniter\Database\Seeder;
use Faker\Factory;


class LogbookSeeder extends Seeder
{
    public function run()
    {
        require_once APPPATH . 'Config/Eloquent.php';

        $faker = Factory::create('id_ID');

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
        $jumlahData = min(50, count($dates)); // supaya nggak error kalau hari di bulan ini kurang dari jumlah yang diinginkan


        // Buat pengguna acak
        for ($i = 0; $i < $jumlahData; $i++) {
            $participant_id = ParticipantsModel::inRandomOrder()->first()->id;

            LogbooksModel::insert([
                'participant_id' => $participant_id,
                'date' => $dates[$i], // tanggal unik
                'activity' => "Hari ini saya mengikuti kegiatan " . $faker->sentence(3) .
                    " yang dilaksanakan mulai pukul " . $faker->time('H:i') .
                    " sampai dengan " . $faker->time('H:i') . ". Kegiatan ini berlangsung di " . $faker->city .
                    " dan dihadiri oleh beberapa peserta lainnya. Dalam kegiatan ini, saya mendapatkan banyak pengetahuan baru, " .
                    "terutama mengenai " . $faker->words(4, true) . ". Selain itu, saya juga berkesempatan untuk berinteraksi langsung " .
                    "dengan pemateri dan berdiskusi tentang berbagai topik yang menarik. Kegiatan berjalan lancar dan saya merasa " .
                    "sangat antusias mengikuti setiap sesi yang disampaikan. Saya berharap kegiatan seperti ini dapat terus dilakukan di masa yang akan datang."

            ]);
        }
        echo "Data logbook berhasil di-seed!\n";
    }
}
