<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<div class="row align-items-center mb-5">
    <div class="col-md-8">
        <div class="retro-badge-header" style="background-color: #6fc59a; color: #141414;">Data Akademik</div>
        <h1 class="display-5 mb-2" style="font-size: 2.8rem; letter-spacing: -1px;">EDIT MAHASISWA</h1>
        <p class="lead text-dark font-weight-bold" style="font-size: 1.15rem; font-weight: 700;">
            Memperbarui data mahasiswa <span class="text-decoration-underline"><?= esc($mahasiswa['Nama_Mhs']) ?></span> di sistem.
        </p>
    </div>
    <div class="col-md-4 text-md-end mt-3 mt-md-0">
        <a href="<?= base_url('mahasiswa') ?>" class="btn btn-neo px-4 py-2" style="background-color: #94a8e7;">
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
            <form action="<?= base_url('mahasiswa/update/' . $mahasiswa['Nim']) ?>" method="POST">
                <?= csrf_field() ?>
                
                <div class="neo-form-group">
                    <label for="Nim">NIM (Nomor Induk Mahasiswa)</label>
                    <input type="text" class="form-control form-control-lg text-dark fw-bold border-3 border-dark bg-light" id="Nim" name="Nim" value="<?= esc($mahasiswa['Nim']) ?>" readonly style="cursor: not-allowed;">
                    <small class="fw-bold text-danger mt-1 d-block"><i class="fa-solid fa-triangle-exclamation"></i> NIM adalah kunci utama tabel dan tidak dapat diubah.</small>
                </div>
                
                <div class="neo-form-group">
                    <label for="Nama_Mhs">Nama Lengkap</label>
                    <input type="text" class="form-control form-control-lg text-dark fw-bold border-3 border-dark" id="Nama_Mhs" name="Nama_Mhs" value="<?= old('Nama_Mhs', $mahasiswa['Nama_Mhs']) ?>" required maxlength="100">
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="neo-form-group">
                            <label for="Jurusan">Jurusan</label>
                            <?php $jrs = old('Jurusan', $mahasiswa['Jurusan']); ?>
                            <select class="form-select form-select-lg text-dark fw-bold border-3 border-dark" id="Jurusan" name="Jurusan" required>
                                <option value="">-- Pilih Jurusan --</option>
                                <option value="ILMU KOMPUTER" <?= $jrs == 'ILMU KOMPUTER' ? 'selected' : '' ?>>Ilmu Komputer</option>
                                <option value="MATEMATIKA" <?= $jrs == 'MATEMATIKA' ? 'selected' : '' ?>>Matematika</option>
                                <option value="FISIKA" <?= $jrs == 'FISIKA' ? 'selected' : '' ?>>Fisika</option>
                                <option value="KIMIA" <?= $jrs == 'KIMIA' ? 'selected' : '' ?>>Kimia</option>
                                <option value="BIOLOGI" <?= $jrs == 'BIOLOGI' ? 'selected' : '' ?>>Biologi</option>
                                <option value="FARMASI" <?= $jrs == 'FARMASI' ? 'selected' : '' ?>>Farmasi</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="neo-form-group">
                            <label for="Tgl_Lahir">Tanggal Lahir</label>
                            <input type="date" class="form-control form-control-lg text-dark fw-bold border-3 border-dark" id="Tgl_Lahir" name="Tgl_Lahir" value="<?= old('Tgl_Lahir', $mahasiswa['Tgl_Lahir']) ?>">
                            <small class="fw-bold text-muted mt-1 d-block">Opsional (boleh dikosongkan).</small>
                        </div>
                    </div>
                </div>

                <div class="neo-form-group">
                    <label for="Jenis_Kelamin">Jenis Kelamin</label>
                    <select class="form-select form-select-lg text-dark fw-bold border-3 border-dark" id="Jenis_Kelamin" name="Jenis_Kelamin" required>
                        <option value="Laki-laki" <?= old('Jenis_Kelamin', $mahasiswa['Jenis_Kelamin']) == 'Laki-laki' ? 'selected' : '' ?>>Laki-laki</option>
                        <option value="Perempuan" <?= old('Jenis_Kelamin', $mahasiswa['Jenis_Kelamin']) == 'Perempuan' ? 'selected' : '' ?>>Perempuan</option>
                    </select>
                </div>

                <div class="neo-form-group">
                    <label for="Jalur_Kelulusan">Jalur Kelulusan</label>
                    <input type="text" class="form-control form-control-lg text-dark fw-bold border-3 border-dark" id="Jalur_Kelulusan" name="Jalur_Kelulusan" value="<?= old('Jalur_Kelulusan', $mahasiswa['Jalur_Kelulusan'] ?? '') ?>" placeholder="Contoh: SNBP, SNBT, Mandiri" maxlength="30">
                    <small class="fw-bold text-muted mt-1 d-block">Opsional (boleh dikosongkan).</small>
                </div>

                <div class="neo-form-group">
                    <label for="Alamat">Alamat Tempat Tinggal</label>
                    <textarea class="form-control text-dark fw-bold border-3 border-dark" id="Alamat" name="Alamat" rows="3" maxlength="100"><?= old('Alamat', $mahasiswa['Alamat']) ?></textarea>
                    <small class="fw-bold text-muted mt-1 d-block">Opsional (boleh dikosongkan).</small>
                </div>

                <div class="d-grid mt-4">
                    <button type="submit" class="btn btn-neo btn-primary py-3 btn-lg text-dark border-3 border-dark" style="background-color: #6fc59a;">
                        <i class="fa-solid fa-square-check me-2"></i> Perbarui Data Mahasiswa
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
