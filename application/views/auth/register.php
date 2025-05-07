<div class="container mt-4">
    <h1>Registrasi ke BapakKos</h1>
    <?php if ($this->session->flashdata('success')): ?>
        <div class="alert alert-success"><?php echo $this->session->flashdata('success'); ?></div>
    <?php endif; ?>
    <?php if ($this->session->flashdata('error') || validation_errors()): ?>
        <div class="alert alert-danger"><?php echo $this->session->flashdata('error') ?: validation_errors(); ?></div>
    <?php endif; ?>
    <form method="post" action="<?php echo base_url('auth/register'); ?>" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" class="form-control" id="nama" name="nama" required>
        </div>
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" name="username" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="no_hp" class="form-label">No HP (Opsional)</label>
            <input type="text" class="form-control" id="no_hp" name="no_hp">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="mb-3">
            <label for="konfirmasi_password" class="form-label">Konfirmasi Password</label>
            <input type="password" class="form-control" id="konfirmasi_password" name="konfirmasi_password" required>
        </div>
        <div class="mb-3">
            <label for="role" class="form-label">Role</label>
            <select class="form-control" id="role" name="role" required>
                <option value="pemilik">Pemilik</option>
                <option value="penyewa">Penyewa</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="foto_profil" class="form-label">Foto Profil (Opsional)</label>
            <input type="file" class="form-control" id="foto_profil" name="foto_profil" accept="image/jpeg,image/png,image/jpg">
        </div>
        <button type="submit" class="btn btn-primary">Daftar</button>
    </form>
    <p class="mt-3">Sudah punya akun? <a href="<?php echo base_url('auth/login'); ?>">Login di sini</a></p>
</div>