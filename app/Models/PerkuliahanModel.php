<?php

namespace App\Models;

use CodeIgniter\Model;

class PerkuliahanModel extends Model
{
    protected $table            = 'perkuliahan';
    protected $protectFields    = true;
    protected $allowedFields    = ['Nim', 'Kode_MK', 'Nip', 'Nilai'];

    public function getJoinData()
    {
        return $this->db->table('perkuliahan p')
            ->select('p.Nim, p.Kode_MK, p.Nip, p.Nilai, m.Nama_Mhs, mk.Nama_MK, d.Nama_Dosen')
            ->join('mahasiswa m', 'm.Nim = p.Nim')
            ->join('matakuliah mk', 'mk.Kode_MK = p.Kode_MK')
            ->join('dosen d', 'd.Nip = p.Nip', 'left')
            ->get()
            ->getResultArray();
    }

    public function getPerkuliahan($nim, $kodeMk)
    {
        return $this->db->table('perkuliahan')
            ->where('Nim', $nim)
            ->where('Kode_MK', $kodeMk)
            ->get()
            ->getRowArray();
    }

    public function insertData($data)
    {
        return $this->db->table('perkuliahan')->insert($data);
    }

    public function updateData($nim, $kodeMk, $data)
    {
        return $this->db->table('perkuliahan')
            ->where('Nim', $nim)
            ->where('Kode_MK', $kodeMk)
            ->update($data);
    }

    public function deleteData($nim, $kodeMk)
    {
        return $this->db->table('perkuliahan')
            ->where('Nim', $nim)
            ->where('Kode_MK', $kodeMk)
            ->delete();
    }
}
