<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Sewa</title>
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
        .btn-success {
            background-color: #22c55e;
            transition: background-color 0.3s ease;
        }
        .btn-success:hover {
            background-color: #16a34a;
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
    <div class="container mx-auto px-4 py-6">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Manajemen Sewa</h2>
        <?php if ($this->session->flashdata('success')): ?>
            <div class="alert alert-success bg-green-100 border-l-4 text-green-700 p-4 mb-6 rounded-lg">
                <?php echo htmlspecialchars($this->session->flashdata('success')); ?>
            </div>
        <?php endif; ?>
        <?php if ($this->session->flashdata('error')): ?>
            <div class="alert bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-lg">
                <?php echo htmlspecialchars($this->session->flashdata('error')); ?>
            </div>
        <?php endif; ?>
        <?php if (!empty($sewa) && is_array($sewa)): ?>
            <div class="overflow-x-auto">
                <table class="table w-full bg-white rounded-lg shadow-md">
                    <thead class="thead-maroon">
                        <tr>
                            <th class="py-3 px-6 text-left font-semibold">Kosan</th>
                            <th class="py-3 px-6 text-left font-semibold">Penyewa</th>
                            <th class="py-3 px-6 text-left font-semibold">Tanggal Mulai</th>
                            <th class="py-3 px-6 text-left font-semibold">Tanggal Selesai</th>
                            <th class="py-3 px-6 text-left font-semibold">Total Harga</th>
                            <th class="py-3 px-6 text-left font-semibold">Status</th>
                            <th class="py-3 px-6 text-left font-semibold">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="table-hover">
                        <?php foreach ($sewa as $s): ?>
                            <tr class="border-b">
                                <td class="py-3 px-6"><?php echo htmlspecialchars($s['nama_kosan']); ?></td>
                                <td class="py-3 px-6"><?php echo htmlspecialchars($s['penyewa_username']); ?></td>
                                <td class="py-3 px-6"><?php echo htmlspecialchars($s['tanggal_mulai']); ?></td>
                                <td class="py-3 px-6"><?php echo htmlspecialchars($s['tanggal_selesai']); ?></td>
                                <td class="py-3 px-6">
                                    <?php
                                    if (isset($s['harga_kosan']) && $s['harga_kosan']) {
                                        $start = new DateTime($s['tanggal_mulai']);
                                        $end = new DateTime($s['tanggal_selesai']);
                                        $interval = $start->diff($end);
                                        $months = $interval->y * 12 + $interval->m + ($interval->d > 0 ? 1 : 0);
                                        $total_harga = $s['harga_kosan'] * $months;
                                        echo 'Rp ' . number_format($total_harga, 0, ',', '.');
                                    } else {
                                        echo 'N/A';
                                    }
                                    ?>
                                </td>
                                <td class="py-3 px-6"><?php echo htmlspecialchars($s['status']); ?></td>
                                <td class="py-3 px-6">
                                    <?php if ($s['status'] == 'menunggu'): ?>
                                        <div class="flex space-x-2">
                                            <a href="<?php echo base_url('pemilik/terima_sewa/' . $s['id']); ?>" 
                                               class="btn-success text-white font-medium py-1 px-3 rounded-lg"
                                               onclick="return confirm('Yakin ingin menerima pemesanan ini?');">Terima</a>
                                            <a href="<?php echo base_url('pemilik/tolak_sewa/' . $s['id']); ?>" 
                                               class="btn-danger text-white font-medium py-1 px-3 rounded-lg"
                                               onclick="return confirm('Yakin ingin menolak pemesanan ini?');">Tolak</a>
                                        </div>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <p class="text-gray-600">Belum ada pemesanan untuk kosan Anda.</p>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>