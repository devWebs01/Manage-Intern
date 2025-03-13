<?php

namespace App\Controllers;
use App\Models\LogbooksModel;
use App\Models\ParticipantsModel;
use App\Models\UserModel;
use App\Libraries\BladeOneLibrary;

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

        // Data yang akan dikirim ke view
        $data = [
            'title' => 'Halaman Utama',
            'message' => 'Selamat datang di CodeIgniter dengan BladeOne'
        ];

        // Render view 'home.blade.php' yang berada di folder Views
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
            return redirect()->back()->with('errors', ['user' => 'Pengguna tidak ditemukan']);
        }

        // Ambil data participant jika sudah ada
        $participant = $user->participant;

        $validation = \Config\Services::validation();
        $rules = [
            'email' => "required|valid_email|is_unique[users.email,id,{$user->id}]",
            'username' => "required|alpha_numeric_punct|min_length[3]|max_length[30]|is_unique[users.username,id,{$user->id}]",
        ];

        // Jika role user adalah PARTICIPANT, tetapkan validasi untuk data participant
        if ($user->role === "PARTICIPANT") {
            $rules += [
                'full_name' => 'required|min_length[3]|max_length[255]',
                'institution' => 'required|min_length[3]|max_length[255]',
                'level' => 'required',
                'mentor_id' => 'required|numeric',
                'start_date' => 'required|valid_date[Y-m-d]',
                'end_date' => 'required|valid_date[Y-m-d]',
                'status' => 'required|in_list[Active,Completed,Dropped]',
            ];
        }

        if ($this->request->getPost('password')) {
            $rules['password'] = 'min_length[6]';
        }

        $validation->setRules($rules);
        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $validation->getErrors());
        }

        // Update data User
        $userData = [
            'email' => $this->request->getPost('email'),
            'username' => $this->request->getPost('username'),
        ];
        if ($this->request->getPost('password')) {
            $userData['password_hash'] = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
        }
        $user->update($userData);

        // Jika user berperan sebagai PARTICIPANT, update atau buat data participant
        if ($user->role === "PARTICIPANT") {
            $participantData = [
                'full_name' => $this->request->getPost('full_name'),
                'institution' => $this->request->getPost('institution'),
                'level' => $this->request->getPost('level'),
                'mentor_id' => $this->request->getPost('mentor_id'),
                'start_date' => $this->request->getPost('start_date'),
                'end_date' => $this->request->getPost('end_date'),
                'status' => $this->request->getPost('status'),
            ];

            if ($participant) {
                // Jika data participant sudah ada, lakukan update
                $participant->update($participantData);
            } else {
                // Jika belum ada, buat record baru dengan memasukkan user_id
                $participantModel = new ParticipantsModel();
                $participantData['user_id'] = $user->id;
                $participantModel->insert($participantData);
            }
        }

        return redirect()->to('/profiles/' . $user->id . '/show')->with('success', 'Profil akun berhasil diperbarui.');
    }



    function test()
    {
        $mentor = UserModel::where('role', 'MENTOR')->inRandomOrder()->first()->id;

        dd($mentor);
    }
}
