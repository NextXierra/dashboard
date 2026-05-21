<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<div class="row align-items-center mb-5">
    <div class="col-md-8">
        <div class="retro-badge-header" style="background-color: #f7c945; color: #141414;">Data Akademik</div>
        <h1 class="display-5 mb-2" style="font-size: 2.8rem; letter-spacing: -1px;">TAMBAH MATA KULIAH</h1>

    </div>
    <div class="col-md-4 text-md-end mt-3 mt-md-0">
        <a href="<?= base_url('matakuliah') ?>" class="btn btn-neo px-4 py-2" style="background-color: #94a8e7;">
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
            <form action="<?= base_url('matakuliah/create') ?>" method="POST">
                <?= csrf_field() ?>
                
                <div class="neo-form-group">
                    <label for="Kode_MK">Kode Mata Kuliah</label>
                    <input type="text" class="form-control form-control-lg text-dark fw-bold border-3 border-dark" id="Kode_MK" name="Kode_MK" value="<?= old('Kode_MK') ?>" placeholder="Contoh: KOM123" required maxlength="20">
                    <small class="fw-bold text-muted mt-1 d-block">Kode MK maksimal 20 karakter unik.</small>
                </div>
                
                <div class="neo-form-group">
                    <label for="Nama_MK">Nama Mata Kuliah</label>
                    <input type="text" class="form-control form-control-lg text-dark fw-bold border-3 border-dark" id="Nama_MK" name="Nama_MK" value="<?= old('Nama_MK') ?>" placeholder="Contoh: Pemrograman Berorientasi Objek" required maxlength="100">
                </div>

                <div class="neo-form-group">
                    <label for="Sks">SKS (Satuan Kredit Semester)</label>
                    <select class="form-select form-select-lg text-dark fw-bold border-3 border-dark" id="Sks" name="Sks" required>
                        <option value="">-- Pilih Jumlah SKS --</option>
                        <option value="1" <?= old('Sks') == '1' ? 'selected' : '' ?>>1 SKS</option>
                        <option value="2" <?= old('Sks') == '2' ? 'selected' : '' ?>>2 SKS</option>
                        <option value="3" <?= old('Sks') == '3' ? 'selected' : '' ?>>3 SKS</option>
                        <option value="4" <?= old('Sks') == '4' ? 'selected' : '' ?>>4 SKS</option>
                        <option value="6" <?= old('Sks') == '6' ? 'selected' : '' ?>>6 SKS</option>
                    </select>
                </div>

                <div class="d-grid mt-4">
                    <button type="submit" class="btn btn-neo btn-primary py-3 btn-lg text-dark border-3 border-dark" style="background-color: #f7c945;">
                        <i class="fa-solid fa-circle-check me-2"></i> Simpan Mata Kuliah
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
