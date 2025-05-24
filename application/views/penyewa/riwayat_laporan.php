<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Laporan</title>
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
    <div class="main-content">
        <div class="container mx-auto px-4 py-6">
            <h1 class="text-3xl font-bold text-gray-800 mb-6">Riwayat Laporan</h1>
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
            <?php if (empty($laporan)): ?>
                <p class="text-gray-600">Anda belum membuat laporan.</p>
            <?php else: ?>
                <div class="overflow-x-auto">
                    <table class="table w-full bg-white rounded-lg shadow-md">
                        <thead class="thead-maroon">
                            <tr>
                                <th class="py-3 px-6 text-left font-semibold">Judul</th>
                                <th class="py-3 px-6 text-left font-semibold">Deskripsi</th>
                                <th class="py-3 px-6 text-left font-semibold">Kosan</th>
                                <th class="py-3 px-6 text-left font-semibold">Pembuat</th>
                                <th class="py-3 px-6 text-left font-semibold">Tanggal Dibuat</th>
                            </tr>
                        </thead>
                        <tbody class="table-hover">
                            <?php foreach ($laporan as $item): ?>
                                <tr class="border-b">
                                    <td class="py-3 px-6"><?php echo htmlspecialchars($item['judul']); ?></td>
                                    <td class="py-3 px-6"><?php echo htmlspecialchars($item['deskripsi']); ?></td>
                                    <td class="py-3 px-6"><?php echo htmlspecialchars($item['nama_kosan'] ?? 'Tidak Ditentukan'); ?></td>
                                    <td class="py-3 px-6"><?php echo htmlspecialchars($item['nama_user'] ?? 'Tidak Diketahui'); ?></td>
                                    <td class="py-3 px-6"><?php echo htmlspecialchars($item['created_at']); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>