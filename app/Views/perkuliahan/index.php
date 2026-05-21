<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<div class="row align-items-center mb-5">
    <div class="col-md-8">
        <div class="retro-badge-header">Data Relasional</div>
        <h1 class="display-5 mb-2" style="font-size: 2.8rem; letter-spacing: -1px;">PERKULIAHAN</h1>
        <p class="lead text-dark font-weight-bold" style="font-size: 1.15rem; font-weight: 700;">
            Kelola data KRS mahasiswa, dosen pengampu, beserta nilai mata kuliah terdaftar.
        </p>
    </div>
    <div class="col-md-4 text-md-end mt-3 mt-md-0">
        <a href="<?= base_url('perkuliahan/new') ?>" class="btn btn-neo px-4 py-2" style="background-color: #f7c945;">
            <i class="fa-solid fa-plus-minus me-2"></i> Tambah Perkuliahan
        </a>
    </div>
</div>

<?php if (session()->getFlashdata('success')): ?>
    <div class="alert border border-dark border-3 rounded-0 p-3 mb-4 d-flex align-items-center gap-3" style="background-color: #6fc59a; color: #141414; font-weight: bold; box-shadow: 4px 4px 0px #141414;">
        <i class="fa-solid fa-circle-check fa-lg"></i>
        <div><?= session()->getFlashdata('success') ?></div>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('error')): ?>
    <div class="alert border border-dark border-3 rounded-0 p-3 mb-4 d-flex align-items-center gap-3" style="background-color: #f69494; color: #141414; font-weight: bold; box-shadow: 4px 4px 0px #141414;">
        <i class="fa-solid fa-circle-xmark fa-lg"></i>
        <div><?= session()->getFlashdata('error') ?></div>
    </div>
<?php endif; ?>

<div class="neo-card">
    <div class="table-responsive">
        <table class="table table-bordered border-dark border-3 rounded-0 table-striped">
            <thead class="table-dark">
                <tr class="border-dark text-uppercase">
                    <th>Mahasiswa (NIM)</th>
                    <th>Mata Kuliah (Kode)</th>
                    <th>Dosen Pengampu</th>
                    <th style="width: 100px;" class="text-center">Nilai</th>
                    <th style="width: 200px;" class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($perkuliahan)): ?>
                    <tr class="border-dark">
                        <td colspan="5" class="text-center py-4 fw-bold text-muted">Belum ada data perkuliahan terdaftar.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($perkuliahan as $p): ?>
                        <tr class="align-middle fw-bold border-dark">
                            <td>
                                <div><?= esc($p['Nama_Mhs']) ?></div>
                                <small class="text-muted fw-bold">NIM: <?= esc($p['Nim']) ?></small>
                            </td>
                            <td>
                                <div><?= esc($p['Nama_MK']) ?></div>
                                <small class="text-muted fw-bold">Kode: <?= esc($p['Kode_MK']) ?></small>
                            </td>
                            <td>
                                <?= esc($p['Nama_Dosen'] ?? 'Belum Ditentukan') ?>
                            </td>
                            <td class="text-center">
                                <?php
                                $nilai = esc($p['Nilai']);
                                $bg = '#fff';
                                $fg = '#141414';
                                if ($nilai == 'A') { $bg = '#6fc59a'; }
                                elseif ($nilai == 'B') { $bg = '#94a8e7'; }
                                elseif ($nilai == 'C') { $bg = '#f7c945'; }
                                elseif ($nilai == 'D') { $bg = '#cd9773'; }
                                elseif ($nilai == 'E') { $bg = '#f69494'; }
                                ?>
                                <span class="badge text-dark neo-badge-nilai" style="background-color: <?= $bg ?>;"><?= $nilai ?></span>
                            </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="<?= base_url('perkuliahan/edit/' . $p['Nim'] . '/' . $p['Kode_MK']) ?>" class="btn btn-neo btn-sm py-1 px-2 text-dark" style="background-color: #6fc59a; font-size: 0.8rem;">
                                        <i class="fa-solid fa-pen-to-square"></i> Edit
                                    </a>
                                    <a href="<?= base_url('perkuliahan/delete/' . $p['Nim'] . '/' . $p['Kode_MK']) ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus perkuliahan ini?');" class="btn btn-neo btn-sm py-1 px-2 text-dark" style="background-color: #f69494; font-size: 0.8rem;">
                                        <i class="fa-solid fa-trash-can"></i> Hapus
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <?php if (isset($pager)): ?>
        <?= $pager->links() ?>
    <?php endif; ?>
</div>

<?= $this->endSection() ?>
