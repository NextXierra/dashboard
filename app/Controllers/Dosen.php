<?php

namespace App\Controllers;

use App\Models\DosenModel;

class Dosen extends BaseController
{
    protected $dosenModel;

    public function __construct()
    {
        $this->dosenModel = new DosenModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Data Dosen',
            'dosen' => $this->dosenModel->paginate(10),
            'pager' => $this->dosenModel->pager
        ];
        return view('dosen/index', $data);
    }

    public function new()
    {
        helper('form');
        $data = [
            'title' => 'Tambah Dosen'
        ];
        return view('dosen/new', $data);
    }

    public function create()
    {
        $rules = [
            'Nip'          => 'required|max_length[20]|is_unique[dosen.Nip]',
            'Nama_Dosen'   => 'required|max_length[100]',
            'Nidn'         => 'permit_empty|max_length[20]',
            'Nuptk'        => 'permit_empty|max_length[20]',
            'Prodi'        => 'permit_empty|max_length[50]',
            'Universitas'  => 'permit_empty|max_length[100]',
            'Singkatan_PT' => 'permit_empty|max_length[20]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->dosenModel->insert([
            'Nip'          => $this->request->getPost('Nip'),
            'Nama_Dosen'   => $this->request->getPost('Nama_Dosen'),
            'Nidn'         => $this->request->getPost('Nidn') ?: null,
            'Nuptk'        => $this->request->getPost('Nuptk') ?: null,
            'Prodi'        => $this->request->getPost('Prodi') ?: null,
            'Universitas'  => $this->request->getPost('Universitas') ?: null,
            'Singkatan_PT' => $this->request->getPost('Singkatan_PT') ?: null
        ]);

        return redirect()->to('/dosen')->with('success', 'Data Dosen berhasil ditambahkan!');
    }

    public function edit($nip = null)
    {
        if ($nip === null) {
            return redirect()->to('/dosen');
        }

        helper('form');
        $dosen = $this->dosenModel->find($nip);

        if (!$dosen) {
            return redirect()->to('/dosen')->with('error', 'Data Dosen tidak ditemukan.');
        }

        $data = [
            'title' => 'Edit Dosen',
            'dosen' => $dosen
        ];
        return view('dosen/edit', $data);
    }

    public function update($nip = null)
    {
        if ($nip === null) {
            return redirect()->to('/dosen');
        }

        $rules = [
            'Nama_Dosen'   => 'required|max_length[100]',
            'Nidn'         => 'permit_empty|max_length[20]',
            'Nuptk'        => 'permit_empty|max_length[20]',
            'Prodi'        => 'permit_empty|max_length[50]',
            'Universitas'  => 'permit_empty|max_length[100]',
            'Singkatan_PT' => 'permit_empty|max_length[20]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->dosenModel->update($nip, [
            'Nama_Dosen'   => $this->request->getPost('Nama_Dosen'),
            'Nidn'         => $this->request->getPost('Nidn') ?: null,
            'Nuptk'        => $this->request->getPost('Nuptk') ?: null,
            'Prodi'        => $this->request->getPost('Prodi') ?: null,
            'Universitas'  => $this->request->getPost('Universitas') ?: null,
            'Singkatan_PT' => $this->request->getPost('Singkatan_PT') ?: null
        ]);

        return redirect()->to('/dosen')->with('success', 'Data Dosen berhasil diperbarui!');
    }

    public function remove($nip = null)
    {
        return $this->delete($nip);
    }

    public function delete($nip = null)
    {
        if ($nip === null) {
            return redirect()->to('/dosen');
        }

        $dosen = $this->dosenModel->find($nip);
        if (!$dosen) {
            return redirect()->to('/dosen')->with('error', 'Data Dosen tidak ditemukan.');
        }

        try {
            $this->dosenModel->delete($nip);
            return redirect()->to('/dosen')->with('success', 'Data Dosen berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->to('/dosen')->with('error', 'Gagal menghapus data dosen karena sedang digunakan dalam perkuliahan.');
        }
    }
}
