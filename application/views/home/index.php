<div class="container mt-4">
    <h1>Semua Kosan Tersedia</h1>
    <div class="row">
        <?php if (!empty($kosan_list)): ?>
            <?php foreach ($kosan_list as $kosan): ?>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="<?php echo base_url($kosan['foto'] ? 'uploads/kosan/' . $kosan['foto'] : 'assets/img/no-image.jpg'); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($kosan['nama']); ?>" style="height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($kosan['nama']); ?></h5>
                            <p class="card-text"><strong>Alamat:</strong> <?php echo htmlspecialchars($kosan['alamat']); ?>, <?php echo htmlspecialchars($kosan['desa']); ?>, <?php echo htmlspecialchars($kosan['kecamatan']); ?></p>
                            <p class="card-text"><strong>Harga:</strong> Rp <?php echo number_format($kosan['harga'], 0, ',', '.'); ?>/bulan</p>
                            <p class="card-text"><strong>Tipe:</strong> <?php echo htmlspecialchars(ucfirst($kosan['tipe'])); ?></p>
                            <p class="card-text"><strong>Kepribadian:</strong> <?php echo htmlspecialchars(ucfirst($kosan['kepribadian'])); ?></p>
                            <a href="<?php echo base_url('home/detail/' . $kosan['id']); ?>" class="btn btn-primary">Lihat Detail</a>
                            <?php if (isset($is_logged_in) && $is_logged_in): ?>
                                <a href="<?php echo base_url('penyewa/sewa/' . $kosan['id']); ?>" class="btn btn-success mt-2">Sewa</a>
                            <?php else: ?>
                                <a href="<?php echo base_url('auth/login'); ?>" class="btn btn-success mt-2">Login untuk Sewa</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Tidak ada kosan tersedia saat ini.</p>
        <?php endif; ?>
    </div>
</div>