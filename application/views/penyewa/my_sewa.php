<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Sewa Saya</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f3f4f6;
        }
        .table th, .table td {
            vertical-align: middle;
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
        .btn-warning {
            background-color: #f59e0b;
            transition: background-color 0.3s ease;
        }
        .btn-warning:hover {
            background-color: #d97706;
        }
        .alert {
            animation: slideIn 0.5s ease;
        }
        .alert-success {
            border-left-color: #a52a2a; /* Maroon cerah untuk border alert */
        }
        .thead-maroon {
            background-color: #a52a2a; /* Maroon cerah untuk header tabel */
            color: white;
        }
        .table-hover tbody tr:hover {
            background-color: #f9fafb;
        }
        @keyframes slideIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body class="bg-gray-100">
    <div class="flex-grow-1 d-flex flex-column">
        <main class="flex-grow-1 p-4 bg-gray-100">
            <div class="container mx-auto px-4 py-6">
                <h1 class="text-3xl font-bold text-gray-800 mb-6">Riwayat Sewa Saya</h1>
                <?php if ($this->session->flashdata('success')): ?>
                    <div class="alert alert-success bg-green-100 border-l-4 text-green-700 p-4 mb-6 rounded-lg">
                        <?php echo htmlspecialchars($this->session->flashdata('success')); ?>
                    </div>
                <?php endif; ?>
                <?php if ($this->session->flashdata('error')): ?>
                    <div class="alert alert-danger bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-lg">
                        <?php echo htmlspecialchars($this->session->flashdata('error')); ?>
                    </div>
                <?php endif; ?>

                <!-- Pemesanan (Menunggu Konfirmasi) -->
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Menunggu Konfirmasi</h2>
                <?php if (!empty($menunggu)): ?>
                    <div class="overflow-x-auto">
                        <table class="table w-full bg-white rounded-lg shadow-md mb-8">
                            <thead class="thead-maroon">
                                <tr>
                                    <th class="py-3 px-6 text-left font-semibold">Nama Kosan</th>
                                    <th class="py-3 px-6 text-left font-semibold">Tanggal Mulai</th>
                                    <th class="py-3 px-6 text-left font-semibold">Tanggal Selesai</th>
                                    <th class="py-3 px-6 text-left font-semibold">Status</th>
                                    <th class="py-3 px-6 text-left font-semibold">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="table-hover">
                                <?php foreach ($menunggu as $pem): ?>
                                    <tr class="border-b">
                                        <td class="py-3 px-6"><?php echo htmlspecialchars($pem['nama_kosan']); ?></td>
                                        <td class="py-3 px-6"><?php echo htmlspecialchars(date('d-m-Y', strtotime($pem['tanggal_mulai']))); ?></td>
                                        <td class="py-3 px-6"><?php echo htmlspecialchars(date('d-m-Y', strtotime($pem['tanggal_selesai']))); ?></td>
                                        <td class="py-3 px-6"><?php echo htmlspecialchars(ucfirst($pem['status'] ?? 'Menunggu')); ?></td>
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
                    <p class="text-gray-600 mb-8">Anda belum memiliki pemesanan.</p>
                <?php endif; ?>

                <!-- Sewa Aktif -->
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Sewa Aktif</h2>
                <?php if (!empty($sewa_aktif)): ?>
                    <div class="overflow-x-auto">
                        <table class="table w-full bg-white rounded-lg shadow-md mb-8">
                            <thead class="thead-maroon">
                                <tr>
                                    <th class="py-3 px-6 text-left font-semibold">Nama Kosan</th>
                                    <th class="py-3 px-6 text-left font-semibold">Tanggal Mulai</th>
                                    <th class="py-3 px-6 text-left font-semibold">Tanggal Selesai</th>
                                    <th class="py-3 px-6 text-left font-semibold">Status</th>
                                    <th class="py-3 px-6 text-left font-semibold">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="table-hover">
                                <?php foreach ($sewa_aktif as $sewa): ?>
                                    <tr class="border-b">
                                        <td class="py-3 px-6"><?php echo htmlspecialchars($sewa['nama_kosan']); ?></td>
                                        <td class="py-3 px-6"><?php echo htmlspecialchars(date('d-m-Y', strtotime($sewa['tanggal_mulai']))); ?></td>
                                        <td class="py-3 px-6"><?php echo htmlspecialchars(date('d-m-Y', strtotime($sewa['tanggal_selesai']))); ?></td>
                                        <td class="py-3 px-6"><?php echo htmlspecialchars(ucfirst($sewa['status'] ?? 'Aktif')); ?></td>
                                        <td class="py-3 px-6">
                                            <div class="flex flex-col space-y-2">
                                                <?php if (!$sewa['has_ulasan']): ?>
                                                    <a href="<?php echo base_url('penyewa/beri_ulasan/' . $sewa['kosan_id']); ?>" 
                                                       class="btn-primary text-white font-medium py-1 px-3 rounded-lg">Beri Ulasan</a>
                                                <?php endif; ?>
                                                <?php if ($sewa['can_report']): ?>
                                                    <a href="<?php echo base_url('penyewa/buat_laporan/' . $sewa['kosan_id']); ?>" 
                                                       class="btn-warning text-white font-medium py-1 px-3 rounded-lg">Laporkan</a>
                                                <?php else: ?>
                                                    <span class="text-gray-500">Anda sudah melaporkan kosan ini. Tunggu hingga <?php echo htmlspecialchars($sewa['next_report_date']); ?> untuk melaporkan lagi.</span>
                                                <?php endif; ?>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <p class="text-gray-600 mb-8">Anda belum memiliki sewa aktif.</p>
                <?php endif; ?>

                <!-- Sewa Selesai -->
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Sewa Selesai</h2>
                <?php if (!empty($sewa_selesai)): ?>
                    <div class="overflow-x-auto">
                        <table class="table w-full bg-white rounded-lg shadow-md mb-8">
                            <thead class="thead-maroon">
                                <tr>
                                    <th class="py-3 px-6 text-left font-semibold">Nama Kosan</th>
                                    <th class="py-3 px-6 text-left font-semibold">Tanggal Mulai</th>
                                    <th class="py-3 px-6 text-left font-semibold">Tanggal Selesai</th>
                                    <th class="py-3 px-6 text-left font-semibold">Status</th>
                                    <th class="py-3 px-6 text-left font-semibold">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="table-hover">
                                <?php foreach ($sewa_selesai as $sewa): ?>
                                    <tr class="border-b">
                                        <td class="py-3 px-6"><?php echo htmlspecialchars($sewa['nama_kosan']); ?></td>
                                        <td class="py-3 px-6"><?php echo htmlspecialchars(date('d-m-Y', strtotime($sewa['tanggal_mulai']))); ?></td>
                                        <td class="py-3 px-6"><?php echo htmlspecialchars(date('d-m-Y', strtotime($sewa['tanggal_selesai']))); ?></td>
                                        <td class="py-3 px-6"><?php echo htmlspecialchars(ucfirst($sewa['status'] ?? 'Selesai')); ?></td>
                                        <td class="py-3 px-6">
                                            <div class="flex flex-col space-y-2">
                                                <?php if (!$sewa['has_ulasan']): ?>
                                                    <a href="<?php echo base_url('penyewa/beri_ulasan/' . $sewa['kosan_id']); ?>" 
                                                       class="btn-primary text-white font-medium py-1 px-3 rounded-lg">Beri Ulasan</a>
                                                <?php endif; ?>
                                                <?php if ($sewa['can_report']): ?>
                                                    <a href="<?php echo base_url('penyewa/buat_laporan/' . $sewa['kosan_id']); ?>" 
                                                       class="btn-warning text-white font-medium py-1 px-3 rounded-lg">Laporkan</a>
                                                <?php else: ?>
                                                    <span class="text-gray-500">Anda sudah melaporkan kosan ini. Tunggu hingga <?php echo htmlspecialchars($sewa['next_report_date']); ?> untuk melaporkan lagi.</span>
                                                <?php endif; ?>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <p class="text-gray-600 mb-8">Anda belum memiliki sewa yang selesai.</p>
                <?php endif; ?>
            </div>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>