<div class="container mt-4">
    <h1>Detail Kosan: <?php echo htmlspecialchars($kosan['nama']); ?></h1>
    <a href="<?php echo base_url('home'); ?>" class="btn btn-secondary mb-3">Kembali ke Daftar</a>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title"><?php echo htmlspecialchars($kosan['nama']); ?></h5>
            <?php if (!empty($foto_kosan)): ?>
                <div class="row">
                    <?php foreach ($foto_kosan as $foto): ?>
                        <div class="col-md-3 mb-3">
                            <img src="<?php echo base_url($foto['path']); ?>" class="img-fluid" alt="Foto Kosan">
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <p>Tidak ada foto tersedia untuk kosan ini.</p>
            <?php endif; ?>

            <p class="card-text"><strong>Alamat:</strong> <?php echo htmlspecialchars($kosan['alamat']); ?>, <?php echo htmlspecialchars($kosan['desa']); ?>, <?php echo htmlspecialchars($kosan['kecamatan']); ?></p>
            <p class="card-text"><strong>Harga per Bulan:</strong> Rp <?php echo number_format($kosan['harga'], 0, ',', '.'); ?></p>
            <p class="card-text"><strong>Tipe:</strong> <?php echo htmlspecialchars(ucfirst($kosan['tipe'])); ?></p>
            <p class="card-text"><strong>Kepribadian:</strong> <?php echo htmlspecialchars(ucfirst($kosan['kepribadian'])); ?></p>
            <p class="card-text"><strong>Jumlah Kamar:</strong> <?php echo htmlspecialchars($kosan['jumlah_kamar']); ?></p>
            <p class="card-text"><strong>Kamar Tersedia:</strong> <?php echo htmlspecialchars($kosan['kamar_tersedia']); ?></p>
            <p class="card-text"><strong>Rating:</strong> <?php echo number_format($rata_rating, 1); ?>/5</p>
            <p class="card-text"><strong>Deskripsi:</strong> <?php echo htmlspecialchars($kosan['deskripsi'] ?: 'Tidak ada deskripsi.'); ?></p>
            <p class="card-text"><strong>Link Google Maps:</strong> 
                <?php if ($kosan['google_maps_link']): ?>
                    <a href="<?php echo htmlspecialchars($kosan['google_maps_link']); ?>" target="_blank">Lihat di Google Maps</a>
                <?php else: ?>
                    Tidak tersedia.
                <?php endif; ?>
            </p>
            <p class="card-text"><strong>Pemilik:</strong> <?php echo htmlspecialchars($kosan['nama_pemilik'] ?: 'Tidak diketahui'); ?></p>
            
            <h5>Fasilitas</h5>
            <?php if (!empty($fasilitas)): ?>
                <ul>
                    <?php foreach ($fasilitas as $f): ?>
                        <li><?php echo htmlspecialchars($f['nama_fasilitas']); ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p>Tidak ada fasilitas yang terdaftar.</p>
            <?php endif; ?>

            <h5>Ulasan</h5>
            <?php if (empty($ulasan_list)): ?>
                <p>Belum ada ulasan untuk kosan ini.</p>
            <?php else: ?>
                <?php foreach ($ulasan_list as $ulasan): ?>
                    <div class="card mb-2">
                        <div class="card-body">
                            <p class="card-text"><strong><?php echo htmlspecialchars($ulasan['penyewa_username'] ?: 'Anonim'); ?></strong> - <?php echo number_format($ulasan['rating'], 1); ?>/5</p>
                            <p class="card-text"><?php echo htmlspecialchars($ulasan['ulasan'] ?: 'Tanpa ulasan'); ?></p>
                            <small class="text-muted"><?php echo date('d-m-Y H:i', strtotime($ulasan['created_at'])); ?></small>
                            <?php if ($this->session->userdata('user_id') == $ulasan['penyewa_id']): ?>
                                <a href="<?php echo base_url('penyewa/edit_ulasan/' . $ulasan['id']); ?>" class="btn btn-sm btn-warning mt-2">Edit Ulasan</a>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>

            <?php if ($bisa_ulas && !$ulasan_exist): ?>
                <a href="<?php echo base_url('penyewa/beri_ulasan/' . $kosan['id']); ?>" class="btn btn-primary mt-3">Beri Ulasan dari Riwayat Sewa</a>
            <?php elseif ($bisa_ulas && $ulasan_exist): ?>
                <p class="mt-3">Anda sudah memberikan ulasan untuk riwayat sewa kosan ini.</p>
            <?php endif; ?>
        </div>
    </div>
</div>