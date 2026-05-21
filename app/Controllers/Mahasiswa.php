<?php

namespace App\Controllers;

use App\Models\MahasiswaModel;

class Mahasiswa extends BaseController
{
    protected $mahasiswaModel;

    public function __construct()
    {
        $this->mahasiswaModel = new MahasiswaModel();
    }

    public function index()
    {
        $data = [
            'title'     => 'Data Mahasiswa',
            'mahasiswa' => $this->mahasiswaModel->paginate(10),
            'pager'     => $this->mahasiswaModel->pager
        ];
        return view('mahasiswa/index', $data);
    }

    public function new()
    {
        helper('form');
        $data = [
            'title' => 'Tambah Mahasiswa'
        ];
        return view('mahasiswa/new', $data);
    }

    public function create()
    {
        $rules = [
            'Nim'             => 'required|max_length[20]|is_unique[mahasiswa.Nim]',
            'Nama_Mhs'        => 'required|max_length[100]',
            'Jurusan'         => 'required|max_length[50]',
            'Tgl_Lahir'       => 'permit_empty|valid_date[Y-m-d]',
            'Alamat'          => 'permit_empty|max_length[100]',
            'Jenis_Kelamin'   => 'required|in_list[Laki-laki,Perempuan]',
            'Jalur_Kelulusan' => 'permit_empty|max_length[30]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->mahasiswaModel->insert([
            'Nim'             => $this->request->getPost('Nim'),
            'Nama_Mhs'        => $this->request->getPost('Nama_Mhs'),
            'Jurusan'         => $this->request->getPost('Jurusan'),
            'Tgl_Lahir'       => $this->request->getPost('Tgl_Lahir') ?: null,
            'Alamat'          => $this->request->getPost('Alamat') ?: null,
            'Jenis_Kelamin'   => $this->request->getPost('Jenis_Kelamin'),
            'Jalur_Kelulusan' => $this->request->getPost('Jalur_Kelulusan') ?: null
        ]);

        return redirect()->to('/mahasiswa')->with('success', 'Data Mahasiswa berhasil ditambahkan!');
    }

    public function edit($nim = null)
    {
        if ($nim === null) {
            return redirect()->to('/mahasiswa');
        }

        helper('form');
        $mhs = $this->mahasiswaModel->find($nim);

        if (!$mhs) {
            return redirect()->to('/mahasiswa')->with('error', 'Data Mahasiswa tidak ditemukan.');
        }

        $data = [
            'title'     => 'Edit Mahasiswa',
            'mahasiswa' => $mhs
        ];
        return view('mahasiswa/edit', $data);
    }

    public function update($nim = null)
    {
        if ($nim === null) {
            return redirect()->to('/mahasiswa');
        }

        $rules = [
            'Nama_Mhs'        => 'required|max_length[100]',
            'Jurusan'         => 'required|max_length[50]',
            'Tgl_Lahir'       => 'permit_empty|valid_date[Y-m-d]',
            'Alamat'          => 'permit_empty|max_length[100]',
            'Jenis_Kelamin'   => 'required|in_list[Laki-laki,Perempuan]',
            'Jalur_Kelulusan' => 'permit_empty|max_length[30]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->mahasiswaModel->update($nim, [
            'Nama_Mhs'        => $this->request->getPost('Nama_Mhs'),
            'Jurusan'         => $this->request->getPost('Jurusan'),
            'Tgl_Lahir'       => $this->request->getPost('Tgl_Lahir') ?: null,
            'Alamat'          => $this->request->getPost('Alamat') ?: null,
            'Jenis_Kelamin'   => $this->request->getPost('Jenis_Kelamin'),
            'Jalur_Kelulusan' => $this->request->getPost('Jalur_Kelulusan') ?: null
        ]);

        return redirect()->to('/mahasiswa')->with('success', 'Data Mahasiswa berhasil diperbarui!');
    }

    public function remove($nim = null)
    {
        return $this->delete($nim);
    }

    public function delete($nim = null)
    {
        if ($nim === null) {
            return redirect()->to('/mahasiswa');
        }

        $mhs = $this->mahasiswaModel->find($nim);
        if (!$mhs) {
            return redirect()->to('/mahasiswa')->with('error', 'Data Mahasiswa tidak ditemukan.');
        }

        try {
            $this->mahasiswaModel->delete($nim);
            return redirect()->to('/mahasiswa')->with('success', 'Data Mahasiswa berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->to('/mahasiswa')->with('error', 'Gagal menghapus data mahasiswa karena sedang digunakan dalam perkuliahan.');
        }
    }
}
