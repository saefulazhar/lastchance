<div class="container mt-4">
    <h1>Dashboard Pemilik</h1>
    <p>Selamat datang, <?php echo $this->session->userdata('username'); ?>!</p>
    <p>Sebagai pemilik, Anda dapat mengelola kosan Anda dan melihat pemesanan dari penyewa.</p>
    <a href="<?php echo base_url('pemilik/tambah_kosan'); ?>" class="btn btn-primary mb-3">Tambah Kosan Baru</a>
    <a href="<?php echo base_url('pemilik/sewa'); ?>" class="btn btn-primary mb-3">daftar sewa</a>
    <h2>Daftar Kosan Anda</h2>
    <?php if ($this->session->flashdata('success')): ?>
        <div class="alert alert-success"><?php echo $this->session->flashdata('success'); ?></div>
    <?php endif; ?>
    <?php if (empty($kosan)): ?>
        <p>Belum ada kosan yang ditambahkan.</p>
    <?php else: ?>
        <div class="row">
            <?php foreach ($kosan as $k): ?>
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <?php
                        $foto_paths = explode(',', $k['foto_paths']);
                        $first_foto = !empty($foto_paths[0]) ? base_url($foto_paths[0]) : base_url('assets/default-kosan.png');
                        ?>
                        <img src="<?php echo $first_foto; ?>" class="card-img-top" alt="Foto Kosan" style="height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $k['nama']; ?></h5>
                            <p class="card-text">Rp <?php echo number_format($k['harga'], 0, ',', '.'); ?> / bulan</p>
                            <p class="card-text"><?php echo $k['alamat']; ?></p>
                            <a href="<?php echo base_url('pemilik/edit_kosan/' . $k['id']); ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="<?php echo base_url('pemilik/hapus_kosan/' . $k['id']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus kosan ini?')">Hapus</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>