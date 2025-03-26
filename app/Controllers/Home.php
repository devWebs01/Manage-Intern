<?php

namespace App\Controllers;
use App\Models\ParticipantsModel;
use App\Models\PresencesModel;
use App\Models\UserModel;
use App\Models\LogbooksModel;
use App\Libraries\BladeOneLibrary;
use Carbon\Carbon;

class Home extends BaseController
{
    protected $blade;

    public function __construct()
    {
        // Inisialisasi BladeOneLibrary satu kali di konstruktor
        $this->blade = new BladeOneLibrary();
    }
    public function index(): string
    {
        return view('welcome_message');
    }

    public function dashboard()
    {
        $user = User(); // Ambil user yang sedang login
         $now = Carbon::now();
            $today = Carbon::today();
        $data = [];

        if ($user->role === 'ADMIN') {
            $data['charts'] = [
                'total_counts' => [
                    'labels' => ['Total Peserta', 'Total Pembimbing', 'Peserta Lulus'],
                    'values' => [ParticipantsModel::count(), UserModel::where('role', 'MENTOR')->count(), ParticipantsModel::where('status', 'Completed')->count()],
                ],
                'monthly_statistics' => ParticipantsModel::selectRaw('MONTH(created_at) as month, COUNT(*) as count')->groupBy('month')->pluck('count', 'month'),
                'status_donut' => [
                    'labels' => ParticipantsModel::select('status')->groupBy('status')->pluck('status')->toArray(),
                    'values' => ParticipantsModel::selectRaw('status, COUNT(*) as count')->groupBy('status')->pluck('count')->toArray(),
                ],
                'level_donut' => [
                    'labels' => ParticipantsModel::select('level')->groupBy('level')->pluck('level')->toArray(),
                    'values' => ParticipantsModel::selectRaw('level, COUNT(*) as count')->groupBy('level')->pluck('count')->toArray(),
                ],
            ];
        } elseif ($user->role === 'MENTOR') {
            $mentoredParticipants = ParticipantsModel::where('mentor_id', $user->id)->get();
            $data['charts'] = [
                'total_participants' => [
                    'labels' => ['Peserta Dibimbing', 'Peserta SMA', 'Peserta SMK', 'Peserta D3', 'Peserta S1', 'Peserta S2', 'Other'],
                    'values' => [$mentoredParticipants->count(), $mentoredParticipants->where('level', 'SMA')->count(), $mentoredParticipants->where('level', 'SMK')->count(), $mentoredParticipants->where('level', 'D3')->count(), $mentoredParticipants->where('level', 'S1')->count(), $mentoredParticipants->where('level', 'S2')->count(), $mentoredParticipants->where('level', 'Other')->count()],
                ],
                'status_donut' => [
                    'labels' => $mentoredParticipants->pluck('status')->unique()->values()->all(),
                    'values' => $mentoredParticipants
                        ->groupBy('status')
                        ->map(function ($group) {
                            return $group->count();
                        })
                        ->values()
                        ->all(),
                ],
            ];
            $data['mentoredParticipants'] = $mentoredParticipants;
        } elseif ($user->role === 'PARTICIPANT') {
            $participant = ParticipantsModel::where('user_id', $user->id)->first();

            // Hitung total hari magang, hari terlewati, dan hari tersisa
            $startDate = Carbon::parse($participant->start_date);
            $endDate = Carbon::parse($participant->end_date);
            $totalDays = $startDate->diffInDays($endDate);
            $daysPassed = $startDate->diffInDays($now);
            $daysRemaining = $totalDays - $daysPassed;

            $data['internship_status'] = [
                'total_days' => $totalDays,
                'days_passed' => $daysPassed,
                'days_remaining' => $daysRemaining,
                'attendance_reminder' => PresencesModel::where('participant_id', $participant->id)->whereDate('date', $today)->exists() ? 'Sudah Absen' : 'Belum Absen',
                'logbook_reminder' => LogbooksModel::where('participant_id', $participant->id)->whereDate('date', $today)->exists() ? 'Sudah Isi' : 'Belum Isi',
            ];

            // History Logbook dan Absensi (dikelompokkan per tanggal)
            $logbookHistory = LogbooksModel::selectRaw('DATE(date) as day, COUNT(*) as count')->where('participant_id', $participant->id)->groupBy('day')->orderBy('day')->get();
            $presenceHistory = PresencesModel::selectRaw('DATE(date) as day, COUNT(*) as count')->where('participant_id', $participant->id)->groupBy('day')->orderBy('day')->get();

            // Buat array indeks berdasarkan tanggal
            $logbookArray = $logbookHistory->pluck('count', 'day')->toArray();
            $presenceArray = $presenceHistory->pluck('count', 'day')->toArray();

            // Gabungkan semua tanggal yang ada
            $allDays = array_unique(array_merge(array_keys($logbookArray), array_keys($presenceArray)));
            sort($allDays);
            $labels = $allDays;

            $logbookData = [];
            $presenceData = [];
            foreach ($labels as $day) {
                $logbookData[] = isset($logbookArray[$day]) ? $logbookArray[$day] : 0;
                $presenceData[] = isset($presenceArray[$day]) ? $presenceArray[$day] : 0;
            }

            $data['logbookHistory'] = [
                'labels' => $labels,
                'logbook' => $logbookData,
                'presence' => $presenceData,
            ];
        }

        return $this->blade->render('dashboard', $data);
    }

