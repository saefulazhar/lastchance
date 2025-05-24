<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Penyewa</title>
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
        .btn-danger {
            background-color: #dc2626;
            transition: background-color 0.3s ease;
        }
        .btn-danger:hover {
            background-color: #b91c1c;
        }
        .table th, .table td {
            vertical-align: middle;
        }
        .alert {
            animation: slideIn 0.5s ease;
        }
        .thead-maroon {
            background-color: #a52a2a; /* Maroon cerah untuk header tabel */
            color: white;
        }
        .alert-success {
            border-left-color: #a52a2a; /* Maroon cerah untuk border alert */
        }
        @keyframes slideIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body class="min-h-screen">
    <div class="flex flex-col min-h-screen">
        <!-- Konten Utama -->
        <div class="flex-grow flex flex-col">
            <!-- Area Konten -->
            <main class="flex-grow p-6 bg-gray-100">
                <h1 class="text-3xl font-bold text-gray-800 mb-6">Dashboard Penyewa</h1>
                <?php if ($this->session->flashdata('success')): ?>
                    <div class="alert alert-success bg-green-100 border-l-4 text-green-700 p-4 mb-6 rounded-lg">
                        <?php echo $this->session->flashdata('success'); ?>
                    </div>
                <?php endif; ?>
                <?php if ($this->session->flashdata('error')): ?>
                    <div class="alert bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-lg">
                        <?php echo $this->session->flashdata('error'); ?>
                    </div>
                <?php endif; ?>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <div class="card bg-white rounded-lg shadow-md p-6">
                        <h5 class="text-xl font-semibold text-gray-800 mb-2">Sewa Aktif</h5>
                        <p class="text-gray-600 mb-4">Anda memiliki <strong><?php echo isset($active_sewa_count) ? $active_sewa_count : 0; ?></strong> sewa aktif saat ini.</p>
                        <a href="<?php echo base_url('penyewa/my_sewa'); ?>" class="btn-primary text-white font-medium py-2 px-4 rounded-lg">Lihat Riwayat Sewa</a>
                    </div>
                    <div class="card bg-white rounded-lg shadow-md p-6">
                        <h5 class="text-xl font-semibold text-gray-800 mb-2">Ulasan Anda</h5>
                        <p class="text-gray-600 mb-4">Anda telah memberikan <strong><?php echo isset($ulasan_count) ? $ulasan_count : 0; ?></strong> ulasan.</p>
                        <a href="<?php echo base_url('penyewa/riwayat_ulasan'); ?>" class="btn-primary text-white font-medium py-2 px-4 rounded-lg">Lihat Riwayat Ulasan</a>
                    </div>
                </div>
                <h2 class="text-2xl font-bold text-gray-800 mb-4">Pemesanan Saya</h2>
                <?php if (!empty($pemesanan)): ?>
                    <div class="overflow-x-auto">
                        <table class="table w-full bg-white rounded-lg shadow-md">
                            <thead class="thead-maroon">
                                <tr>
                                    <th class="py-3 px-6 text-left font-semibold">Nama Kosan</th>
                                    <th class="py-3 px-6 text-left font-semibold">Tanggal Mulai</th>
                                    <th class="py-3 px-6 text-left font-semibold">Tanggal Selesai</th>
                                    <th class="py-3 px-6 text-left font-semibold">Status</th>
                                    <th class="py-3 px-6 text-left font-semibold">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($pemesanan as $pem): ?>
                                    <tr class="border-b hover:bg-gray-50">
                                        <td class="py-3 px-6"><?php echo htmlspecialchars($pem['nama_kosan']); ?></td>
                                        <td class="py-3 px-6"><?php echo htmlspecialchars($pem['tanggal_mulai']); ?></td>
                                        <td class="py-3 px-6"><?php echo htmlspecialchars($pem['tanggal_selesai']); ?></td>
                                        <td class="py-3 px-6"><?php echo htmlspecialchars($pem['status']); ?></td>
                                        <td class="py-3 px-6">
                                            <?php if ($pem['status'] === 'menunggu'): ?>
                                                <a href="<?php echo base_url('penyewa/cancel_pemesanan/' . $pem['id']); ?>" 
                                                   class="btn-danger text-white font-medium py-1 px-3 rounded-lg"
                                                   onclick="return confirm('Yakin ingin membatalkan pemesanan?');">Batalkan</a>
                                            <?php else: ?>
                                                <span class="text-gray-500">Tidak dapat dibatalkan</span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <p class="mt-3 text-gray-600">Anda belum memiliki pemesanan.</p>
                <?php endif; ?>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>