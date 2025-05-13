<div class="container mt-4">
    <h1>Pencarian BapakKos</h1>
    <form method="get" action="<?php echo base_url('home'); ?>">
        <div class="row mb-3">
            <div class="col-md-4">
                <input type="text" name="cari" class="form-control" placeholder="Cari nama, alamat, kecamatan, atau desa" value="<?php echo $this->input->get('cari'); ?>">
            </div>
            <div class="col-md-3">
                <select name="tipe" class="form-control">
                    <option value="">Semua Tipe</option>
                    <option value="putra" <?php echo $this->input->get('tipe') == 'putra' ? 'selected' : ''; ?>>Putra</option>
                    <option value="putri" <?php echo $this->input->get('tipe') == 'putri' ? 'selected' : ''; ?>>Putri</option>
                    <option value="campur" <?php echo $this->input->get('tipe') == 'campur' ? 'selected' : ''; ?>>Campur</option>
                </select>
            </div>
            <div class="col-md-3">
                <select name="kepribadian" class="form-control">
                    <option value="">Semua Kepribadian</option>
                    <option value="introvert" <?php echo $this->input->get('kepribadian') == 'introvert' ? 'selected' : ''; ?>>Introvert</option>
                    <option value="ekstrovert" <?php echo $this->input->get('kepribadian') == 'ekstrovert' ? 'selected' : ''; ?>>Ekstrovert</option>
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100">Cari</button>
            </div>
        </div>
    </form>
    <div class="row">
        <?php if (empty($kosan)): ?>
            <p>Tidak ada kosan yang ditemukan.</p>
        <?php else: ?>
            <?php foreach ($kosan as $k): ?>
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <?php
                        $foto_paths = explode(',', $k['foto_paths']);
                        $first_foto = !empty($foto_paths[0]) ? base_url($foto_paths[0]) : base_url('assets/default-kosan.png');
                        ?>
                        <img src="<?php echo $first_foto; ?>" class="card-img-top" alt="Foto Kosan" style="height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($k['nama']); ?></h5>
                            <p class="card-text">Rp <?php echo number_format($k['harga'], 0, ',', '.'); ?> / bulan</p>
                            <p class="card-text"><?php echo htmlspecialchars($k['alamat']); ?></p>
                            <p class="card-text">
                                Rating: 
                                <?php if (isset($k['avg_rating']) && $k['avg_rating'] > 0): ?>
                                    <?php for ($i = 1; $i <= 5; $i++): ?>
                                        <?php if ($i <= floor($k['avg_rating'])): ?>
                                            <i class="bi bi-star-fill text-warning"></i>
                                        <?php elseif ($i - 0.5 <= $k['avg_rating']): ?>
                                            <i class="bi bi-star-half text-warning"></i>
                                        <?php else: ?>
                                            <i class="bi bi-star text-warning"></i>
                                        <?php endif; ?>
                                    <?php endfor; ?>
                                    (<?php echo number_format($k['avg_rating'], 1); ?>, <?php echo $k['review_count']; ?> ulasan)
                                <?php else: ?>
                                    Belum ada rating
                                <?php endif; ?>
                            </p>
                            <?php if (isset($k['latest_review']) && !empty($k['latest_review'])): ?>
                                <p class="card-text"><strong>Ulasan Terbaru:</strong> <?php echo htmlspecialchars($k['latest_review']); ?></p>
                            <?php endif; ?>
                            <a href="<?php echo base_url('home/detail/' . $k['id']); ?>" class="btn btn-primary">Lihat Detail</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>