<?php

namespace App\Controllers;

use App\Models\ParticipantAssessmentModel;
use App\Models\AssessmentIndicatorModel;
use App\Libraries\BladeOneLibrary;
use App\Models\ParticipantsModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class ParticipantAssessmentsController extends BaseController
{
    protected $blade;

    public function __construct()
    {
        $this->blade = new BladeOneLibrary();
    }

    public function index()
    {
        if (User()->role === 'ADMIN') {
            $data['assessments'] = ParticipantsModel::where('status', 'Active')
                ->latest()
                ->get();

        } elseif (User()->role === 'MENTOR') {
            $data['assessments'] = ParticipantsModel::where('status', 'Active')
                ->where('mentor_id', User()->id)
                ->latest()
                ->get();

        }

        return $this->blade->render('participant_assessments.index', $data);
    }

    public function new($id)
    {
        // Untuk membuat penilaian baru, ambil semua indikator penilaian
        $data['indicators'] = AssessmentIndicatorModel::get();
        $data['participant'] = ParticipantsModel::find($id);
        return $this->blade->render('participant_assessments.create', $data);
    }

    public function create()
    {
        $post = $this->request->getPost();
        $participant_id = $post['participant_id'] ?? null;
        if (!$participant_id) {
            return redirect()->back()->withInput()->with('errors', ['Participant ID tidak valid.']);
        }
        if (!isset($post['scores']) || !is_array($post['scores'])) {
            return redirect()->back()->withInput()->with('errors', ['Data nilai tidak valid.']);
        }
        // Lakukan perulangan untuk setiap indikator
        foreach ($post['scores'] as $indicator_id => $score) {
            $data = [
                'participant_id' => $participant_id,
                'indicator_id' => $indicator_id,
                'score' => $score,
                'comments' => $post['comments'][$indicator_id] ?? null,
            ];
            ParticipantAssessmentModel::create($data);
        }
        return redirect()->to('/participant-assessments')->with('success', 'Penilaian berhasil disimpan.');
    }

    public function edit($id)
    {
        // Ambil data peserta berdasarkan ID peserta, bukan ID penilaian
        $participant = ParticipantsModel::find($id);
        if (!$participant) {
            return redirect()->back()->with('errors', 'Peserta tidak ditemukan');
        }

        // Ambil data penilaian peserta berdasarkan ID peserta
        $assessments = ParticipantAssessmentModel::where('participant_id', $participant->id)->get();

        // Ambil data indikator untuk form penilaian
        $indicators = AssessmentIndicatorModel::get();

        $data = [
            'participant' => $participant,
            'assessments' => $assessments,
            'indicators' => $indicators,
        ];

        return $this->blade->render('participant_assessments.edit', $data);
    }


    public function update($id)
    {
        // Validasi data input dari form
        $validation = \Config\Services::validation();
        $validation->setRules([
            'scores' => 'required',
            'scores.*' => 'numeric|greater_than_equal_to[0]',
        ]);

        if (!$this->validate($validation->getRules())) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        // Ambil data peserta berdasarkan ID
        $participant = ParticipantsModel::find($id);
        if (!$participant) {
            throw PageNotFoundException::forPageNotFound('Peserta tidak ditemukan.');
        }

        // Ambil input data penilaian dari form
        $scores = $this->request->getPost('scores');

        foreach ($scores as $indicator_id => $score) {
            // Cek apakah penilaian sudah ada atau baru
            $assessment = ParticipantAssessmentModel::where('participant_id', $participant->id)
                ->where('indicator_id', $indicator_id)
                ->first();

            if ($assessment) {
                // Update data jika penilaian sudah ada
                $assessment->score = $score;
                $assessment->save();
            } else {
                // Simpan data baru jika penilaian belum ada
                ParticipantAssessmentModel::create([
                    'participant_id' => $participant->id,
                    'indicator_id' => $indicator_id,
                    'score' => $score,
                ]);
            }
        }

        return redirect()->to('participant-assessments')->with('success', 'Penilaian peserta berhasil diperbarui.');
    }

}
