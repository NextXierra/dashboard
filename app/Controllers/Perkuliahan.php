<?php

namespace App\Controllers;

use App\Models\PerkuliahanModel;
use App\Models\MahasiswaModel;
use App\Models\MatakuliahModel;
use App\Models\DosenModel;

class Perkuliahan extends BaseController
{
    protected $perkuliahanModel;
    protected $mahasiswaModel;
    protected $matakuliahModel;
    protected $dosenModel;

    public function __construct()
    {
        $this->perkuliahanModel = new PerkuliahanModel();
        $this->mahasiswaModel   = new MahasiswaModel();
        $this->matakuliahModel  = new MatakuliahModel();
        $this->dosenModel       = new DosenModel();
    }

    public function index()
    {
        $data = [
            'title'       => 'Data Perkuliahan',
            'perkuliahan' => $this->perkuliahanModel
                ->select('perkuliahan.Nim, perkuliahan.Kode_MK, perkuliahan.Nip, perkuliahan.Nilai, m.Nama_Mhs, mk.Nama_MK, d.Nama_Dosen')
                ->join('mahasiswa m', 'm.Nim = perkuliahan.Nim')
                ->join('matakuliah mk', 'mk.Kode_MK = perkuliahan.Kode_MK')
                ->join('dosen d', 'd.Nip = perkuliahan.Nip', 'left')
                ->paginate(10),
            'pager'       => $this->perkuliahanModel->pager
        ];
        return view('perkuliahan/index', $data);
    }

    public function new()
    {
        helper('form');
        $data = [
            'title'      => 'Tambah Perkuliahan',
            'mahasiswa'  => $this->mahasiswaModel->findAll(),
            'matakuliah' => $this->matakuliahModel->findAll(),
            'dosen'      => $this->dosenModel->findAll()
        ];
        return view('perkuliahan/new', $data);
    }

    public function create()
    {
        $rules = [
            'Nim'     => 'required',
            'Kode_MK' => 'required',
            'Nip'     => 'required',
            'Nilai'   => 'required|in_list[A,B,C,D,E]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $nim    = $this->request->getPost('Nim');
        $kodeMk = $this->request->getPost('Kode_MK');

        $existing = $this->perkuliahanModel->getPerkuliahan($nim, $kodeMk);
        if ($existing) {
            return redirect()->back()->withInput()->with('errors', [
                'Nim' => 'Kombinasi Mahasiswa dan Mata Kuliah ini sudah terdaftar.'
            ]);
        }

        $this->perkuliahanModel->insertData([
            'Nim'     => $nim,
            'Kode_MK' => $kodeMk,
            'Nip'     => $this->request->getPost('Nip'),
            'Nilai'   => $this->request->getPost('Nilai')
        ]);

        return redirect()->to('/perkuliahan')->with('success', 'Data Perkuliahan berhasil ditambahkan!');
    }

    public function edit($nim = null, $kodeMk = null)
    {
        if ($nim === null || $kodeMk === null) {
            return redirect()->to('/perkuliahan');
        }

        helper('form');
        $perkuliahan = $this->perkuliahanModel->getPerkuliahan($nim, $kodeMk);

        if (!$perkuliahan) {
            return redirect()->to('/perkuliahan')->with('error', 'Data Perkuliahan tidak ditemukan.');
        }

        $mhs = $this->mahasiswaModel->find($nim);
        $mk  = $this->matakuliahModel->find($kodeMk);

        $data = [
            'title'       => 'Edit Perkuliahan',
            'perkuliahan' => $perkuliahan,
            'mahasiswa'   => $mhs,
            'matakuliah'  => $mk,
            'dosen'       => $this->dosenModel->findAll()
        ];
        return view('perkuliahan/edit', $data);
    }

    public function update($nim = null, $kodeMk = null)
    {
        if ($nim === null || $kodeMk === null) {
            return redirect()->to('/perkuliahan');
        }

        $rules = [
            'Nip'   => 'required',
            'Nilai' => 'required|in_list[A,B,C,D,E]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->perkuliahanModel->updateData($nim, $kodeMk, [
            'Nip'   => $this->request->getPost('Nip'),
            'Nilai' => $this->request->getPost('Nilai')
        ]);

        return redirect()->to('/perkuliahan')->with('success', 'Data Perkuliahan berhasil diperbarui!');
    }

    public function delete($nim = null, $kodeMk = null)
    {
        if ($nim === null || $kodeMk === null) {
            return redirect()->to('/perkuliahan');
        }

        $perkuliahan = $this->perkuliahanModel->getPerkuliahan($nim, $kodeMk);
        if (!$perkuliahan) {
            return redirect()->to('/perkuliahan')->with('error', 'Data Perkuliahan tidak ditemukan.');
        }

        $this->perkuliahanModel->deleteData($nim, $kodeMk);
        return redirect()->to('/perkuliahan')->with('success', 'Data Perkuliahan berhasil dihapus!');
    }
}