    public function show($id)
    {
        $data = [
            'mentors' => UserModel::where('role', 'MENTOR')->get(),
            'profile' => UserModel::find($id),
        ];

        return $this->blade->render('profiles.show', $data);
    }

    public function update($id)
    {
        $user = UserModel::find($id);
        if (!$user) {
            return redirect()
                ->back()
                ->with('errors', ['user' => 'Pengguna tidak ditemukan']);
        }

        // Ambil data participant jika sudah ada
        $participant = $user->participant;

        $validation = \Config\Services::validation();
        $rules = [
            'email' => "required|valid_email|is_unique[users.email,id,{$user->id}]",
            'username' => "required|alpha_numeric_punct|min_length[3]|max_length[30]|is_unique[users.username,id,{$user->id}]",
            'avatar' => 'permit_empty|max_size[avatar,2048]|is_image[avatar]|mime_in[avatar,image/png,image/jpeg,image/jpg]',
        ];

        // Validasi tambahan untuk PARTICIPANT
        if ($user->role === 'PARTICIPANT') {
            $rules += [
                'full_name' => 'required|min_length[3]|max_length[255]',
                'institution' => 'required|min_length[3]|max_length[255]',
                'level' => 'required',
            ];
        }

        if ($this->request->getPost('password')) {
            $rules['password'] = 'min_length[6]';
        }

        $validation->setRules($rules);
        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        // Data yang akan diupdate
        $userData = [
            'email' => $this->request->getPost('email'),
            'username' => $this->request->getPost('username'),
        ];

        if ($this->request->getPost('password')) {
            $userData['password_hash'] = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
        }

        // ✅ **Handle Upload Avatar**
        $file = $this->request->getFile('avatar');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            // Buat folder jika belum ada
            if (!is_dir(FCPATH . 'uploads/avatars')) {
                mkdir(FCPATH . 'uploads/avatars', 0777, true);
            }

            $newName = $file->getRandomName();
            $file->move(FCPATH . 'uploads/avatars/', $newName);

            // Hapus avatar lama jika ada
            if (!empty($user->avatar) && file_exists(FCPATH . $user->avatar)) {
                unlink(FCPATH . $user->avatar);
            }

            $userData['avatar'] = 'uploads/avatars/' . $newName;
        }

        $user->update($userData);

        // ✅ **Update PARTICIPANT jika ada**
        if ($user->role === 'PARTICIPANT') {
            $participantData = [
                'full_name' => $this->request->getPost('full_name'),
                'institution' => $this->request->getPost('institution'),
                'level' => $this->request->getPost('level'),
            ];

            if ($participant) {
                $participant->update($participantData);
            } else {
                $participantModel = new ParticipantsModel();
                $participantData['user_id'] = $user->id;
                $participantModel->insert($participantData);
            }
        }

        return redirect()
            ->to('/profiles/' . $user->id . '/show')
            ->with('success', 'Profil akun berhasil diperbarui.');
    }
    function test()
    {
        $mentor = UserModel::where('role', 'MENTOR')->inRandomOrder()->first()->id;

        dd($mentor);
    }
}
