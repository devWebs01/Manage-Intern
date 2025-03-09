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
        $this->blade           = new BladeOneLibrary();
    }

    public function index()
    {
        // Tampilkan seluruh data penilaian peserta; Anda bisa filter berdasarkan participant_id jika diperlukan
        $data['assessments'] = ParticipantsModel::latest()->get();
        return $this->blade->render('participant_assessments.index', $data);
    }

    public function new()
    {
        // Untuk membuat penilaian baru, ambil semua indikator penilaian
        $data['indicators'] = AssessmentIndicatorModel::get();
        $data['participants'] = ParticipantsModel::latest()->get();
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
                'indicator_id'   => $indicator_id,
                'score'          => $score,
                'comments'       => $post['comments'][$indicator_id] ?? null,
            ];
            ParticipantAssessmentModel::create($data);
        }
        return redirect()->to('/participant-assessments')->with('success', 'Penilaian berhasil disimpan.');
    }

    public function edit($id)
    {
        $assessment = ParticipantAssessmentModel::find($id);
        if (!$assessment) {
            throw new PageNotFoundException('Penilaian tidak ditemukan');
        }
        $data['assessment'] = $assessment;
        // Jika diperlukan, ambil indikator untuk mengedit nilai
        $data['indicator'] = AssessmentIndicatorModel::find($assessment->indicator_id);
        return $this->blade->render('participant_assessments.edit', $data);
    }

    public function update($id)
    {
        $data = $this->request->getPost();
        if (!ParticipantAssessmentModel::update($id, $data)) {
            return redirect()->back()->withInput()->with('errors', ParticipantAssessmentModel::errors());
        }
        return redirect()->to('/participant-assessments')->with('success', 'Penilaian berhasil diperbarui.');
    }

    public function delete($id)
    {
        $assessment = ParticipantAssessmentModel::find($id);
        
        $assessment->delete();
        return redirect()->to('/participant-assessments')->with('success', 'Penilaian berhasil dihapus.');
    }
}
