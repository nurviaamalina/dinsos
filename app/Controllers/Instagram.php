<?php

namespace App\Controllers;

class Instagram extends BaseController
{
    public function index()
    {
        /*
        |--------------------------------------------------------------------------
        | DATA DUMMY SEMENTARA
        |--------------------------------------------------------------------------
        | Ini hanya untuk melihat tampilan halaman.
        | Nanti ketika database Instagram sudah dibuat,
        | bagian ini akan diganti dengan data dari InstagramModel.
        */

        $instagram = [

            [
                'id' => 1,
                'caption' => 'Pemutakhiran DTKS Semester II dimulai serentak di 24 kecamatan',
                'tanggal' => '28 Juli 2026',
                'gambar' => null,
                'permalink' => '#',
            ],

            [
                'id' => 2,
                'caption' => 'Pemutakhiran DTKS Semester II dimulai serentak di 24 kecamatan',
                'tanggal' => '28 Juli 2026',
                'gambar' => null,
                'permalink' => '#',
            ],

            [
                'id' => 3,
                'caption' => 'Pemutakhiran DTKS Semester II dimulai serentak di 24 kecamatan',
                'tanggal' => '28 Juli 2026',
                'gambar' => null,
                'permalink' => '#',
            ],

            [
                'id' => 4,
                'caption' => 'Pemutakhiran DTKS Semester II dimulai serentak di 24 kecamatan',
                'tanggal' => '28 Juli 2026',
                'gambar' => null,
                'permalink' => '#',
            ],

            [
                'id' => 5,
                'caption' => 'Pemutakhiran DTKS Semester II dimulai serentak di 24 kecamatan',
                'tanggal' => '28 Juli 2026',
                'gambar' => null,
                'permalink' => '#',
            ],

            [
                'id' => 6,
                'caption' => 'Pemutakhiran DTKS Semester II dimulai serentak di 24 kecamatan',
                'tanggal' => '28 Juli 2026',
                'gambar' => null,
                'permalink' => '#',
            ],

        ];


        return view(
            'instagram/index',
            [
                'title' => 'Feed Instagram',
                'instagram' => $instagram,
            ]
        );
    }
}