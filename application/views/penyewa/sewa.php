<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajukan Pemesanan</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f3f4f6;
        }
        .form-control {
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }
        .form-control:focus {
            border-color: #a52a2a;
            box-shadow: 0 0 0 3px rgba(165, 42, 42, 0.1);
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
        .alert-danger {
            border-left-color: #dc2626;
        }
        @keyframes slideIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-6 max-w-2xl">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Ajukan Pemesanan untuk <?php echo htmlspecialchars($kosan['nama']); ?></h2>
        <?php if (validation_errors()): ?>
            <div class="alert alert-danger bg-red-100 border-l-4 text-red-700 p-4 mb-6 rounded-lg">
                <?php echo validation_errors(); ?>
            </div>
        <?php endif; ?>
        <?php if ($this->session->flashdata('error')): ?>
            <div class="alert alert-danger bg-red-100 border-l-4 text-red-700 p-4 mb-6 rounded-lg">
                <?php echo htmlspecialchars($this->session->flashdata('error')); ?>
            </div>
        <?php endif; ?>
        <?php if ($this->session->flashdata('success')): ?>
            <div class="alert alert-success bg-green-100 border-l-4 text-green-700 p-4 mb-6 rounded-lg">
                <?php echo htmlspecialchars($this->session->flashdata('success')); ?>
            </div>
        <?php endif; ?>
        <form action="<?php echo base_url('penyewa/sewa/' . $kosan['id']); ?>" method="post" class="bg-white p-6 rounded-lg shadow-md">
            <div class="mb-4">
                <label for="durasi" class="block text-gray-700 font-medium mb-2">Durasi Sewa (bulan)</label>
                <input type="number" class="form-control w-full p-2 border rounded-lg" id="durasi" name="durasi" value="<?php echo set_value('durasi'); ?>" min="1" required>
                <small class="text-red-500"><?php echo form_error('durasi'); ?></small>
            </div>
            <div class="mb-4">
                <label for="tanggal_mulai" class="block text-gray-700 font-medium mb-2">Tanggal Mulai</label>
                <input type="date" class="form-control w-full p-2 border rounded-lg" id="tanggal_mulai" name="tanggal_mulai" value="<?php echo set_value('tanggal_mulai'); ?>" required>
                <small class="text-red-500"><?php echo form_error('tanggal_mulai'); ?></small>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2">Harga per Bulan</label>
                <p class="text-gray-600">Rp <?php echo number_format($kosan['harga'], 0, ',', '.'); ?></p>
            </div>
            <div class="flex space-x-4">
                <button type="submit" class="btn-primary text-white font-medium py-2 px-4 rounded-lg">Ajukan Pemesanan</button>
                <a href="<?php echo base_url('home/detail/' . $kosan['id']); ?>" class="btn-secondary text-white font-medium py-2 px-4 rounded-lg">Kembali</a>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>