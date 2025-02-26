<?php
namespace App\Libraries;

use eftec\bladeone\BladeOne;

class BladeOneLibrary
{
    protected $blade;

    public function __construct()
    {
        // Lokasi folder view dan cache (pastikan folder cache writable)
        $views = APPPATH . 'Views';
        $cache = WRITEPATH . 'cache';
        // Gunakan MODE_AUTO agar BladeOne secara otomatis menentukan mode kompilasi
        $this->blade = new BladeOne($views, $cache, BladeOne::MODE_AUTO);
    }

    /**
     * Fungsi untuk merender view dengan BladeOne.
     *
     * @param string $template Nama file view tanpa ekstensi .blade.php (misal: 'home')
     * @param array  $data     Data yang akan dikirim ke view
     *
     * @return string Hasil render view
     */
    public function render($template, $data = [])
    {
        return $this->blade->run($template, $data);
    }
}
