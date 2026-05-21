<?php

namespace App\Models;

use CodeIgniter\Model;

class MatakuliahModel extends Model
{
    protected $table            = 'matakuliah';
    protected $primaryKey       = 'Kode_MK';
    protected $useAutoIncrement = false;
    protected $returnType       = 'array';
    protected $protectFields    = true;
    protected $allowedFields    = ['Kode_MK', 'Nama_MK', 'Sks'];
}
