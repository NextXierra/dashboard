<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<div class="row align-items-center mb-5">
    <div class="col-md-8">
        <div class="retro-badge-header">Data Akademik</div>
        <h1 class="display-5 mb-2" style="font-size: 2.8rem; letter-spacing: -1px;">MATA KULIAH</h1>
        <p class="lead text-dark font-weight-bold" style="font-size: 1.15rem; font-weight: 700;">
            Kelola data mata kuliah aktif beserta bobot satuan kredit semester (SKS) mereka.
        </p>
    </div>
    <div class="col-md-4 text-md-end mt-3 mt-md-0">
        <a href="<?= base_url('matakuliah/new') ?>" class="btn btn-neo px-4 py-2" style="background-color: #f7c945;">
            <i class="fa-solid fa-plus me-2"></i> Tambah Mata Kuliah
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
                    <th style="width: 200px;">Kode Mata Kuliah</th>
                    <th>Nama Mata Kuliah</th>
                    <th style="width: 150px;">SKS</th>
                    <th style="width: 200px;" class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($matakuliah)): ?>
                    <tr class="border-dark">
                        <td colspan="4" class="text-center py-4 fw-bold text-muted">Belum ada data mata kuliah.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($matakuliah as $mk): ?>
                        <tr class="align-middle fw-bold border-dark">
                            <td><span class="badge bg-white text-dark border border-dark p-2" style="font-size: 0.9rem; box-shadow: 1px 1px 0px #141414;"><?= esc($mk['Kode_MK']) ?></span></td>
                            <td><?= esc($mk['Nama_MK']) ?></td>
                            <td>
                                <span class="badge text-dark border border-dark py-2 px-3" style="background-color: #f7c945; font-size: 0.9rem; box-shadow: 1px 1px 0px #141414;">
                                    <?= esc($mk['Sks']) ?> SKS
                                </span>
                            </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="<?= base_url('matakuliah/edit/' . $mk['Kode_MK']) ?>" class="btn btn-neo btn-sm py-1 px-2 text-dark" style="background-color: #6fc59a; font-size: 0.8rem;">
                                        <i class="fa-solid fa-pen-to-square"></i> Edit
                                    </a>
                                    <a href="<?= base_url('matakuliah/remove/' . $mk['Kode_MK']) ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus mata kuliah ini?');" class="btn btn-neo btn-sm py-1 px-2 text-dark" style="background-color: #f69494; font-size: 0.8rem;">
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
