<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<div class="row align-items-center mb-5">
    <div class="col-md-8">
        <div class="retro-badge-header" style="background-color: #94a8e7; color: #141414;">Data Akademik</div>
        <h1 class="display-5 mb-2" style="font-size: 2.8rem; letter-spacing: -1px;">MAHASISWA</h1>

    </div>
    <div class="col-md-4 text-md-end mt-3 mt-md-0">
        <a href="<?= base_url('mahasiswa/new') ?>" class="btn btn-neo px-4 py-2" style="background-color: #f7c945;">
            <i class="fa-solid fa-plus me-2"></i> Tambah Mahasiswa
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
                    <th style="width: 150px;">NIM</th>
                    <th>Nama Lengkap</th>
                    <th>Jurusan</th>
                    <th style="width: 140px;">Jalur Kelulusan</th>
                    <th style="width: 120px;">Tgl Lahir</th>
                    <th>Alamat</th>
                    <th style="width: 140px;">Jenis Kelamin</th>
                    <th style="width: 180px;" class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($mahasiswa)): ?>
                    <tr class="border-dark">
                        <td colspan="8" class="text-center py-4 fw-bold text-muted">Belum ada data mahasiswa.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($mahasiswa as $m): ?>
                        <tr class="align-middle fw-bold border-dark">
                            <td><span class="badge bg-white text-dark border border-dark p-2" style="font-size: 0.9rem; box-shadow: 1px 1px 0px #141414;"><?= esc($m['Nim']) ?></span></td>
                            <td><?= esc($m['Nama_Mhs']) ?></td>
                            <td><?= esc($m['Jurusan']) ?></td>
                            <td><span class="badge bg-light text-dark border border-dark py-1 px-2" style="font-size: 0.8rem; box-shadow: 1px 1px 0px #141414;"><?= esc($m['Jalur_Kelulusan'] ?: '-') ?></span></td>
                            <td><?= ($m['Tgl_Lahir'] && $m['Tgl_Lahir'] !== '0000-00-00') ? date('d-m-Y', strtotime($m['Tgl_Lahir'])) : '-' ?></td>
                            <td><?= esc($m['Alamat'] ?: '-') ?></td>
                            <td>
                                <?php if ($m['Jenis_Kelamin'] == 'Laki-laki'): ?>
                                    <span class="badge text-dark border border-dark py-2 px-3" style="background-color: #94a8e7; font-size: 0.8rem; box-shadow: 1px 1px 0px #141414;">Laki-laki</span>
                                <?php else: ?>
                                    <span class="badge text-dark border border-dark py-2 px-3" style="background-color: #aa57e2; color: #fff !important; font-size: 0.8rem; box-shadow: 1px 1px 0px #141414;">Perempuan</span>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="<?= base_url('mahasiswa/edit/' . $m['Nim']) ?>" class="btn btn-neo btn-sm py-1 px-2 text-dark" style="background-color: #6fc59a; font-size: 0.8rem;">
                                        <i class="fa-solid fa-pen-to-square"></i> Edit
                                    </a>
                                    <a href="<?= base_url('mahasiswa/remove/' . $m['Nim']) ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus mahasiswa ini?');" class="btn btn-neo btn-sm py-1 px-2 text-dark" style="background-color: #f69494; font-size: 0.8rem;">
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
