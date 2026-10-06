<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\InstagramModel;
use App\Libraries\InstagramSyncService;

class Instagram extends BaseController
{
    protected $instagramModel;

    public function __construct()
    {
        $this->instagramModel = new InstagramModel();

        helper(['form', 'text']);
    }

    public function index()
{
    $keyword = $this->request->getGet('keyword');

    if ($keyword) {
        $instagram = $this->instagramModel
            ->groupStart()
                ->like('judul', $keyword)
                ->orLike('caption', $keyword)
                ->orLike('instagram_id', $keyword)
            ->groupEnd()
            ->orderBy('posted_at', 'DESC')
            ->paginate(10);
    } else {
        $instagram = $this->instagramModel
            ->orderBy('posted_at', 'DESC')
            ->paginate(10);
    }

    $data = [
        'title'     => 'Feed Instagram',
        'instagram' => $instagram,
        'pager'     => $this->instagramModel->pager,
        'keyword'   => $keyword
    ];

    return view('Admin/Instagram/index', $data);
}

    public function sync()
{
    try {
        $result = (new InstagramSyncService())->sync();

        if (!empty($result['status'])) {
            return redirect()
                ->to(base_url('admin/instagram'))
                ->with(
                    'success',
                    'Sinkronisasi berhasil. ' .
                    'Data baru: ' . ($result['posting_baru'] ?? 0) .
                    ', diperbarui: ' . ($result['posting_update'] ?? 0) .
                    ', dihapus: ' . ($result['posting_dihapus'] ?? 0)
                );
        }

        return redirect()
            ->to(base_url('admin/instagram'))
            ->with(
                'error',
                $result['message'] ?? 'Sinkronisasi gagal.'
            );

    } catch (\Throwable $e) {
        return redirect()
            ->to(base_url('admin/instagram'))
            ->with(
                'error',
                'Gagal melakukan sinkronisasi Instagram: ' . $e->getMessage()
            );
    }
}
}