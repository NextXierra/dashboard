<?php

namespace App\Models;

use CodeIgniter\Model;

class DosenModel extends Model
{
    protected $table            = 'dosen';
    protected $primaryKey       = 'Nip';
    protected $useAutoIncrement = false;
    protected $returnType       = 'array';
    protected $protectFields    = true;
    protected $allowedFields    = ['Nip', 'Nama_Dosen', 'Nidn', 'Nuptk', 'Prodi', 'Universitas', 'Singkatan_PT'];
}
