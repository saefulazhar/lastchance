<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($title) ? $title : 'HORIKOS'; ?></title>
    <!-- Bootstrap 5 CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
        }
        .content-wrapper {
            display: flex;
            flex: 1; /* Mengisi ruang sisa di antara header dan footer */
        }
        .sidebar {
            width: 250px;
            background-color: #343a40;
            color: white;
            min-height: 100vh;
        }
        .main-content {
            flex: 1; /* Mengisi ruang sisa di samping sidebar */
            padding: 20px;
        }
        footer {
            background-color: #343a40;
            color: white;
            text-align: center;
            padding: 10px;
            width: 100%;
        }
        @media (max-width: 768px) {
            .content-wrapper {
                flex-direction: column;
            }
            .sidebar {
                width: 100%;
                min-height: auto;
            }
            .main-content {
                padding: 10px;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?php echo base_url(); ?>">HORIKOS</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url('home'); ?>">Cari Kosan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url('home/tentang'); ?>">Tentang</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url('home/kontak'); ?>">Kontak</a>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <?php if (!$this->session->userdata('logged_in')): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo base_url('auth/login'); ?>">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo base_url('auth/register'); ?>">Register</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <?php
                            $foto_profil = $this->session->userdata('foto_profil') ? base_url('uploads/profile/' . $this->session->userdata('foto_profil')) : base_url('assets/default-profile.png');
                            ?>
                            <a class="nav-link" href="<?php echo base_url('penyewa') ?: base_url('pemilik') ?: base_url('admin'); ?>">
                                <img src="<?php echo $foto_profil; ?>" alt="Profil" class="rounded-circle" style="width: 30px; height: 30px;">
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo base_url('auth/logout'); ?>">Logout</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <div class="content-wrapper">
        <?php if (isset($show_sidebar) && $show_sidebar): ?>
            <?php $this->load->view('templates/sidebar'); ?>
        <?php endif; ?>

        <div class="main-content">
            <?php if (isset($content_view)) $this->load->view($content_view, isset($data) ? $data : []); ?>
        </div>
    </div>

    <?php $this->load->view('templates/footer'); ?>
</body>
</html>