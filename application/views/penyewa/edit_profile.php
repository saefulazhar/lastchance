<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profil</title>
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
        .alert-success {
            border-left-color: #a52a2a; /* Maroon cerah untuk border alert */
        }
        .alert-danger, .alert-warning {
            border-left-color: #dc2626;
        }
        @keyframes slideIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .img-thumbnail {
            max-width: 100px;
            height: auto;
            object-fit: cover;
        }
    </style>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-6 max-w-2xl">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Edit Profil</h1>
        <?php if (validation_errors()): ?>
            <div class="alert alert-warning bg-yellow-100 border-l-4 text-yellow-700 p-4 mb-6 rounded-lg">
                <?php echo validation_errors(); ?>
                <button type="button" class="float-right text-yellow-700 hover:text-yellow-900" data-bs-dismiss="alert" aria-label="Close">&times;</button>
            </div>
        <?php endif; ?>
        <?php if ($this->session->flashdata('error')): ?>
            <div class="alert alert-danger bg-red-100 border-l-4 text-red-700 p-4 mb-6 rounded-lg">
                <?php echo htmlspecialchars($this->session->flashdata('error')); ?>
                <button type="button" class="float-right text-red-700 hover:text-red-900" data-bs-dismiss="alert" aria-label="Close">&times;</button>
            </div>
        <?php endif; ?>
        <?php if ($this->session->flashdata('success')): ?>
            <div class="alert alert-success bg-green-100 border-l-4 text-green-700 p-4 mb-6 rounded-lg">
                <?php echo htmlspecialchars($this->session->flashdata('success')); ?>
                <button type="button" class="float-right text-green-700 hover:text-green-900" data-bs-dismiss="alert" aria-label="Close">&times;</button>
            </div>
        <?php endif; ?>
        <?php if ($this->session->flashdata('warning')): ?>
            <div class="alert alert-warning bg-yellow-100 border-l-4 text-yellow-700 p-4 mb-6 rounded-lg">
                <?php echo htmlspecialchars($this->session->flashdata('warning')); ?>
                <button type="button" class="float-right text-yellow-700 hover:text-yellow-900" data-bs-dismiss="alert" aria-label="Close">&times;</button>
            </div>
        <?php endif; ?>
        <?php echo form_open_multipart('penyewa/edit_profile', ['class' => 'bg-white p-6 rounded-lg shadow-md']); ?>
            <div class="mb-4">
                <label for="nama" class="block text-gray-700 font-medium mb-2">Nama</label>
                <input type="text" class="form-control w-full p-2 border rounded-lg" id="nama" name="nama" value="<?php echo set_value('nama', $user['nama'] ?? ''); ?>" required>
                <small class="text-red-500"><?php echo form_error('nama'); ?></small>
            </div>
            <div class="mb-4">
                <label for="username" class="block text-gray-700 font-medium mb-2">Username</label>
                <input type="text" class="form-control w-full p-2 border rounded-lg" id="username" name="username" value="<?php echo set_value('username', $user['username'] ?? ''); ?>" required>
                <small class="text-red-500"><?php echo form_error('username'); ?></small>
            </div>
            <div class="mb-4">
                <label for="email" class="block text-gray-700 font-medium mb-2">Email</label>
                <input type="email" class="form-control w-full p-2 border rounded-lg" id="email" name="email" value="<?php echo set_value('email', $user['email'] ?? ''); ?>" required>
                <small class="text-red-500"><?php echo form_error('email'); ?></small>
            </div>
            <div class="mb-4">
                <label for="no_hp" class="block text-gray-700 font-medium mb-2">Nomor HP</label>
                <input type="text" class="form-control w-full p-2 border rounded-lg" id="no_hp" name="no_hp" value="<?php echo set_value('no_hp', $user['no_hp'] ?? ''); ?>">
                <p class="text-sm text-gray-500 mt-1">Masukkan nomor HP (maksimal 13 digit, opsional).</p>
                <small class="text-red-500"><?php echo form_error('no_hp'); ?></small>
            </div>
            <div class="mb-4">
                <label for="password" class="block text-gray-700 font-medium mb-2">Kata Sandi Baru</label>
                <input type="password" class="form-control w-full p-2 border rounded-lg" id="password" name="password">
                <p class="text-sm text-gray-500 mt-1">Kosongkan jika tidak ingin mengubah kata sandi.</p>
                <small class="text-red-500"><?php echo form_error('password'); ?></small>
            </div>
            <div class="mb-4">
                <label for="foto_profil" class="block text-gray-700 font-medium mb-2">Foto Profil</label>
                <input type="file" class="form-control w-full p-2 border rounded-lg" id="foto_profil" name="foto_profil" accept="image/jpeg,image/png,image/jpg">
                <?php if (!empty($user['foto_profil']) && file_exists('./uploads/foto_profil/' . $user['foto_profil'])): ?>
                    <div class="mt-2">
                        <img src="<?php echo base_url('uploads/foto_profil/' . $user['foto_profil']); ?>" alt="Foto Profil Saat Ini" class="img-thumbnail rounded-lg">
                    </div>
                <?php endif; ?>
            </div>
            <div class="flex space-x-4">
                <button type="submit" class="btn-primary text-white font-medium py-2 px-4 rounded-lg">Simpan Perubahan</button>
                <a href="<?php echo base_url('penyewa/profile'); ?>" class="btn-secondary text-white font-medium py-2 px-4 rounded-lg">Batal</a>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>