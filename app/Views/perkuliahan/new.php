<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<div class="row align-items-center mb-5">
    <div class="col-md-8">
        <div class="retro-badge-header" style="background-color: #f7c945; color: #141414;">Data Relasional</div>
        <h1 class="display-5 mb-2" style="font-size: 2.8rem; letter-spacing: -1px;">TAMBAH PERKULIAHAN</h1>
        <p class="lead text-dark font-weight-bold" style="font-size: 1.15rem; font-weight: 700;">
            Daftarkan KRS mahasiswa baru, tentukan mata kuliah, dosen pengampu, dan nilai akhirnya.
        </p>
    </div>
    <div class="col-md-4 text-md-end mt-3 mt-md-0">
        <a href="<?= base_url('perkuliahan') ?>" class="btn btn-neo px-4 py-2" style="background-color: #94a8e7;">
            <i class="fa-solid fa-arrow-left me-2"></i> Kembali ke List
        </a>
    </div>
</div>

<?php if (session()->getFlashdata('errors')): ?>
    <div class="alert border border-dark border-3 rounded-0 p-3 mb-4" style="background-color: #f69494; color: #141414; box-shadow: 4px 4px 0px #141414;">
        <div class="fw-bold mb-2"><i class="fa-solid fa-circle-exclamation me-2"></i> Mohon perbaiki kesalahan input berikut:</div>
        <ul class="mb-0 fw-bold">
            <?php foreach (session()->getFlashdata('errors') as $error): ?>
                <li><?= esc($error) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<div class="row">
    <div class="col-lg-12">
        <div class="neo-card" style="background-color: #fff; border-bottom: 8px solid #141414;">
            <form action="<?= base_url('perkuliahan/create') ?>" method="POST">
                <?= csrf_field() ?>
                
                <div class="neo-form-group">
                    <label for="Nim">Pilih Mahasiswa</label>
                    <select class="form-select form-select-lg text-dark fw-bold border-3 border-dark" id="Nim" name="Nim" required>
                        <option value="">-- Pilih Mahasiswa --</option>
                        <?php foreach($mahasiswa as $m): ?>
                            <option value="<?= esc($m['Nim']) ?>" <?= old('Nim') == $m['Nim'] ? 'selected' : '' ?>>
                                <?= esc($m['Nama_Mhs']) ?> (NIM: <?= esc($m['Nim']) ?>)
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="neo-form-group">
                    <label for="Kode_MK">Pilih Mata Kuliah</label>
                    <select class="form-select form-select-lg text-dark fw-bold border-3 border-dark" id="Kode_MK" name="Kode_MK" required>
                        <option value="">-- Pilih Mata Kuliah --</option>
                        <?php foreach($matakuliah as $mk): ?>
                            <option value="<?= esc($mk['Kode_MK']) ?>" <?= old('Kode_MK') == $mk['Kode_MK'] ? 'selected' : '' ?>>
                                <?= esc($mk['Nama_MK']) ?> (<?= esc($mk['Sks']) ?> SKS - Kode: <?= esc($mk['Kode_MK']) ?>)
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="neo-form-group">
                    <label for="Nip">Pilih Dosen Pengampu</label>
                    <select class="form-select form-select-lg text-dark fw-bold border-3 border-dark" id="Nip" name="Nip" required>
                        <option value="">-- Pilih Dosen Pengampu --</option>
                        <?php foreach($dosen as $d): ?>
                            <option value="<?= esc($d['Nip']) ?>" <?= old('Nip') == $d['Nip'] ? 'selected' : '' ?>>
                                <?= esc($d['Nama_Dosen']) ?> (NIP: <?= esc($d['Nip']) ?>)
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="neo-form-group">
                    <label for="Nilai">Nilai Akhir</label>
                    <select class="form-select form-select-lg text-dark fw-bold border-3 border-dark" id="Nilai" name="Nilai" required>
                        <option value="">-- Pilih Nilai Akhir --</option>
                        <option value="A" <?= old('Nilai') == 'A' ? 'selected' : '' ?>>A</option>
                        <option value="B" <?= old('Nilai') == 'B' ? 'selected' : '' ?>>B</option>
                        <option value="C" <?= old('Nilai') == 'C' ? 'selected' : '' ?>>C</option>
                        <option value="D" <?= old('Nilai') == 'D' ? 'selected' : '' ?>>D</option>
                        <option value="E" <?= old('Nilai') == 'E' ? 'selected' : '' ?>>E</option>
                    </select>
                </div>

                <div class="d-grid mt-4">
                    <button type="submit" class="btn btn-neo btn-primary py-3 btn-lg text-dark border-3 border-dark" style="background-color: #f7c945;">
                        <i class="fa-solid fa-circle-check me-2"></i> Daftarkan Perkuliahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
