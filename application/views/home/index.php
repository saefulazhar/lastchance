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
                            <h5 class="card-title"><?php echo $k['nama']; ?></h5>
                            <p class="card-text">Rp <?php echo number_format($k['harga'], 0, ',', '.'); ?> / bulan</p>
                            <p class="card-text"><?php echo $k['alamat']; ?></p>
                            <a href="<?php echo base_url('home/detail/' . $k['id']); ?>" class="btn btn-primary">Lihat Detail</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>