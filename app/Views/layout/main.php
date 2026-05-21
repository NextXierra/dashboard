 <!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Dashboard Brutopia' ?></title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inconsolata:wght@400;700;900&family=Syne:wght@700;800&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <link rel="stylesheet" href="<?= base_url('css/bootstrap.min.css') ?>">
    
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">

    <?= $this->renderSection('styles') ?>
</head>
<body>

    <aside class="sidebar" id="sidebar">
        <div class="sidebar-logo">
            <h2>
                <i class="fa-solid fa-shapes text-dark"></i>
                <span>BRUTOPIA.</span>
            </h2>
        </div>
        
        <?php $uri = service('uri'); ?>
        <ul class="nav-menu">
            <li class="nav-item-custom <?= ($uri->getTotalSegments() == 0) ? 'active' : '' ?>">
                <a href="<?= base_url('/') ?>">
                    <i class="fa-solid fa-chart-simple"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item-custom <?= ($uri->getTotalSegments() > 0 && $uri->getSegment(1) == 'mahasiswa') ? 'active' : '' ?>">
                <a href="<?= base_url('mahasiswa') ?>">
                    <i class="fa-solid fa-graduation-cap"></i>
                    <span>Mahasiswa</span>
                </a>
            </li>
            <li class="nav-item-custom <?= ($uri->getTotalSegments() > 0 && $uri->getSegment(1) == 'dosen') ? 'active' : '' ?>">
                <a href="<?= base_url('dosen') ?>">
                    <i class="fa-solid fa-chalkboard-user"></i>
                    <span>Dosen</span>
                </a>
            </li>
            <li class="nav-item-custom <?= ($uri->getTotalSegments() > 0 && $uri->getSegment(1) == 'matakuliah') ? 'active' : '' ?>">
                <a href="<?= base_url('matakuliah') ?>">
                    <i class="fa-solid fa-book-open"></i>
                    <span>Mata Kuliah</span>
                </a>
            </li>
            <!-- Perkuliahan menu hidden -->
        </ul>
        
        <div class="mt-5 p-3 text-center border-top border-dark">
            <span class="badge bg-dark p-2 text-white border border-dark rounded-pill shadow-sm" style="font-size: 0.85rem;">
                v1.0 - Neo-Brutalist
            </span>
        </div>
    </aside>

    <div class="main-wrapper">
        <nav class="top-navbar">
            <button class="mobile-toggle" id="sidebarToggle">
                <i class="fa-solid fa-bars"></i>
            </button>
            
            <div class="top-navbar-search">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" placeholder="Cari data, laporan, atau perintah...">
            </div>
            
            <div class="d-flex align-items-center gap-3">
                <a href="#" class="btn btn-outline-dark p-2 rounded-circle border-2 d-none d-sm-flex align-items-center justify-content-center" style="width: 42px; height: 42px; box-shadow: 2px 2px 0px #141414;">
                    <i class="fa-regular fa-bell"></i>
                </a>
                
                <a href="#" class="user-profile">
                    <div class="user-avatar">AR</div>
                    <span class="d-none d-md-inline">Aditya R.</span>
                </a>
            </div>
        </nav>

        <main class="content-container">
            <?= $this->renderSection('content') ?>
        </main>
    </div>

    <script src="<?= base_url('js/bootstrap.bundle.min.js') ?>"></script>
    <script src="<?= base_url('js/script.js') ?>"></script>

    <?= $this->renderSection('scripts') ?>
</body>
</html>
