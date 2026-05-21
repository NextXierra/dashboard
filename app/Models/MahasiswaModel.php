<?php

namespace App\Models;

use CodeIgniter\Model;

class MahasiswaModel extends Model
{
    protected $table            = 'mahasiswa';
    protected $primaryKey       = 'Nim';
    protected $useAutoIncrement = false;
    protected $returnType       = 'array';
    protected $protectFields    = true;
    protected $allowedFields    = ['Nim', 'Nama_Mhs', 'Jurusan', 'Tgl_Lahir', 'Alamat', 'Jenis_Kelamin', 'Jalur_Kelulusan'];
}
