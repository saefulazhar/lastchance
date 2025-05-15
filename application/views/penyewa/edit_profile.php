<div class="container mt-4">
    <h1>Edit Profil</h1>
    <?php echo validation_errors(); ?>
    <?php if ($this->session->flashdata('error')): ?>
        <div class="alert alert-danger"><?php echo $this->session->flashdata('error'); ?></div>
    <?php endif; ?>
    <?php echo form_open_multipart('penyewa/edit_profile'); ?>
        <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" class="form-control" id="nama" name="nama" value="<?php echo set_value('nama', $user['nama'] ?? ''); ?>" required>
        </div>
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" name="username" value="<?php echo set_value('username', $user['username'] ?? ''); ?>" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo set_value('email', $user['email'] ?? ''); ?>" required>
        </div>
        <div class="mb-3">
            <label for="foto_profil" class="form-label">Foto Profil</label>
            <input type="file" class="form-control" id="foto_profil" name="foto_profil">
            <?php if ($user['foto_profil'] && file_exists('./uploads/foto_profil/' . $user['foto_profil'])): ?>
                <p class="mt-2"><img src="<?php echo base_url('uploads/foto_profil/' . $user['foto_profil']); ?>" alt="Foto Profil Saat Ini" class="img-thumbnail" style="max-width: 100px;"></p>
            <?php endif; ?>
        </div>
        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        <a href="<?php echo base_url('penyewa/profile'); ?>" class="btn btn-secondary">Batal</a>
    </form>
</div>