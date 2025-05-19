<div class="main-content">
    <div class="container mt-4">
        <h1>Detail Laporan</h1>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><?php echo htmlspecialchars($laporan['judul']); ?></h5>
                <p><strong>Deskripsi:</strong> <?php echo htmlspecialchars($laporan['deskripsi']); ?></p>
                <p><strong>Kosan:</strong> <?php echo htmlspecialchars($laporan['nama_kosan'] ?? 'Tidak Ditentukan'); ?></p>
                <p><strong>Pelapor:</strong> <?php echo htmlspecialchars($laporan['nama_user'] ?? 'Tidak Diketahui'); ?></p>
                <p><strong>Status:</strong> <?php echo htmlspecialchars($laporan['status']); ?></p>
                <p><strong>Tanggal Dibuat:</strong> <?php echo htmlspecialchars($laporan['created_at']); ?></p>
                <?php if ($laporan['lampiran']): ?>
                    <p><strong>Lampiran:</strong></p>
                    <img src="<?php echo base_url($laporan['lampiran']); ?>" alt="Lampiran Laporan" class="img-fluid" style="max-width: 300px;">
                    <?php else: ?>
                        <p><strong>Lampiran:</strong> Tidak ada</p>
                        <?php endif; ?>
                    </div>
                    <a href="<?php echo base_url('admin/daftar_laporan'); ?>" class="btn btn-secondary mb-3">Kembali</a>
        </div>
    </div>
</div>