<?php

namespace App\Controllers;

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
             'title'   => 'Halaman Utama',
             'message' => 'Selamat datang di CodeIgniter dengan BladeOne'
         ];
 
         // Render view 'home.blade.php' yang berada di folder Views
         return $this->blade->render('dashboard', $data);

    }
}
