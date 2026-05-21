<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<div class="row align-items-center mb-5">
    <div class="col-md-8">
        <div class="retro-badge-header" style="background-color: #f7c945; color: #141414;">Data Akademik</div>
        <h1 class="display-5 mb-2" style="font-size: 2.8rem; letter-spacing: -1px;">DOSEN</h1>
        <p class="lead text-dark font-weight-bold" style="font-size: 1.15rem; font-weight: 700;">
            Kelola data staf pengajar / dosen pengampu mata kuliah di sini.
        </p>
    </div>
    <div class="col-md-4 text-md-end mt-3 mt-md-0">
        <a href="<?= base_url('dosen/new') ?>" class="btn btn-neo px-4 py-2" style="background-color: #6fc59a;">
            <i class="fa-solid fa-plus me-2"></i> Tambah Dosen
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
                    <th style="width: 180px;">NIP</th>
                    <th>Nama Lengkap Dosen</th>
                    <th style="width: 120px;">NIDN</th>
                    <th style="width: 150px;">NUPTK</th>
                    <th>Prodi</th>
                    <th>Universitas</th>
                    <th style="width: 200px;" class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($dosen)): ?>
                    <tr class="border-dark">
                        <td colspan="7" class="text-center py-4 fw-bold text-muted">Belum ada data dosen.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($dosen as $d): ?>
                        <tr class="align-middle fw-bold border-dark">
                            <td><span class="badge bg-white text-dark border border-dark p-2" style="font-size: 0.9rem; box-shadow: 1px 1px 0px #141414;"><?= esc($d['Nip']) ?></span></td>
                            <td><?= esc($d['Nama_Dosen']) ?></td>
                            <td><?= esc($d['Nidn'] ?: '-') ?></td>
                            <td><?= esc($d['Nuptk'] ?: '-') ?></td>
                            <td><?= esc($d['Prodi'] ?: '-') ?></td>
                            <td>
                                <?php if ($d['Universitas']): ?>
                                    <?= esc($d['Universitas']) ?> <?= $d['Singkatan_PT'] ? '('.esc($d['Singkatan_PT']).')' : '' ?>
                                <?php else: ?>
                                    -
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="<?= base_url('dosen/edit/' . $d['Nip']) ?>" class="btn btn-neo btn-sm py-1 px-2 text-dark" style="background-color: #94a8e7; font-size: 0.8rem;">
                                        <i class="fa-solid fa-pen-to-square"></i> Edit
                                    </a>
                                    <a href="<?= base_url('dosen/remove/' . $d['Nip']) ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus dosen ini?');" class="btn btn-neo btn-sm py-1 px-2 text-dark" style="background-color: #f69494; font-size: 0.8rem;">
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
