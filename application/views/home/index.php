<div class="container mt-4">
    <h1>Cari Kosan Impian Anda</h1>
    <p>Temukan kosan yang sesuai dengan kebutuhan Anda!</p>

    <!-- Form Pencarian Berdasarkan Kecamatan -->
    <form action="<?php echo base_url('home/search'); ?>" method="get" class="mb-4">
        <div class="input-group">
            <input type="text" class="form-control" name="kecamatan" placeholder="Masukkan kecamatan (misalnya, Karangpawitan)" value="<?php echo isset($_GET['kecamatan']) ? htmlspecialchars($_GET['kecamatan']) : ''; ?>">
            <button class="btn btn-primary" type="submit">Cari</button>
        </div>
    </form>

    <!-- Tampilkan Semua Kosan Secara Default -->
    <?php if (!isset($kecamatan_searched) || empty($kecamatan_searched)): ?>
        <h3>Semua Kosan Tersedia</h3>
        <?php if (isset($kosan_list) && !empty($kosan_list)): ?>
            <div class="row">
                <?php foreach ($kosan_list as $kosan): ?>
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <?php
                            $foto_path = base_url('uploads/kosan/' . ($kosan['foto'] ?? 'default-kosan.jpg'));
                            log_message('debug', 'Foto path untuk ' . $kosan['nama'] . ': ' . $foto_path);
                            $file_exists = file_exists(FCPATH . 'uploads/kosan/' . ($kosan['foto'] ?? 'default-kosan.jpg'));
                            log_message('debug', 'File exists untuk ' . $kosan['nama'] . ': ' . ($file_exists ? 'Yes' : 'No'));
                            ?>
                            <img src="<?php echo $foto_path; ?>" class="card-img-top" alt="Foto Kosan" style="height: 200px; object-fit: cover;">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo htmlspecialchars($kosan['nama']); ?></h5>
                                <p class="card-text">Alamat: <?php echo htmlspecialchars($kosan['alamat'] . ', ' . $kosan['kecamatan'] . ', ' . $kosan['desa']); ?></p>
                                <p class="card-text">Harga: Rp <?php echo number_format($kosan['harga'], 0, ',', '.'); ?>/bulan</p>
                                <p class="card-text">Tipe: <?php echo htmlspecialchars($kosan['tipe']); ?></p>
                                <p class="card-text">Kepribadian: <?php echo htmlspecialchars($kosan['kepribadian'] ?? 'Tidak ditentukan'); ?></p>
                                <a href="<?php echo base_url('home/detail/' . $kosan['id']); ?>" class="btn btn-primary">Lihat Detail</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p class="text-muted">Tidak ada kosan yang tersedia di database.</p>
        <?php endif; ?>
    <?php endif; ?>

    <!-- Filter Tambahan dan Hasil Pencarian -->
    <?php if (isset($kecamatan_searched) && $kecamatan_searched): ?>
        <!-- Debugging: Tampilkan kecamatan yang dicari -->
        <div class="alert alert-info">
            Mencari kosan di kecamatan: <strong><?php echo htmlspecialchars($kecamatan_searched); ?></strong>
        </div>

        <!-- Filter Checkbox -->
        <form action="<?php echo base_url('home/filter'); ?>" method="get" class="bg-light p-4 rounded shadow-sm mb-4">
            <input type="hidden" name="kecamatan" value="<?php echo htmlspecialchars($kecamatan_searched); ?>">
            
            <!-- Filter Harga -->
            <div class="mb-3">
                <label class="form-label fw-bold">Pilih Rentang Harga</label>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="harga[]" value="500000-1000000" id="harga-1" <?php echo isset($_GET['harga']) && in_array('500000-1000000', $_GET['harga']) ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="harga-1">Rp 500.000 - Rp 1.000.000</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="harga[]" value="1000000-2000000" id="harga-2" <?php echo isset($_GET['harga']) && in_array('1000000-2000000', $_GET['harga']) ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="harga-2">Rp 1.000.000 - Rp 2.000.000</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="harga[]" value="2000000-5000000" id="harga-3" <?php echo isset($_GET['harga']) && in_array('2000000-5000000', $_GET['harga']) ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="harga-3">Rp 2.000.000 - Rp 5.000.000</label>
                </div>
            </div>

            <!-- Filter Tipe Kosan (Putra, Putri, Campur) -->
            <div class="mb-3">
                <label class="form-label fw-bold">Pilih Tipe Kosan</label>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="tipe[]" value="putra" id="tipe-putra" <?php echo isset($_GET['tipe']) && in_array('putra', $_GET['tipe']) ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="tipe-putra">Putra</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="tipe[]" value="putri" id="tipe-putri" <?php echo isset($_GET['tipe']) && in_array('putri', $_GET['tipe']) ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="tipe-putri">Putri</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="tipe[]" value="campur" id="tipe-campur" <?php echo isset($_GET['tipe']) && in_array('campur', $_GET['tipe']) ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="tipe-campur">Campur</label>
                </div>
            </div>

            <!-- Filter Kepribadian -->
            <div class="mb-3">
                <label class="form-label fw-bold">Pilih Kepribadian</label>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="kepribadian[]" value="introvert" id="kepribadian-introvert" <?php echo isset($_GET['kepribadian']) && in_array('introvert', $_GET['kepribadian']) ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="kepribadian-introvert">Introvert</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="kepribadian[]" value="ekstrovert" id="kepribadian-ekstrovert" <?php echo isset($_GET['kepribadian']) && in_array('ekstrovert', $_GET['kepribadian']) ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="kepribadian-ekstrovert">Ekstrovert</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="kepribadian[]" value="ambivert" id="kepribadian-ambivert" <?php echo isset($_GET['kepribadian']) && in_array('ambivert', $_GET['kepribadian']) ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="kepribadian-ambivert">Ambivert</label>
                </div>
            </div>

            <!-- Tombol Filter -->
            <button type="submit" class="btn btn-primary">Terapkan Filter</button>
            <a href="<?php echo base_url('home/search?kecamatan=' . urlencode($kecamatan_searched)); ?>" class="btn btn-secondary">Reset Filter</a>
        </form>

        <!-- Hasil Pencarian -->
        <div class="mt-4">
            <h3>Hasil Pencarian di Kecamatan <?php echo htmlspecialchars($kecamatan_searched); ?></h3>
            <?php if (isset($kosan_list) && !empty($kosan_list)): ?>
                <div class="row">
                    <?php foreach ($kosan_list as $kosan): ?>
                        <div class="col-md-4 mb-4">
                            <div class="card">
                                <?php
                                $foto_path = base_url('uploads/kosan/' . ($kosan['foto'] ?? 'default-kosan.jpg'));
                                log_message('debug', 'Foto path untuk ' . $kosan['nama'] . ': ' . $foto_path);
                                $file_exists = file_exists(FCPATH . 'uploads/kosan/' . ($kosan['foto'] ?? 'default-kosan.jpg'));
                                log_message('debug', 'File exists untuk ' . $kosan['nama'] . ': ' . ($file_exists ? 'Yes' : 'No'));
                                ?>
                                <img src="<?php echo $foto_path; ?>" class="card-img-top" alt="Foto Kosan" style="height: 200px; object-fit: cover;">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo htmlspecialchars($kosan['nama']); ?></h5>
                                    <p class="card-text">Alamat: <?php echo htmlspecialchars($kosan['alamat'] . ', ' . $kosan['kecamatan'] . ', ' . $kosan['desa']); ?></p>
                                    <p class="card-text">Harga: Rp <?php echo number_format($kosan['harga'], 0, ',', '.'); ?>/bulan</p>
                                    <p class="card-text">Tipe: <?php echo htmlspecialchars($kosan['tipe']); ?></p>
                                    <p class="card-text">Kepribadian: <?php echo htmlspecialchars($kosan['kepribadian'] ?? 'Tidak ditentukan'); ?></p>
                                    <a href="<?php echo base_url('home/detail/' . $kosan['id']); ?>" class="btn btn-primary">Lihat Detail</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <p class="text-muted">Tidak ada kosan yang ditemukan di kecamatan tersebut atau dengan filter yang dipilih.</p>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</div>