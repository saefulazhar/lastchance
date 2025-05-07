<div class="container mt-4">
    <h1><?php echo $kosan['nama']; ?></h1>
    <div class="row">
        <div class="col-md-8">
            <div id="carouselKosan" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <?php if (empty($foto_kosan)): ?>
                        <div class="carousel-item active">
                            <img src="<?php echo base_url('assets/default-kosan.png'); ?>" class="d-block w-100" alt="Default Kosan" style="height: 400px; object-fit: cover;">
                        </div>
                    <?php else: ?>
                        <?php foreach ($foto_kosan as $index => $foto): ?>
                            <div class="carousel-item <?php echo $index == 0 ? 'active' : ''; ?>">
                                <img src="<?php echo base_url($foto['path']); ?>" class="d-block w-100" alt="Foto Kosan" style="height: 400px; object-fit: cover;">
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselKosan" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselKosan" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
        <div class="col-md-4">
            <h4>Rp <?php echo number_format($kosan['harga'], 0, ',', '.'); ?> / bulan</h4>
            <p><strong>Alamat:</strong> <?php echo $kosan['alamat'] . ', ' . $kosan['kecamatan'] . ', ' . $kosan['desa']; ?></p>
            <p><strong>Tipe:</strong> <?php echo ucfirst($kosan['tipe']); ?></p>
            <p><strong>Kepribadian:</strong> <?php echo ucfirst($kosan['kepribadian']); ?></p>
            <p><strong>Fasilitas:</strong></p>
            <ul>
                <?php foreach ($fasilitas as $f): ?>
                    <li><?php echo $f['nama_fasilitas']; ?></li>
                <?php endforeach; ?>
            </ul>
            <?php if (!empty($kosan['google_maps_link'])): ?>
                <p><strong>Lokasi:</strong> <a href="<?php echo $kosan['google_maps_link']; ?>" target="_blank">Lihat di Google Maps</a></p>
            <?php endif; ?>
            <?php if ($this->session->userdata('logged_in') && $this->session->userdata('role') == 'penyewa'): ?>
                <a href="<?php echo base_url('penyewa/sewa/' . $kosan['id']); ?>" class="btn btn-success">Pesan Sekarang</a>
            <?php endif; ?>
        </div>
    </div>
    <div class="mt-4">
        <h4>Deskripsi</h4>
        <p><?php echo $kosan['deskripsi'] ?: 'Tidak ada deskripsi tersedia.'; ?></p>
    </div>
</div>