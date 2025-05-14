<div class="container mt-4">
    <h1>Profil Penyewa</h1>
    <?php if ($this->session->flashdata('success')): ?>
        <div class="alert alert-success"><?php echo $this->session->flashdata('success'); ?></div>
    <?php endif; ?>
    <?php if ($this->session->flashdata('error')): ?>
        <div class="alert alert-danger"><?php echo $this->session->flashdata('error'); ?></div>
    <?php endif; ?>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-3 text-center">
                    <?php if ($user['foto_profil'] && file_exists('./uploads/profile/' . $user['foto_profil'])): ?>
                        <img src="<?php echo base_url('uploads/profile/' . $user['foto_profil']); ?>" alt="Foto Profil" class="img-fluid rounded-circle" style="width: 150px,height: 150px;">
                    <?php else: ?>
                        <img src="<?php echo base_url('assets/images/default-profile.png'); ?>" alt="Foto Profil" class="img-fluid rounded-circle" style="max-width: 150px;">
                    <?php endif; ?>
                </div>
                <div class="col-md-9">
                    <h5 class="card-title">Informasi Pengguna</h5>
                    <p><strong>Nama:</strong> <?php echo htmlspecialchars($user['nama'] ?? ''); ?></p>
                    <p><strong>Username:</strong> <?php echo htmlspecialchars($user['username'] ?? ''); ?></p>
                    <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email'] ?? ''); ?></p>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-3">
        <a href="<?php echo base_url('penyewa/edit_profile'); ?>" class="btn btn-primary">Edit Profil</a>
        <!-- <a href="<?php echo base_url('penyewa/riwayat_ulasan'); ?>" class="btn btn-secondary">Kembali</a> -->
    </div>
</div>