<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;

class ManajemenUser extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    /**
     * Menampilkan daftar user
     */
    public function index()
    {
        $search = trim($this->request->getGet('search') ?? '');
        $status = $this->request->getGet('status');

        // Statistik Keseluruhan
        $totalUser     = (new UserModel())->countAllResults();
        $totalAdmin    = (new UserModel())->whereIn('role', ['admin', 'superadmin'])->countAllResults();
        $totalAktif    = (new UserModel())->where('active', 1)->countAllResults();
        $totalNonaktif = (new UserModel())->where('active', 0)->countAllResults();

        // Query Builder untuk Data Tabel
        $builder = $this->userModel->orderBy('id', 'DESC');

        if ($search !== '') {
            $builder->groupStart()
                ->like('username', $search)
                ->orLike('email', $search)
            ->groupEnd();
        }

        if ($status !== null && $status !== '') {
            $builder->where('active', (int) $status);
        }

        // Paginasi: 8 data per halaman sesuai tampilan referensi
        $perPage = 8;
        $users   = $builder->paginate($perPage);
        $pager   = $this->userModel->pager;

        $currentPage = (int) ($this->request->getVar('page') ?? 1);
        if ($currentPage < 1) {
            $currentPage = 1;
        }

        $totalRows   = $pager ? $pager->getTotal() : count($users);
        $startNumber = $totalRows > 0 ? (($currentPage - 1) * $perPage) + 1 : 0;
        $endNumber   = min($currentPage * $perPage, $totalRows);

        $data = [
            'title'         => 'Manajemen User',
            'users'         => $users,
            'pager'         => $pager,
            'search'        => $search,
            'status'        => $status,
            'totalUser'     => $totalUser,
            'totalAdmin'    => $totalAdmin,
            'totalAktif'    => $totalAktif,
            'totalNonaktif' => $totalNonaktif,
            'totalRows'     => $totalRows,
            'startNumber'   => $startNumber,
            'endNumber'     => $endNumber,
        ];

        return view('admin/manajemen-user/index', $data);
    }

    /**
     * Form tambah user
     */
    public function create()
    {
        return view('admin/manajemen-user/create', [
            'title' => 'Tambah User',
        ]);
    }

    /**
     * Simpan user baru
     */
    public function store()
    {
        $username = trim($this->request->getPost('username') ?? '');
        $email    = trim($this->request->getPost('email') ?? '');
        $password = $this->request->getPost('password');
        $active   = $this->request->getPost('active');

        // ==============================
        // VALIDASI USERNAME
        // ==============================
        if ($username === '') {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Username wajib diisi.');
        }

        if (strlen($username) < 3) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Username minimal 3 karakter.');
        }

        // ==============================
        // VALIDASI EMAIL
        // ==============================
        if ($email === '') {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Email wajib diisi.');
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Format email tidak valid.');
        }

        // ==============================
        // VALIDASI PASSWORD
        // ==============================
        if (empty($password)) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Password wajib diisi.');
        }

        if (strlen($password) < 6) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Password minimal 6 karakter.');
        }

        // ==============================
        // CEK USERNAME SUDAH ADA
        // ==============================
        $existingUsername = $this->userModel
            ->where('username', $username)
            ->first();

        if ($existingUsername) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Username sudah digunakan.');
        }

        // ==============================
        // CEK EMAIL SUDAH ADA
        // ==============================
        $existingEmail = $this->userModel
            ->where('email', $email)
            ->first();

        if ($existingEmail) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Email sudah digunakan.');
        }

        // ==============================
        // SIMPAN USER (ROLE SELALU ADMIN)
        // ==============================
        $this->userModel->insert([
            'username' => $username,
            'email'    => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'role'     => 'admin',
            'active'   => ($active === '1' || $active === 1) ? 1 : 0,
        ]);

        return redirect()
            ->to('/admin/manajemen-user')
            ->with('success', 'User berhasil ditambahkan.');
    }

    /**
     * Form edit user
     */
    public function edit($id)
    {
        $user = $this->userModel->find($id);

        if (!$user) {
            return redirect()
                ->to('/admin/manajemen-user')
                ->with('error', 'User tidak ditemukan.');
        }

        // Superadmin tidak boleh diedit
        if ($user['role'] === 'superadmin') {
            return redirect()
                ->to('/admin/manajemen-user')
                ->with('error', 'Akun superadmin tidak dapat diedit.');
        }

        return view('admin/manajemen-user/edit', [
            'title' => 'Edit User',
            'user'  => $user,
        ]);
    }

    /**
     * Update user
     */
    public function update($id)
    {
        $user = $this->userModel->find($id);

        if (!$user) {
            return redirect()
                ->to('/admin/manajemen-user')
                ->with('error', 'User tidak ditemukan.');
        }

        // Superadmin tidak boleh diubah
        if ($user['role'] === 'superadmin') {
            return redirect()
                ->to('/admin/manajemen-user')
                ->with('error', 'Akun superadmin tidak dapat diubah.');
        }

        $username = trim($this->request->getPost('username') ?? '');
        $email    = trim($this->request->getPost('email') ?? '');
        $password = $this->request->getPost('password');
        $active   = $this->request->getPost('active');

        // ==============================
        // VALIDASI USERNAME
        // ==============================
        if ($username === '') {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Username wajib diisi.');
        }

        if (strlen($username) < 3) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Username minimal 3 karakter.');
        }

        // ==============================
        // VALIDASI EMAIL
        // ==============================
        if ($email === '') {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Email wajib diisi.');
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Format email tidak valid.');
        }

        // ==============================
        // CEK USERNAME USER LAIN
        // ==============================
        $existingUsername = $this->userModel
            ->where('username', $username)
            ->where('id !=', $id)
            ->first();

        if ($existingUsername) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Username sudah digunakan.');
        }

        // ==============================
        // CEK EMAIL USER LAIN
        // ==============================
        $existingEmail = $this->userModel
            ->where('email', $email)
            ->where('id !=', $id)
            ->first();

        if ($existingEmail) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Email sudah digunakan.');
        }

        // ==============================
        // DATA UPDATE
        // ==============================
        $data = [
            'username' => $username,
            'email'    => $email,
            'role'     => 'admin',
            'active'   => ($active === '1' || $active === 1) ? 1 : 0,
        ];

        // Password hanya diubah jika diisi
        if (!empty($password)) {
            if (strlen($password) < 6) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Password minimal 6 karakter.');
            }
            $data['password'] = password_hash($password, PASSWORD_DEFAULT);
        }

        $this->userModel->update($id, $data);

        return redirect()
            ->to('/admin/manajemen-user')
            ->with('success', 'User berhasil diperbarui.');
    }

    /**
     * Aktif / nonaktif user
     */
    public function toggle($id)
    {
        $user = $this->userModel->find($id);

        if (!$user) {
            return redirect()
                ->to('/admin/manajemen-user')
                ->with('error', 'User tidak ditemukan.');
        }

        if ($user['role'] === 'superadmin') {
            return redirect()
                ->to('/admin/manajemen-user')
                ->with('error', 'Status superadmin tidak dapat diubah.');
        }

        // Cegah menonaktifkan akun sendiri
        if ((int) $id === (int) session()->get('user_id')) {
            return redirect()
                ->to('/admin/manajemen-user')
                ->with('error', 'Anda tidak dapat mengubah status akun Anda sendiri.');
        }

        $newStatus = ((int) $user['active'] === 1) ? 0 : 1;

        $this->userModel->update($id, [
            'active' => $newStatus,
        ]);

        $message = $newStatus === 1
            ? 'User berhasil diaktifkan.'
            : 'User berhasil dinonaktifkan.';

        return redirect()
            ->to('/admin/manajemen-user')
            ->with('success', $message);
    }

    /**
     * Hapus user
     */
    public function delete($id)
    {
        $user = $this->userModel->find($id);

        if (!$user) {
            return redirect()
                ->to('/admin/manajemen-user')
                ->with('error', 'User tidak ditemukan.');
        }

        if ($user['role'] === 'superadmin') {
            return redirect()
                ->to('/admin/manajemen-user')
                ->with('error', 'Akun superadmin tidak dapat dihapus.');
        }

        // Cegah menghapus akun sendiri
        if ((int) $id === (int) session()->get('user_id')) {
            return redirect()
                ->to('/admin/manajemen-user')
                ->with('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
        }

        $this->userModel->delete($id);

        return redirect()
            ->to('/admin/manajemen-user')
            ->with('success', 'User berhasil dihapus.');
    }
}