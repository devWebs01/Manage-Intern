<?php

namespace App\Controllers\Participant;

use App\Models\PresencesModel;
use App\Libraries\BladeOneLibrary;
use App\Models\UserModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use App\Controllers\BaseController;

class PresencesController extends BaseController
{
    protected $blade;

    public function __construct()
    {
        $this->blade = new BladeOneLibrary();
    }

    public function index()
    {
        $user = service('authentication')->user();
        $userModel = new UserModel();
        $userData = $userModel->find($user->id);

        $participant = $userData->participant;

        if (!$participant) {
            return redirect()->back()->with('error', 'Data peserta tidak ditemukan.');
        }

        $today = date('Y-m-d');

        $presences = PresencesModel::where('participant_id', $participant->id)
            ->orderBy('date', 'DESC')
            ->get();

        $hasCheckInToday = $presences->contains(function ($presence) use ($today) {
            return $presence->date === $today && !empty($presence->check_in);
        });

        $data = [
            'presences' => $presences,
            'hasCheckInToday' => $hasCheckInToday
        ];

        return $this->blade->render('presences.index', $data);
    }

    public function new()
    {
        return $this->blade->render('presences.create');
    }

    public function create()
    {
        $data = $this->request->getPost();

        $validation = \Config\Services::validation();
        $rules = [
            'date' => 'required|valid_date[Y-m-d]',
            'check_in' => 'required|valid_date[H:i:s]',
            'check_out' => 'permit_empty|valid_date[H:i:s]',
        ];
        $validation->setRules($rules);
        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $validation->getErrors());
        }

        $user = UserModel::find(user_id());
        $participantId = $user->participant->id;

        $today = $data['date'] ?? date('Y-m-d');

        // Cek apakah sudah absen hari ini
        $existingPresence = PresencesModel::where('participant_id', $participantId)
            ->where('date', $today)
            ->first();

        if ($existingPresence) {
            return redirect()->to('/presences')->with('error', 'Anda sudah melakukan absensi hari ini.');
        }

        $data['participant_id'] = $participantId;

        try {
            $presence = PresencesModel::create($data);
            if (!$presence) {
                return redirect()->back()->withInput()->with('errors', ['Gagal membuat presensi.']);
            }
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('errors', [$e->getMessage()]);
        }

        return redirect()->to('/presences')->with('success', 'Presensi berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $presence = PresencesModel::find($id);
        if (!$presence) {
            return redirect()->back()->with('errors', 'Presensi tidak ditemukan');
        }
        $data = ['presence' => $presence];
        return $this->blade->render('presences.edit', $data);
    }

    public function update($id)
    {
        $presence = PresencesModel::find($id);
        if (!$presence) {
            return redirect()->back()->with('errors', 'Presensi tidak ditemukan');
        }

        $data = $this->request->getPost();
        $user = UserModel::find(user_id());
        $data['participant_id'] = $user->participant->id;

        $validation = \Config\Services::validation();
        $rules = [
            'date' => 'required|valid_date[Y-m-d]',
            'check_in' => 'required|valid_date[H:i:s]',
            'check_out' => 'permit_empty|valid_date[H:i:s]',
        ];
        $validation->setRules($rules);
        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $validation->getErrors());
        }

        try {
            $presence->update($data);
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('errors', [$e->getMessage()]);
        }

        return redirect()->to('/presences')->with('success', 'Presensi berhasil diperbarui.');
    }

    public function delete($id)
    {
        $presence = PresencesModel::find($id);
        if (!$presence) {
            return redirect()->back()->with('errors', 'Presensi tidak ditemukan');
        }

        try {
            $presence->delete();
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('errors', [$e->getMessage()]);
        }

        return redirect()->to('/presences')->with('success', 'Presensi berhasil dihapus.');
    }
}
