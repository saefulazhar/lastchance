<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pemilik</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f3f4f6;
        }
        .card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
        }
        .btn-primary {
            background-color: #a52a2a; /* Maroon cerah untuk tombol */
            transition: background-color 0.3s ease;
        }
        .btn-primary:hover {
            background-color: #8b2424; /* Maroon sedikit lebih gelap saat hover */
        }
        .btn-warning {
            background-color: #f59e0b;
            transition: background-color 0.3s ease;
        }
        .btn-warning:hover {
            background-color: #d97706;
        }
        .btn-danger {
            background-color: #dc2626;
            transition: background-color 0.3s ease;
        }
        .btn-danger:hover {
            background-color: #b91c1c;
        }
        .alert {
            animation: slideIn 0.5s ease;
        }
        .alert-success {
            border-left-color: #a52a2a; /* Maroon cerah untuk border alert */
        }
        @keyframes slideIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .card-img-top {
            height: 200px;
            object-fit: cover;
        }
    </style>
</head>
<body class="min-h-screen">
    <div class="container mx-auto mt-6 px-4">
        <h1 class="text-3xl font-bold text-gray-800 mb-4">Dashboard Pemilik</h1>
        <p class="text-gray-600 mb-2">Selamat datang, <strong><?php echo $this->session->userdata('username'); ?>!</strong></p>
        <p class="text-gray-600 mb-6">Sebagai pemilik, Anda dapat mengelola kosan Anda dan melihat pemesanan dari penyewa.</p>
        <div class="flex space-x-4 mb-6">
            <a href="<?php echo base_url('pemilik/tambah_kosan'); ?>" class="btn-primary text-white font-medium py-2 px-4 rounded-lg">Tambah Kosan Baru</a>
            <a href="<?php echo base_url('pemilik/sewa'); ?>" class="btn-primary text-white font-medium py-2 px-4 rounded-lg">Daftar Sewa</a>
        </div>
        <?php if ($this->session->flashdata('success')): ?>
            <div class="alert alert-success bg-green-100 border-l-4 text-green-700 p-4 mb-6 rounded-lg">
                <?php echo $this->session->flashdata('success'); ?>
            </div>
        <?php endif; ?>
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Daftar Kosan Anda</h2>
        <?php if (empty($kosan)): ?>
            <p class="text-gray-600">Belum ada kosan yang ditambahkan.</p>
        <?php else: ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php foreach ($kosan as $k): ?>
                    <div class="card bg-white rounded-lg shadow-md overflow-hidden">
                        <?php
                        $foto_paths = explode(',', $k['foto_paths']);
                        $first_foto = !empty($foto_paths[0]) ? base_url($foto_paths[0]) : base_url('assets/default-kosan.png');
                        ?>
                        <img src="<?php echo $first_foto; ?>" class="card-img-top" alt="Foto Kosan">
                        <div class="p-5">
                            <h5 class="text-xl font-semibold text-gray-800 mb-2"><?php echo htmlspecialchars($k['nama']); ?></h5>
                            <p class="text-gray-600 mb-2">Rp <?php echo number_format($k['harga'], 0, ',', '.'); ?> / bulan</p>
                            <p class="text-gray-600 mb-4"><?php echo htmlspecialchars($k['alamat']); ?></p>
                            <div class="flex space-x-2">
                                <a href="<?php echo base_url('pemilik/edit_kosan/' . $k['id']); ?>" class="btn-warning text-white font-medium py-1 px-3 rounded-lg">Edit</a>
                                <a href="<?php echo base_url('pemilik/hapus_kosan/' . $k['id']); ?>" 
                                   class="btn-danger text-white font-medium py-1 px-3 rounded-lg" 
                                   onclick="return confirm('Yakin ingin menghapus kosan ini?')">Hapus</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>