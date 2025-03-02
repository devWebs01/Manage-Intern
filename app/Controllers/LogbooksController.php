<?php

namespace App\Controllers;

use App\Models\LogbooksModel;
use App\Libraries\BladeOneLibrary;
use CodeIgniter\HTTP\RedirectResponse;

class LogbooksController extends BaseController
{
    protected $logbookModel;

    protected $blade;
    public function __construct()
    {
        $this->logbookModel = new LogbooksModel();
        $this->blade = new BladeOneLibrary();
    }

    public function index()
    {
        $data['logbooks'] = $this->logbookModel->findAll();
        return $this->blade->render('logbooks.index', $data);
    }

    public function new()
    {
        return $this->blade->render('logbooks.create');
    }

    public function create()
    {
        $data = $this->request->getPost();
        
        if ($this->logbookModel->insert($data)) {
            return redirect()->to('/logbooks')->with('success', 'Logbook berhasil ditambahkan.');
        }
        return redirect()->back()->withInput()->with('errors', $this->logbookModel->errors());
    }

    public function edit($id)
    {
        $data['logbook'] = $this->logbookModel->find($id);
        return $this->blade->render('logbooks.edit', $data);
    }

    public function update($id)
    {
        $data = $this->request->getPost();
        if ($this->logbookModel->update($id, $data)) {
            return redirect()->to('/logbooks')->with('success', 'Logbook berhasil diperbarui.');
        }
        return redirect()->back()->withInput()->with('errors', $this->logbookModel->errors());
    }

    public function delete($id)
    {
        $this->logbookModel->delete($id);
        return redirect()->to('/logbooks')->with('success', 'Logbook berhasil dihapus.');
    } 
    
}
