<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f6f9;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .container {
            max-width: 800px; /* Lebih sempit untuk form */
            margin-top: 2rem;
            padding: 2rem;
            background: #ffffff;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #800000; /* Maroon untuk judul */
            font-weight: 600;
            margin-bottom: 1.5rem;
            text-align: center;
        }
        .alert-success {
            background-color: #d1fae5;
            color: #065f46;
            border: none;
            border-radius: 8px;
            padding: 1rem;
            margin-bottom: 1.5rem;
        }
        .alert-danger {
            background-color: #fee2e2;
            color: #991b1b;
            border: none;
            border-radius: 8px;
            padding: 1rem;
            margin-bottom: 1.5rem;
        }
        .form-label {
            color: #374151;
            font-weight: 500;
        }
        .form-control, .form-select {
            border-radius: 8px;
            border: 1px solid #d1d5db;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }
        .form-control:focus, .form-select:focus {
            border-color: #800000; /* Maroon untuk fokus */
            box-shadow: 0 0 0 0.2rem rgba(128, 0, 0, 0.2);
        }
        .btn-primary {
            background-color: #800000; /* Maroon untuk tombol simpan */
            border-color: #800000;
            border-radius: 8px;
            padding: 0.75rem 1.5rem;
            font-size: 1rem;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .btn-primary:hover {
            background-color: #a52a2a; /* Maroon lebih terang untuk hover */
            border-color: #a52a2a;
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }
        .icon {
            margin-right: 0.5rem;
        }
        .current-photo {
            margin-top: 1rem;
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        .current-photo img {
            border-radius: 8px;
            border: 1px solid #d1d5db;
            max-width: 100px;
        }
        .form-control-file {
            padding: 0.5rem;
        }
    </style>
</head>
<body>
<div class="container mt-4">
    <h1>Edit Pengguna</h1>

    <?php if ($this->session->flashdata('success')): ?>
        <div class="alert alert-success">
            <i class="bi bi-check-circle-fill icon"></i>
            <?php echo $this->session->flashdata('success'); ?>
        </div>
    <?php endif; ?>
    <?php if ($this->session->flashdata('error') || validation_errors()): ?>
        <div class="alert alert-danger">
            <i class="bi bi-exclamation-circle-fill icon"></i>
            <?php echo $this->session->flashdata('error') ?: validation_errors(); ?>
        </div>
    <?php endif; ?>

    <form method="post" action="<?php echo base_url('admin/update_user'); ?>" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($user['id'], ENT_QUOTES, 'UTF-8'); ?>">
        <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" class="form-control" id="nama" name="nama" value="<?php echo htmlspecialchars(set_value('nama', isset($user['nama']) ? $user['nama'] : '')); ?>">
        </div>
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" name="username" value="<?php echo htmlspecialchars(set_value('username', isset($user['username']) ? $user['username'] : '')); ?>">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars(set_value('email', isset($user['email']) ? $user['email'] : '')); ?>">
        </div>
        <div class="mb-3">
            <label for="no_hp" class="form-label">No HP (Opsional)</label>
            <input type="text" class="form-control" id="no_hp" name="no_hp" value="<?php echo htmlspecialchars(set_value('no_hp', isset($user['no_hp']) ? $user['no_hp'] : '')); ?>">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password (Kosongkan jika tidak diubah)</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>
        <div class="mb-3">
            <label for="konfirmasi_password" class="form-label">Konfirmasi Password</label>
            <input type="password" class="form-control" id="konfirmasi_password" name="konfirmasi_password">
        </div>
        <div class="mb-3">
            <label for="role" class="form-label">Role</label>
            <select class="form-select" id="role" name="role" required>
                <option value="pemilik" <?php echo isset($user['role']) && $user['role'] == 'pemilik' ? 'selected' : ''; ?>>Pemilik</option>
                <option value="penyewa" <?php echo isset($user['role']) && $user['role'] == 'penyewa' ? 'selected' : ''; ?>>Penyewa</option>
                <option value="admin" <?php echo isset($user['role']) && $user['role'] == 'admin' ? 'selected' : ''; ?>>Admin</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="foto_profil" class="form-label">Foto Profil (Opsional)</label>
            <input type="file" class="form-control form-control-file" id="foto_profil" name="foto_profil" accept="image/jpeg,image/png,image/jpg">
            <?php if (!empty($user['foto_profil'])): ?>
                <div class="current-photo">
                    <span>Foto Saat Ini:</span>
                    <img src="<?php echo base_url('uploads/profile/' . htmlspecialchars($user['foto_profil'], ENT_QUOTES, 'UTF-8')); ?>" alt="Foto Profil">
                </div>
            <?php endif; ?>
        </div>
        <button type="submit" class="btn btn-primary">
            <i class="bi bi-save-fill icon"></i>Simpan Perubahan
        </button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.js"></script>
</body>
</html>