<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<?php if (!$dbConnected): ?>
    <div class="alert border border-dark border-3 rounded-0 p-3 mb-4 d-flex align-items-center justify-content-between gap-3" style="background-color: #f7c945; color: #141414; font-weight: bold; box-shadow: 4px 4px 0px #141414;">
        <div class="d-flex align-items-center gap-3">
            <i class="fa-solid fa-triangle-exclamation fa-xl"></i>
            <div><strong>MODE SIMULASI:</strong> Akses basis data belum aktif. Sistem saat ini menampilkan simulasi data akademik.</div>
        </div>
        <span class="badge bg-dark text-white p-2 border border-dark rounded">OFFLINE</span>
    </div>
<?php endif; ?>

<div class="row align-items-center mb-5">
    <div class="col-md-8">
        <div class="retro-badge-header">Ringkasan Sistem</div>
        <h1 class="display-5 mb-2" style="font-size: 2.8rem; letter-spacing: -1px;">DASHBOARD AKADEMIK</h1>
        <p class="lead text-dark font-weight-bold" style="font-size: 1.15rem; font-weight: 700;">
            Selamat datang kembali di Portal Administratif. Berikut status data akademik terkini.
        </p>
    </div>
    <div class="col-md-4 text-md-end mt-3 mt-md-0">
        <a href="<?= base_url('perkuliahan') ?>" class="btn btn-neo px-4 py-2" style="background-color: #94a8e7;">
            <i class="fa-solid fa-graduation-cap me-2"></i> Lihat Perkuliahan
        </a>
    </div>
</div>

<div class="row mb-4">
    <div class="col-xl-3 col-sm-6 mb-4">
        <div class="neo-card h-100" style="background-color: #94a8e7;">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <span class="text-dark fw-bold text-uppercase" style="font-size: 0.9rem;">Total Mahasiswa</span>
                    <h3 class="display-6 my-2 fw-black" style="font-size: 2.2rem; font-family: 'Syne', sans-serif;"><?= number_format($stats['mahasiswa']['total']) ?></h3>
                </div>
                <div class="bg-white border border-dark p-2 rounded shadow-sm">
                    <i class="fa-solid fa-user-graduate fa-xl text-dark"></i>
                </div>
            </div>
            <div class="mt-3">
                <span class="text-dark fw-bold" style="font-size: 0.85rem;">Semester ini</span>
            </div>
        </div>
    </div>
    
    <div class="col-xl-3 col-sm-6 mb-4">
        <div class="neo-card h-100" style="background-color: #f7c945;">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <span class="text-dark fw-bold text-uppercase" style="font-size: 0.9rem;">Total Dosen</span>
                    <h3 class="display-6 my-2 fw-black" style="font-size: 2.2rem; font-family: 'Syne', sans-serif;"><?= number_format($stats['dosen']['total']) ?></h3>
                </div>
                <div class="bg-white border border-dark p-2 rounded shadow-sm">
                    <i class="fa-solid fa-chalkboard-user fa-xl text-dark"></i>
                </div>
            </div>
            <div class="mt-3">
                <span class="text-dark fw-bold" style="font-size: 0.85rem;">Staf aktif</span>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-sm-6 mb-4">
        <div class="neo-card h-100" style="background-color: #6fc59a;">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <span class="text-dark fw-bold text-uppercase" style="font-size: 0.9rem;">Mata Kuliah</span>
                    <h3 class="display-6 my-2 fw-black" style="font-size: 2.2rem; font-family: 'Syne', sans-serif;"><?= number_format($stats['matakuliah']['total']) ?></h3>
                </div>
                <div class="bg-white border border-dark p-2 rounded shadow-sm">
                    <i class="fa-solid fa-book-open fa-xl text-dark"></i>
                </div>
            </div>
            <div class="mt-3">
                <span class="text-dark fw-bold" style="font-size: 0.85rem;">Kurikulum baru</span>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-sm-6 mb-4">
        <div class="neo-card h-100" style="background-color: #aa57e2; color: #fff;">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <span class="fw-bold text-uppercase text-white" style="font-size: 0.9rem;">Kelas Terdaftar</span>
                    <h3 class="display-6 my-2 fw-black text-white" style="font-size: 2.2rem; font-family: 'Syne', sans-serif;"><?= number_format($stats['perkuliahan']['total']) ?></h3>
                </div>
                <div class="bg-white border border-dark p-2 rounded shadow-sm">
                    <i class="fa-solid fa-file-signature fa-xl text-dark"></i>
                </div>
            </div>
            <div class="mt-3">
                <span class="text-white fw-bold" style="font-size: 0.85rem;">KRS Mahasiswa</span>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
