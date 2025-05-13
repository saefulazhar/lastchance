<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="container mt-4">
    <h1>Edit User</h1>
    <?php if ($this->session->flashdata('success')): ?>
        <div class="alert alert-success"><?php echo $this->session->flashdata('success'); ?></div>
    <?php endif; ?>
    <?php if ($this->session->flashdata('error') || validation_errors()): ?>
        <div class="alert alert-danger"><?php echo $this->session->flashdata('error') ?: validation_errors(); ?></div>
    <?php endif; ?>
    <form method="post" action="<?php echo base_url('admin/update_user'); ?>" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($user['id']); ?>">
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
            <select class="form-control" id="role" name="role" required>
                <option value="pemilik" <?php echo isset($user['role']) && $user['role'] == 'pemilik' ? 'selected' : ''; ?>>Pemilik</option>
                <option value="penyewa" <?php echo isset($user['role']) && $user['role'] == 'penyewa' ? 'selected' : ''; ?>>Penyewa</option>
                <option value="penyewa" <?php echo isset($user['role']) && $user['role'] == 'admin' ? 'selected' : ''; ?>>Admin</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="foto_profil" class="form-label">Foto Profil (Opsional)</label>
            <input type="file" class="form-control" id="foto_profil" name="foto_profil" accept="image/jpeg,image/png,image/jpg">
            <?php if (!empty($user['foto_profil'])): ?>
                <p>Foto Saat Ini: <img src="<?php echo base_url('uploads/profile/' . htmlspecialchars($user['foto_profil'])); ?>" alt="Foto Profil" width="100"></p>
            <?php endif; ?>
        </div>
        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
    </form>
</div>