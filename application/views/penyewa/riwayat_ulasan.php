<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Ulasan</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f3f4f6;
        }
        .list-group-item {
            transition: background-color 0.3s ease, transform 0.3s ease;
        }
        .list-group-item:hover {
            background-color: #f9fafb;
            transform: translateY(-2px);
        }
        .btn-primary {
            background-color: #a52a2a; /* Maroon cerah untuk tombol */
            transition: background-color 0.3s ease;
        }
        .btn-primary:hover {
            background-color: #8b2424; /* Maroon sedikit lebih gelap saat hover */
        }
        .btn-secondary {
            background-color: #6b7280;
            transition: background-color 0.3s ease;
        }
        .btn-secondary:hover {
            background-color: #4b5563;
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
    </style>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Riwayat Ulasan</h1>
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
        <?php if (empty($riwayat_ulasan)): ?>
            <p class="text-gray-600">Belum ada riwayat ulasan.</p>
        <?php else: ?>
            <div class="space-y-4">
                <?php foreach ($riwayat_ulasan as $review): ?>
                    <a href="<?php echo base_url('home/detail/' . $review['kosan_id']); ?>" class="block bg-white rounded-lg shadow-md p-4 hover:shadow-lg transition">
                        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center mb-2">
                            <h5 class="text-lg font-semibold text-gray-800"><?php echo htmlspecialchars($review['kosan_nama']); ?></h5>
                            <small class="text-gray-500"><?php echo date('d-m-Y', strtotime($review['created_at'])); ?></small>
                        </div>
                        <p class="text-gray-600 mb-2">
                            Rating: 
                            <?php for ($i = 1; $i <= 5; $i++): ?>
                                <?php if ($i <= floor($review['rating'])): ?>
                                    <i class="bi bi-star-fill text-yellow-400"></i>
                                <?php else: ?>
                                    <i class="bi bi-star text-yellow-400"></i>
                                <?php endif; ?>
                            <?php endfor; ?>
                            <span class="text-gray-600">(<?php echo number_format($review['rating'], 1); ?>)</span>
                        </p>
                        <p class="text-gray-600"><?php echo htmlspecialchars($review['ulasan']); ?></p>
                        <div class="mt-3">
                            <a href="<?php echo base_url('penyewa/edit_ulasan/' . $review['id']); ?>" 
                               class="btn-secondary text-white font-medium py-1 px-3 rounded-lg text-sm">Edit</a>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>