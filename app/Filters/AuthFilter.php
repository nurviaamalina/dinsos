<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthFilter implements FilterInterface
{
    public function before(
        RequestInterface $request,
        $arguments = null
    ) {

        // Jika belum login
        if (session()->get('login') !== true) {

            // Simpan URL yang ingin dibuka
            session()->set(
                'redirect_after_login',
                current_url()
            );

            return redirect()->to('/login')
                ->with(
                    'error',
                    'Silakan login terlebih dahulu.'
                );
        }
    }


    public function after(
        RequestInterface $request,
        ResponseInterface $response,
        $arguments = null
    ) {
        //
    }
}