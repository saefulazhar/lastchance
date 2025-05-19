<div class="container mt-4">
    <h1>Edit Profil</h1>

    <!-- Tampilkan error validasi form -->
    <?php if (validation_errors()): ?>
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <?php echo validation_errors(); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <!-- Flashdata: error duplikat / umum -->
    <?php if ($this->session->flashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?php echo $this->session->flashdata('error'); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <!-- Flashdata: sukses -->
    <?php if ($this->session->flashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo $this->session->flashdata('success'); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <!-- Flashdata: peringatan -->
    <?php if ($this->session->flashdata('warning')): ?>
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <?php echo $this->session->flashdata('warning'); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <?php echo form_open_multipart('penyewa/edit_profile'); ?>
        <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" class="form-control" id="nama" name="nama" value="<?php echo set_value('nama', $user['nama'] ?? ''); ?>" required>
            <small class="text-danger"><?php echo form_error('nama'); ?></small>
        </div>

        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" name="username" value="<?php echo set_value('username', $user['username'] ?? ''); ?>" required>
            <small class="text-danger"><?php echo form_error('username'); ?></small>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo set_value('email', $user['email'] ?? ''); ?>" required>
            <small class="text-danger"><?php echo form_error('email'); ?></small>
        </div>

        <div class="mb-3">
            <label for="no_hp" class="form-label">Nomor HP</label>
            <input type="text" class="form-control" id="no_hp" name="no_hp" value="<?php echo set_value('no_hp', $user['no_hp'] ?? ''); ?>">
            <small class="form-text text-muted">Masukkan nomor HP (maksimal 13 digit, opsional).</small>
            <small class="text-danger"><?php echo form_error('no_hp'); ?></small>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Kata Sandi Baru</label>
            <input type="password" class="form-control" id="password" name="password">
            <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah kata sandi.</small>
            <small class="text-danger"><?php echo form_error('password'); ?></small>
        </div>

        <div class="mb-3">
            <label for="foto_profil" class="form-label">Foto Profil</label>
            <input type="file" class="form-control" id="foto_profil" name="foto_profil">
            <?php if (!empty($user['foto_profil']) && file_exists('./uploads/foto_profil/' . $user['foto_profil'])): ?>
                <p class="mt-2">
                    <img src="<?php echo base_url('uploads/foto_profil/' . $user['foto_profil']); ?>" alt="Foto Profil Saat Ini" class="img-thumbnail" style="max-width: 100px;">
                </p>
            <?php endif; ?>
        </div>

        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        <a href="<?php echo base_url('penyewa/profile'); ?>" class="btn btn-secondary">Batal</a>
    </form>
</div>
