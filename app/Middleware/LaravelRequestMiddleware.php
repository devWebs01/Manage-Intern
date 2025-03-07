<?php

namespace App\Middleware;

use Illuminate\Http\Request as LaravelRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class LaravelRequestMiddleware implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $laravelRequest = new LaravelRequest(
            $_GET, 
            $_POST, 
            [], 
            $_COOKIE, 
            $_FILES, 
            $_SERVER
        );

        // Menyimpan instance request ke dalam container aplikasi
        app()->instance('request', $laravelRequest);
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Tidak ada tindakan khusus setelah response
    }
}
