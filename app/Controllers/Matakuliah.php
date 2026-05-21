<?php

namespace App\Controllers;

use App\Models\MatakuliahModel;

class Matakuliah extends BaseController
{
    protected $matakuliahModel;

    public function __construct()
    {
        $this->matakuliahModel = new MatakuliahModel();
    }

    public function index()
    {
        $data = [
            'title'      => 'Data Mata Kuliah',
            'matakuliah' => $this->matakuliahModel->paginate(10),
            'pager'      => $this->matakuliahModel->pager
        ];
        return view('matakuliah/index', $data);
    }

    public function new()
    {
        helper('form');
        $data = [
            'title' => 'Tambah Mata Kuliah'
        ];
        return view('matakuliah/new', $data);
    }

    public function create()
    {
        $rules = [
            'Kode_MK' => 'required|max_length[20]|is_unique[matakuliah.Kode_MK]',
            'Nama_MK' => 'required|max_length[100]',
            'Sks'     => 'required|integer|greater_than_equal_to[1]|less_than_equal_to[6]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->matakuliahModel->insert([
            'Kode_MK' => $this->request->getPost('Kode_MK'),
            'Nama_MK' => $this->request->getPost('Nama_MK'),
            'Sks'     => $this->request->getPost('Sks')
        ]);

        return redirect()->to('/matakuliah')->with('success', 'Data Mata Kuliah berhasil ditambahkan!');
    }

    public function edit($kode = null)
    {
        if ($kode === null) {
            return redirect()->to('/matakuliah');
        }

        helper('form');
        $mk = $this->matakuliahModel->find($kode);

        if (!$mk) {
            return redirect()->to('/matakuliah')->with('error', 'Data Mata Kuliah tidak ditemukan.');
        }

        $data = [
            'title'      => 'Edit Mata Kuliah',
            'matakuliah' => $mk
        ];
        return view('matakuliah/edit', $data);
    }

    public function update($kode = null)
    {
        if ($kode === null) {
            return redirect()->to('/matakuliah');
        }

        $rules = [
            'Nama_MK' => 'required|max_length[100]',
            'Sks'     => 'required|integer|greater_than_equal_to[1]|less_than_equal_to[6]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->matakuliahModel->update($kode, [
            'Nama_MK' => $this->request->getPost('Nama_MK'),
            'Sks'     => $this->request->getPost('Sks')
        ]);

        return redirect()->to('/matakuliah')->with('success', 'Data Mata Kuliah berhasil diperbarui!');
    }

    public function remove($kode = null)
    {
        return $this->delete($kode);
    }

    public function delete($kode = null)
    {
        if ($kode === null) {
            return redirect()->to('/matakuliah');
        }

        $mk = $this->matakuliahModel->find($kode);
        if (!$mk) {
            return redirect()->to('/matakuliah')->with('error', 'Data Mata Kuliah tidak ditemukan.');
        }

        try {
            $this->matakuliahModel->delete($kode);
            return redirect()->to('/matakuliah')->with('success', 'Data Mata Kuliah berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->to('/matakuliah')->with('error', 'Gagal menghapus data mata kuliah karena sedang digunakan dalam perkuliahan.');
        }
    }
}
