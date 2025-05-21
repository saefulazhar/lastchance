<!-- Main Content -->
<div class="flex-grow-1 d-flex flex-column">
    <!-- Content Area -->
    <main class="flex-grow-1 p-4 bg-light">
        <h1>Riwayat Sewa Saya</h1>
        <?php if ($this->session->flashdata('success')): ?>
            <div class="alert alert-success"><?php echo $this->session->flashdata('success'); ?></div>
        <?php endif; ?>
        <?php if ($this->session->flashdata('error')): ?>
            <div class="alert alert-danger"><?php echo $this->session->flashdata('error'); ?></div>
        <?php endif; ?>

        <!-- Pemesanan (Menunggu Konfirmasi) -->
        <h2>Menunggu Konfirmasi</h2>
        <?php if (!empty($menunggu)): ?>
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
                    <?php foreach ($menunggu as $pem): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($pem['nama_kosan']); ?></td>
                            <td><?php echo htmlspecialchars(date('d-m-Y', strtotime($pem['tanggal_mulai']))); ?></td>
                            <td><?php echo htmlspecialchars(date('d-m-Y', strtotime($pem['tanggal_selesai']))); ?></td>
                            <td><?php echo htmlspecialchars(ucfirst($pem['status'] ?? 'Menunggu')); ?></td>
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

        <!-- Sewa Aktif -->
        <h2>Sewa Aktif</h2>
        <?php if (!empty($sewa_aktif)): ?>
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
                    <?php foreach ($sewa_aktif as $sewa): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($sewa['nama_kosan']); ?></td>
                            <td><?php echo htmlspecialchars(date('d-m-Y', strtotime($sewa['tanggal_mulai']))); ?></td>
                            <td><?php echo htmlspecialchars(date('d-m-Y', strtotime($sewa['tanggal_selesai']))); ?></td>
                            <td><?php echo htmlspecialchars(ucfirst($sewa['status'] ?? 'Aktif')); ?></td>
                            <td>
                                <?php if (!$sewa['has_ulasan']): ?>
                                    <a href="<?php echo base_url('penyewa/beri_ulasan/' . $sewa['kosan_id']); ?>" class="btn btn-primary btn-sm">Beri Ulasan</a>
                                <?php endif; ?>
                                <?php if ($sewa['can_report']): ?>
                                    <a href="<?php echo base_url('penyewa/buat_laporan/' . $sewa['kosan_id']); ?>" class="btn btn-warning btn-sm mt-2">Laporkan</a>
                                <?php else: ?>
                                    <span class="text-muted mt-2 d-block">Anda sudah melaporkan kosan ini. Tunggu hingga <?php echo htmlspecialchars($sewa['next_report_date']); ?> untuk melaporkan lagi.</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p class="mt-3">Anda belum memiliki sewa aktif.</p>
        <?php endif; ?>

        <!-- Sewa Selesai -->
        <h2>Sewa Selesai</h2>
        <?php if (!empty($sewa_selesai)): ?>
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
                    <?php foreach ($sewa_selesai as $sewa): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($sewa['nama_kosan']); ?></td>
                            <td><?php echo htmlspecialchars(date('d-m-Y', strtotime($sewa['tanggal_mulai']))); ?></td>
                            <td><?php echo htmlspecialchars(date('d-m-Y', strtotime($sewa['tanggal_selesai']))); ?></td>
                            <td><?php echo htmlspecialchars(ucfirst($sewa['status'] ?? 'Selesai')); ?></td>
                            <td>
                                <?php if (!$sewa['has_ulasan']): ?>
                                    <a href="<?php echo base_url('penyewa/beri_ulasan/' . $sewa['kosan_id']); ?>" class="btn btn-primary btn-sm">Beri Ulasan</a>
                                <?php endif; ?>
                                <?php if ($sewa['can_report']): ?>
                                    <a href="<?php echo base_url('penyewa/buat_laporan/' . $sewa['kosan_id']); ?>" class="btn btn-warning btn-sm mt-2">Laporkan</a>
                                <?php else: ?>
                                    <span class="text-muted mt-2 d-block">Anda sudah melaporkan kosan ini. Tunggu hingga <?php echo htmlspecialchars($sewa['next_report_date']); ?> untuk melaporkan lagi.</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p class="mt-3">Anda belum memiliki sewa yang selesai.</p>
        <?php endif; ?>
    </main>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>