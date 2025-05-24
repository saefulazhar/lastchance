<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kosan</title>
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
        .btn-outline-secondary {
            border-color: #a52a2a;
            color: #a52a2a;
            transition: background-color 0.3s ease, color 0.3s ease;
        }
        .btn-outline-secondary:hover {
            background-color: #a52a2a;
            color: white;
        }
        .btn-outline-danger {
            border-color: #dc2626;
            color: #dc2626;
            transition: background-color 0.3s ease, color 0.3s ease;
        }
        .btn-outline-danger:hover {
            background-color: #dc2626;
            color: white;
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
        .img-thumbnail {
            width: 100%;
            height: 100px;
            object-fit: cover;
        }
    </style>
</head>
<body class="min-h-screen  justify-center">
    <div class="container mx-auto px-4 py-6 max-w-2xl">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Edit Kosan: <?php echo htmlspecialchars($kosan['nama']); ?></h1>
        <?php if ($this->session->flashdata('success')): ?>
            <div class="alert alert-success bg-green-100 border-l-4 text-green-700 p-4 mb-6 rounded-lg">
                <?php echo htmlspecialchars($this->session->flashdata('success')); ?>
            </div>
        <?php endif; ?>
        <?php if ($this->session->flashdata('error') || validation_errors()): ?>
            <div class="alert bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-lg">
                <?php echo htmlspecialchars($this->session->flashdata('error') ?: validation_errors()); ?>
            </div>
        <?php endif; ?>
        <form method="post" action="<?php echo base_url('pemilik/edit_kosan/' . $kosan['id']); ?>" enctype="multipart/form-data" id="form-edit-kosan" class="bg-white p-6 rounded-lg shadow-md">
            <div class="mb-4">
                <label for="nama" class="block text-gray-700 font-medium mb-2">Nama Kosan</label>
                <input type="text" class="form-control w-full p-2 border rounded-lg" id="nama" name="nama" value="<?php echo set_value('nama', $kosan['nama']); ?>" required>
            </div>
            <div class="mb-4">
                <label for="alamat" class="block text-gray-700 font-medium mb-2">Alamat</label>
                <textarea class="form-control w-full p-2 border rounded-lg" id="alamat" name="alamat" required rows="4"><?php echo set_value('alamat', $kosan['alamat']); ?></textarea>
            </div>
            <div class="mb-4">
                <label for="kecamatan" class="block text-gray-700 font-medium mb-2">Kecamatan</label>
                <input type="text" class="form-control w-full p-2 border rounded-lg" id="kecamatan" name="kecamatan" value="<?php echo set_value('kecamatan', $kosan['kecamatan']); ?>" required>
            </div>
            <div class="mb-4">
                <label for="desa" class="block text-gray-700 font-medium mb-2">Desa</label>
                <input type="text" class="form-control w-full p-2 border rounded-lg" id="desa" name="desa" value="<?php echo set_value('desa', $kosan['desa']); ?>" required>
            </div>
            <div class="mb-4">
                <label for="harga" class="block text-gray-700 font-medium mb-2">Harga per Bulan (Rp)</label>
                <input type="number" class="form-control w-full p-2 border rounded-lg" id="harga" name="harga" value="<?php echo set_value('harga', $kosan['harga']); ?>" required min="0">
            </div>
            <div class="mb-4">
                <label for="tipe" class="block text-gray-700 font-medium mb-2">Tipe Kosan</label>
                <select class="form-control w-full p-2 border rounded-lg" id="tipe" name="tipe" required>
                    <option value="putra" <?php echo set_select('tipe', 'putra', $kosan['tipe'] == 'putra'); ?>>Putra</option>
                    <option value="putri" <?php echo set_select('tipe', 'putri', $kosan['tipe'] == 'putri'); ?>>Putri</option>
                    <option value="campur" <?php echo set_select('tipe', 'campur', $kosan['tipe'] == 'campur'); ?>>Campur</option>
                </select>
            </div>
            <div class="mb-4">
                <label for="kepribadian" class="block text-gray-700 font-medium mb-2">Kepribadian</label>
                <select class="form-control w-full p-2 border rounded-lg" id="kepribadian" name="kepribadian" required>
                    <option value="introvert" <?php echo set_select('kepribadian', 'introvert', $kosan['kepribadian'] == 'introvert'); ?>>Introvert</option>
                    <option value="extrovert" <?php echo set_select('kepribadian', 'extrovert', $kosan['kepribadian'] == 'extrovert'); ?>>Extrovert</option>
                    <option value="ambivert" <?php echo set_select('kepribadian', 'ambivert', $kosan['kepribadian'] == 'ambivert'); ?>>Ambivert</option>
                </select>
            </div>
            <div class="mb-4">
                <label for="jumlah_kamar" class="block text-gray-700 font-medium mb-2">Jumlah Kamar</label>
                <input type="number" class="form-control w-full p-2 border rounded-lg" id="jumlah_kamar" name="jumlah_kamar" value="<?php echo set_value('jumlah_kamar', $kosan['jumlah_kamar']); ?>" required min="1">
            </div>
            <div class="mb-4">
                <label for="kamar_tersedia" class="block text-gray-700 font-medium mb-2">Kamar Tersedia</label>
                <input type="number" class="form-control w-full p-2 border rounded-lg" id="kamar_tersedia" name="kamar_tersedia" value="<?php echo set_value('kamar_tersedia', $kosan['kamar_tersedia']); ?>" required min="0">
            </div>
            <div class="mb-4">
                <label for="deskripsi" class="block text-gray-700 font-medium mb-2">Deskripsi</label>
                <textarea class="form-control w-full p-2 border rounded-lg" id="deskripsi" name="deskripsi" rows="4"><?php echo set_value('deskripsi', $kosan['deskripsi']); ?></textarea>
            </div>
            <div class="mb-4">
                <label for="google_maps_link" class="block text-gray-700 font-medium mb-2">Link Google Maps (Opsional)</label>
                <input type="url" class="form-control w-full p-2 border rounded-lg" id="google_maps_link" name="google_maps_link" value="<?php echo set_value('google_maps_link', $kosan['google_maps_link']); ?>">
            </div>
            <div class="mb-4">
                <label for="fasilitas" class="block text-gray-700 font-medium mb-2">Fasilitas (Tambah beberapa, misalnya: Wi-Fi, Kamar Mandi Dalam)</label>
                <div id="fasilitas-container">
                    <?php if (empty($fasilitas)): ?>
                        <div class="flex mb-2 space-x-2">
                            <input type="text" class="form-control flex-1 p-2 border rounded-lg" name="fasilitas[]" placeholder="Contoh: Wi-Fi">
                            <button type="button" class="btn-outline-secondary px-3 py-1 rounded-lg" onclick="addFasilitas()">+</button>
                        </div>
                    <?php else: ?>
                        <?php foreach ($fasilitas as $f): ?>
                            <div class="flex mb-2 space-x-2">
                                <input type="text" class="form-control flex-1 p-2 border rounded-lg" name="fasilitas[]" value="<?php echo htmlspecialchars($f['nama_fasilitas']); ?>">
                                <button type="button" class="btn-outline-secondary px-3 py-1 rounded-lg" onclick="addFasilitas()">+</button>
                                <button type="button" class="btn-outline-danger px-3 py-1 rounded-lg" onclick="this.parentElement.remove()">-</button>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
            <div class="mb-4">
                <label for="foto_kosan" class="block text-gray-700 font-medium mb-2">Foto Kosan (Maksimal 8, masing-masing < 2MB, unggah ulang untuk mengganti)</label>
                <input type="file" class="form-control w-full p-2 border rounded-lg" id="foto_kosan" name="foto_kosan[]" accept="image/jpeg,image/png,image/jpg" multiple onchange="validateFileCount(this)">
                <p class="text-sm text-gray-500 mt-1">Pilih hingga 8 file gambar (jpg, jpeg, png) dengan ukuran masing-masing < 2MB. Foto lama akan diganti jika Anda mengunggah foto baru.</p>
                <?php if (!empty($foto_kosan)): ?>
                    <div class="mt-4">
                        <label class="block text-gray-700 font-medium mb-2">Foto Saat Ini:</label>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            <?php foreach ($foto_kosan as $foto): ?>
                                <div>
                                    <img src="<?php echo base_url(htmlspecialchars($foto['path'])); ?>" alt="Foto Kosan" class="img-thumbnail rounded-lg">
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            <div class="text-center">
                <button type="submit" class="btn-primary text-white font-medium py-2 px-6 rounded-lg">Simpan Perubahan</button>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
    function addFasilitas() {
        const container = document.getElementById('fasilitas-container');
        const newInput = document.createElement('div');
        newInput.className = 'flex mb-2 space-x-2';
        newInput.innerHTML = `
            <input type="text" class="form-control flex-1 p-2 border rounded-lg" name="fasilitas[]" placeholder="Contoh: Kamar Mandi Dalam">
            <button type="button" class="btn-outline-secondary px-3 py-1 rounded-lg" onclick="addFasilitas()">+</button>
            <button type="button" class="btn-outline-danger px-3 py-1 rounded-lg" onclick="this.parentElement.remove()">-</button>
        `;
        container.appendChild(newInput);
    }

    function validateFileCount(input) {
        const maxFiles = 8;
        const maxSize = 2 * 1024 * 1024; // 2MB in bytes

        if (input.files.length > maxFiles) {
            alert('Maksimal 8 foto yang dapat diunggah!');
            input.value = '';
            return;
        }

        for (let i = 0; i < input.files.length; i++) {
            if (input.files[i].size > maxSize) {
                alert('File ' + input.files[i].name + ' terlalu besar! Maksimal 2MB per file.');
                input.value = '';
                return;
            }
            if (!['image/jpeg', 'image/png', 'image/jpg'].includes(input.files[i].type)) {
                alert('File ' + input.files[i].name + ' tidak diizinkan! Hanya jpg, jpeg, atau png.');
                input.value = '';
                return;
            }
        }
    }
    </script>
</body>
</html>