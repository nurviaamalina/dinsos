<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AdminFilter implements FilterInterface
{
    /**
     * Filter sebelum request dijalankan
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();

        // Belum login
        if (!$session->get('login')) {
            return redirect()->to('/login')
                ->with('error', 'Silakan login terlebih dahulu.');
        }

        // Ambil role
        $role = $session->get('role');

        // Hanya admin dan superadmin
        if (!in_array($role, ['admin', 'superadmin'])) {
            $session->destroy();

            return redirect()->to('/login')
                ->with('error', 'Anda tidak memiliki akses.');
        }
    }

    /**
     * Filter setelah request dijalankan
     */
    public function after(
        RequestInterface $request,
        ResponseInterface $response,
        $arguments = null
    ) {
        //
    }
}