<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Libraries\BladeOneLibrary;
use App\Models\LogbooksModel;
use App\Models\ParticipantsModel;
use App\Models\PresencesModel;
use App\Models\CompanyProfileModel;
use CodeIgniter\HTTP\ResponseInterface;

class InternshipsController extends BaseController
{
    protected $blade;

    public function __construct()
    {
        // Inisialisasi model dan BladeOneLibrary
        $this->blade        = new BladeOneLibrary();
    }
    public function index()
    {   

        if (User()->role === 'ADMIN') {
            $data['participants'] = ParticipantsModel::get();
        } elseif (User()->role === 'MENTOR') {
            $data['participants'] = ParticipantsModel::where('mentor_id', User()->id)->get();
        } 
            
        return $this->blade->render('internships.index', $data);
    }

    public function show($id)
    {
        $data['participant'] = ParticipantsModel::find($id);

        $data['presences']  = PresencesModel::where('participant_id', $id)
                              ->get();
        $data['logbooks']  = LogbooksModel::where('participant_id', $id)
                              ->get();

                              $data['company'] = CompanyProfileModel::first();

        return $this->blade->render('internships.show', $data);
    }

 public function print($id)
    {
        $data['participant'] = ParticipantsModel::find($id);

        $data['presences']  = PresencesModel::where('participant_id', $id)
                              ->get();
        $data['logbooks']  = LogbooksModel::where('participant_id', $id)
                              ->get();

                              $data['company'] = CompanyProfileModel::first();

        return $this->blade->render('internships.print', $data);
    }    
}
