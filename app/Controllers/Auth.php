<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class Auth extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    /**
     * Halaman Login
     */
    public function login()
    {
        // Jika sudah login, langsung ke dashboard
        if (session()->get('login')) {
            return redirect()->to('/admin/dashboard');
        }

        return view('auth/login');
    }

    /**
     * Proses Login
     */
    public function prosesLogin()
    {
        $username = trim($this->request->getPost('username'));
        $password = $this->request->getPost('password');

        // Validasi input
        if ($username === '' || $password === '') {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Username dan password wajib diisi.');
        }

        // Cari user berdasarkan username
        $user = $this->userModel
            ->where('username', $username)
            ->first();

        // Username tidak ditemukan
        if (!$user) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Username atau password salah.');
        }

        // Cek status akun
        if ((int) $user['active'] !== 1) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Akun Anda tidak aktif.');
        }

        // Cek password
        if (!password_verify($password, $user['password'])) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Username atau password salah.');
        }

        // Hanya superadmin dan admin yang boleh masuk
        if (!in_array($user['role'], ['superadmin', 'admin'])) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Anda tidak memiliki akses ke halaman admin.');
        }

        // Regenerasi session untuk keamanan
        session()->regenerate();

        // Simpan data login ke session
        session()->set([
            'login'    => true,
            'user_id'  => $user['id'],
            'username' => $user['username'],
            'role'     => $user['role'],
        ]);

        // Masuk ke dashboard
        return redirect()->to('/admin/dashboard');
    }

    /**
     * Logout
     */
    public function logout()
    {
        session()->destroy();

        return redirect()->to('/login')
            ->with('success', 'Anda berhasil logout.');
    }
}