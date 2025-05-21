<div class="container mt-4">
    <!-- Form Pencarian -->
    <form action="<?php echo base_url('home/search'); ?>" method="get" class="mb-4">
        <div class="input-group">
            <input type="text" name="kecamatan" class="form-control" placeholder="Cari berdasarkan kecamatan, alamat, atau desa..." value="<?php echo isset($kecamatan_searched) ? htmlspecialchars($kecamatan_searched) : ''; ?>" required>
            <button type="submit" class="btn btn-primary">Cari</button>
        </div>
    </form>

    <!-- Form Filter -->
    <form action="<?php echo base_url('home/filter'); ?>" method="get" class="mb-4">
        <div class="row">
            
            <div class="col-md-3">
                <label class="form-label">Harga</label>
                <div class="form-check">
                    <input type="checkbox" name="harga[]" value="0-1000000" class="form-check-input" id="harga1">
                    <label class="form-check-label" for="harga1">0 - 1 Juta</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" name="harga[]" value="1000001-2000000" class="form-check-input" id="harga2">
                    <label class="form-check-label" for="harga2">1 Juta - 2 Juta</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" name="harga[]" value="2000001-999999999" class="form-check-input" id="harga3">
                    <label class="form-check-label" for="harga3">> 2 Juta</label>
                </div>
            </div>
            <div class="col-md-3">
                <label class="form-label">Tipe Kosan</label>
                <div class="form-check">
                    <input type="checkbox" name="tipe[]" value="putra" class="form-check-input" id="tipe1">
                    <label class="form-check-label" for="tipe1">Putra</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" name="tipe[]" value="putri" class="form-check-input" id="tipe2">
                    <label class="form-check-label" for="tipe2">Putri</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" name="tipe[]" value="campur" class="form-check-input" id="tipe3">
                    <label class="form-check-label" for="tipe3">Campur</label>
                </div>
            </div>
            <div class="col-md-3">
                <label class="form-label">Kepribadian</label>
                <div class="form-check">
                    <input type="checkbox" name="kepribadian[]" value="introvert" class="form-check-input" id="kepribadian1">
                    <label class="form-check-label" for="kepribadian1">Introvert</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" name="kepribadian[]" value="extrovert" class="form-check-input" id="kepribadian2">
                    <label class="form-check-label" for="kepribadian2">Extrovert</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" name="kepribadian[]" value="ambivert" class="form-check-input" id="kepribadian3">
                    <label class="form-check-label" for="kepribadian3">Ambivert</label>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Filter</button>
    </form>

    <!-- Judul Halaman -->
    <h1><?php echo isset($kecamatan_searched) ? 'Hasil Pencarian/Filter untuk "' . htmlspecialchars($kecamatan_searched) . '"' : 'Semua Kosan Tersedia'; ?></h1>

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
                                <a href="<?php echo base_url('penyewa/buat_laporan/' . $kosan['id']); ?>" class="btn btn-warning btn-sm mt-2">Laporkan</a>
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