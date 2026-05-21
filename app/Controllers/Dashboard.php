<?php

namespace App\Controllers;

use App\Models\MahasiswaModel;
use App\Models\DosenModel;
use App\Models\MatakuliahModel;
use App\Models\PerkuliahanModel;

class Dashboard extends BaseController
{
    public function index(): string
    {
        $dbConnected = true;
        $totalMahasiswa = 124;
        $totalDosen = 18;
        $totalMatakuliah = 32;
        $totalPerkuliahan = 86;
        $recentEnrollments = [];

        try {
            $mahasiswaModel = new MahasiswaModel();
            $dosenModel = new DosenModel();
            $matakuliahModel = new MatakuliahModel();
            $perkuliahanModel = new PerkuliahanModel();

            $totalMahasiswa = $mahasiswaModel->countAllResults();
            $totalDosen = $dosenModel->countAllResults();
            $totalMatakuliah = $matakuliahModel->countAllResults();
            $totalPerkuliahan = $perkuliahanModel->countAllResults();

            $recentEnrollments = $perkuliahanModel->getJoinData();
            if (count($recentEnrollments) > 4) {
                $recentEnrollments = array_slice($recentEnrollments, 0, 4);
            }
        } catch (\Exception $e) {
            $dbConnected = false;
        }

        if (empty($recentEnrollments)) {
            $recentEnrollments = [
                [
                    'Nim' => '101152001',
                    'Nama_Mhs' => 'Aditya Dharmawan',
                    'Kode_MK' => 'IF301',
                    'Nama_MK' => 'Rekayasa Perangkat Lunak',
                    'Nama_Dosen' => 'Dr. Eko Suryadi, M.T.',
                    'Nilai' => 'A'
                ],
                [
                    'Nim' => '101152002',
                    'Nama_Mhs' => 'Rina Wijaya',
                    'Kode_MK' => 'IF204',
                    'Nama_MK' => 'Sistem Basis Data',
                    'Nama_Dosen' => 'Dra. Sri Wahyuni, M.Kom.',
                    'Nilai' => 'B'
                ],
                [
                    'Nim' => '101152003',
                    'Nama_Mhs' => 'Budi Santoso',
                    'Kode_MK' => 'IF305',
                    'Nama_MK' => 'Pemrograman Web',
                    'Nama_Dosen' => 'Ahmad Faisal, M.T.',
                    'Nilai' => 'A'
                ],
                [
                    'Nim' => '101152004',
                    'Nama_Mhs' => 'Siti Aminah',
                    'Kode_MK' => 'IF102',
                    'Nama_MK' => 'Algoritma & Pemrograman',
                    'Nama_Dosen' => 'Prof. H. Supriadi',
                    'Nilai' => 'C'
                ]
            ];
        }

        $data['dbConnected'] = $dbConnected;
        $data['stats'] = [
            'mahasiswa' => [
                'total' => $totalMahasiswa,
                'growth' => 5.4
            ],
            'dosen' => [
                'total' => $totalDosen,
                'growth' => 0.0
            ],
            'matakuliah' => [
                'total' => $totalMatakuliah,
                'growth' => 12.5
            ],
            'perkuliahan' => [
                'total' => $totalPerkuliahan,
                'growth' => 18.2
            ]
        ];

        $data['chart'] = [
            'labels' => ['A', 'B', 'C', 'D', 'E'],
            'counts' => [28, 36, 18, 5, 2]
        ];

        $data['recentEnrollments'] = $recentEnrollments;
        $data['title'] = 'Dashboard Akademik Brutopia';

        return view('dashboard', $data);
    }
}
