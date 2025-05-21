<div class="container mt-4">
    <h1>Detail Kosan: <?php echo htmlspecialchars($kosan['nama']); ?></h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title"><?php echo htmlspecialchars($kosan['nama']); ?></h5>
            <p class="card-text"><strong>Alamat:</strong> <?php echo htmlspecialchars($kosan['alamat']); ?>, <?php echo htmlspecialchars($kosan['desa']); ?>, <?php echo htmlspecialchars($kosan['kecamatan']); ?></p>
            <p class="card-text"><strong>Harga per Bulan:</strong> Rp <?php echo number_format($kosan['harga'], 0, ',', '.'); ?></p>
            <p class="card-text"><strong>Tipe:</strong> <?php echo htmlspecialchars(ucfirst($kosan['tipe'])); ?></p>
            <p class="card-text"><strong>Kepribadian:</strong> <?php echo htmlspecialchars(ucfirst($kosan['kepribadian'])); ?></p>
            <p class="card-text"><strong>Jumlah Kamar:</strong> <?php echo htmlspecialchars($kosan['jumlah_kamar']); ?></p>
            <p class="card-text"><strong>Kamar Tersedia:</strong> <?php echo htmlspecialchars($kosan['kamar_tersedia']); ?></p>
            <p class="card-text"><strong>Deskripsi:</strong> <?php echo htmlspecialchars($kosan['deskripsi'] ?: 'Tidak ada deskripsi.'); ?></p>
            <p class="card-text"><strong>Link Google Maps:</strong> 
                <?php if ($kosan['google_maps_link']): ?>
                    <a href="<?php echo htmlspecialchars($kosan['google_maps_link']); ?>" target="_blank">Lihat di Google Maps</a>
                <?php else: ?>
                    Tidak tersedia.
                <?php endif; ?>
            </p>
            <p class="card-text"><strong>Pemilik:</strong> <?php echo htmlspecialchars($kosan['nama_pemilik'] ?: 'Tidak diketahui'); ?></p>
            <p class="card-text"><strong>Fasilitas:</strong> 
                <?php if (empty($fasilitas)): ?>
                    Tidak ada fasilitas.
                <?php else: ?>
                    <ul>
                        <?php foreach ($fasilitas as $f): ?>
                            <li><?php echo htmlspecialchars($f['nama_fasilitas']); ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </p>
            <p class="card-text"><strong>Foto Kosan:</strong></p>
            <?php if (empty($foto_kosan)): ?>
                <p>Tidak ada foto.</p>
            <?php else: ?>
                <div class="row">
                    <?php foreach ($foto_kosan as $foto): ?>
                        <div class="col-md-3 mb-3">
                            <img src="<?php echo base_url(htmlspecialchars($foto['path'])); ?>" alt="Foto Kosan" class="img-thumbnail" style="width: 100%;">
                        </div>
                        <?php endforeach; ?>
                    </div>
            <?php endif; ?>
        </div>
    </div>
    <a href="<?php echo base_url('admin/daftar_kosan'); ?>" class="btn btn-secondary mb-3">Kembali ke Daftar</a>
</div>