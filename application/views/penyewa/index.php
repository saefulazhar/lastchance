

        <!-- Main Content -->
        <div class="flex-grow-1 d-flex flex-column">
            <!-- Content Area -->
            <main class="flex-grow-1 p-4 bg-light">
                <h1>Dashboard Penyewa</h1>
                <?php if ($this->session->flashdata('success')): ?>
                    <div class="alert alert-success"><?php echo $this->session->flashdata('success'); ?></div>
                <?php endif; ?>
                <?php if ($this->session->flashdata('error')): ?>
                    <div class="alert alert-danger"><?php echo $this->session->flashdata('error'); ?></div>
                <?php endif; ?>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Sewa Aktif</h5>
                                <p class="card-text">Anda memiliki <strong><?php echo isset($active_sewa_count) ? $active_sewa_count : 0; ?></strong> sewa aktif saat ini.</p>
                                <a href="<?php echo base_url('penyewa/my_sewa'); ?>" class="btn btn-primary">Lihat Riwayat Sewa</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Ulasan Anda</h5>
                                <p class="card-text">Anda telah memberikan <strong><?php echo isset($ulasan_count) ? $ulasan_count : 0; ?></strong> ulasan.</p>
                                <a href="<?php echo base_url('penyewa/riwayat_ulasan'); ?>" class="btn btn-primary">Lihat Riwayat Ulasan</a>
                            </div>
                        </div>
                    </div>
                </div>
                <h2>Pemesanan Saya</h2>
                <?php if (!empty($pemesanan)): ?>
                    <table class="table table-bordered mt-3">
                        <thead>
                            <tr>
                                <th>Nama Kosan</th>
                                <th>Tanggal Mulai</th>
                                <th>Tanggal Selesai</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($pemesanan as $pem): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($pem['nama_kosan']); ?></td>
                                    <td><?php echo htmlspecialchars($pem['tanggal_mulai']); ?></td>
                                    <td><?php echo htmlspecialchars($pem['tanggal_selesai']); ?></td>
                                    <td><?php echo htmlspecialchars($pem['status']); ?></td>
                                    <td>
                                        <?php if ($pem['status'] === 'menunggu'): ?>
                                            <a href="<?php echo base_url('penyewa/cancel_pemesanan/' . $pem['id']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin membatalkan pemesanan?');">Batalkan</a>
                                        <?php else: ?>
                                            <span class="text-muted">Tidak dapat dibatalkan</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p class="mt-3">Anda belum memiliki pemesanan.</p>
                <?php endif; ?>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>