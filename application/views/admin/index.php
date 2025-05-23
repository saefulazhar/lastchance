<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Inter', sans-serif;
        }
        
        .welcome-section {
            text-align: center;
            padding: 2rem 0;
            background: linear-gradient(135deg, #a60000 0%, #d63333 100%);
            color: white;
            border-radius: 0.5rem;
            margin-bottom: 2rem;
        }
        .welcome-section h1 {
            font-size: 2rem;
            font-weight: 700;
        }
        .welcome-section p {
            font-size: 1.1rem;
            opacity: 0.9;
        }
        .card {
            border: none;
            border-radius: 0.75rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }
        .card i {
            font-size: 2rem;
            color: #a60000;
        }
        .card-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: #333;
        }
        .card a {
            text-decoration: none;
            color:rgb(255, 255, 255);
            font-weight: 500;
        }
        .card a:hover {
            color: #8b0000;
        }
        .btn-maroon {
            background-color: #a60000;
            border-color: #a60000;
            color: white;
        }
        .btn-maroon:hover {
            background-color: #8b0000;
            border-color: #8b0000;
        }
        .container {
            max-width: 1200px;
        }
    </style>
</head>
<body>
    

    <!-- Main Content -->
    <div class="container mt-4">
        <!-- Welcome Section -->
        <div class="welcome-section">
            <h1>Dashboard Admin</h1>
            <p>Selamat datang, <?php echo $this->session->userdata('username'); ?>!<br>Sebagai admin, Anda dapat mengelola pengguna dan kosan di platform Horikos.</p>
        </div>

        <!-- Navigation Cards -->
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card text-center p-4">
                    <i class="fas fa-users mb-3"></i>
                    <h5 class="card-title">Daftar Pengguna</h5>
                    <a href="<?php echo base_url('admin/users'); ?>" class="btn btn-maroon btn-sm">Kelola Pengguna</a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-center p-4">
                    <i class="fas fa-file-alt mb-3"></i>
                    <h5 class="card-title">Daftar Laporan</h5>
                    <a href="<?php echo base_url('admin/daftar_laporan'); ?>" class="btn btn-maroon btn-sm">Lihat Laporan</a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-center p-4">
                    <i class="fas fa-home mb-3"></i>
                    <h5 class="card-title">Daftar Kosan</h5>
                    <a href="<?php echo base_url('admin/daftar_kosan'); ?>" class="btn btn-maroon btn-sm">Kelola Kosan</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>