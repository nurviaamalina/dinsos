<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    // =====================================================
    // LOGIN
    // =====================================================

    public function login()
    {
        // Jika sudah login, langsung ke admin
        if (session()->get('login') === true) {
            return redirect()->to('/admin/dokumen');
        }

        return view('auth/login');
    }


    // =====================================================
    // PROSES LOGIN
    // =====================================================

    public function prosesLogin()
    {
        $username = trim($this->request->getPost('username'));
        $password = $this->request->getPost('password');

        if ($username === '' || $password === '') {

            return redirect()->back()
                ->withInput()
                ->with(
                    'error',
                    'Username dan kata sandi wajib diisi.'
                );
        }

        // Cari username
        $user = $this->userModel
            ->where('username', $username)
            ->first();

        // Username tidak ditemukan
        if (!$user) {

            return redirect()->back()
                ->withInput()
                ->with(
                    'error',
                    'Username atau kata sandi salah.'
                );
        }

        // Cek password
        if (!password_verify($password, $user['password'])) {

            return redirect()->back()
                ->withInput()
                ->with(
                    'error',
                    'Username atau kata sandi salah.'
                );
        }

        // Regenerate session
        session()->regenerate(true);

        // Simpan session
        session()->set([
            'id'       => $user['id'],
            'username' => $user['username'],
            'email'    => $user['email'] ?? null,
            'login'    => true
        ]);

        // Ambil URL yang sebelumnya ingin dibuka
        $redirect = session()->get('redirect_after_login');

        if ($redirect) {

            session()->remove('redirect_after_login');

            return redirect()->to($redirect);
        }

        // Default
        return redirect()->to('/admin/dokumen')
            ->with(
                'success',
                'Selamat datang, ' . $user['username'] . '!'
            );
    }


    // =====================================================
    // REGISTER
    // =====================================================

    public function register()
    {
        // Jika sudah login
        if (session()->get('login') === true) {
            return redirect()->to('/admin/dokumen');
        }

        return view('auth/register');
    }


    // =====================================================
    // PROSES REGISTER
    // =====================================================

    public function prosesRegister()
    {
        $username = trim($this->request->getPost('username'));
        $email = trim($this->request->getPost('email'));
        $password = $this->request->getPost('password');
        $confirmPassword = $this->request->getPost('confirm_password');


        // Username
        if ($username === '') {

            return redirect()->back()
                ->withInput()
                ->with(
                    'error',
                    'Username wajib diisi.'
                );
        }


        // Email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

            return redirect()->back()
                ->withInput()
                ->with(
                    'error',
                    'Format email tidak valid.'
                );
        }


        // Password
        if (strlen($password) < 6) {

            return redirect()->back()
                ->withInput()
                ->with(
                    'error',
                    'Kata sandi minimal 6 karakter.'
                );
        }


        // Konfirmasi password
        if ($password !== $confirmPassword) {

            return redirect()->back()
                ->withInput()
                ->with(
                    'error',
                    'Konfirmasi kata sandi tidak cocok.'
                );
        }


        // Cek username
        $cekUsername = $this->userModel
            ->where('username', $username)
            ->first();

        if ($cekUsername) {

            return redirect()->back()
                ->withInput()
                ->with(
                    'error',
                    'Username sudah digunakan.'
                );
        }


        // Cek email
        $cekEmail = $this->userModel
            ->where('email', $email)
            ->first();

        if ($cekEmail) {

            return redirect()->back()
                ->withInput()
                ->with(
                    'error',
                    'Email sudah digunakan.'
                );
        }


        // Simpan user
        $this->userModel->insert([
            'username' => $username,
            'email'    => $email,
            'password' => password_hash(
                $password,
                PASSWORD_DEFAULT
            )
        ]);


        return redirect()->to('/login')
            ->with(
                'success',
                'Registrasi berhasil. Silakan login.'
            );
    }


    // =====================================================
    // LOGOUT
    // =====================================================

    public function logout()
    {
        session()->destroy();

        return redirect()->to('/login')
            ->with(
                'success',
                'Anda telah berhasil logout.'
            );
    }
}