<div class="container mt-4">
    <h1>Dashboard Penyewa</h1>
    <p>Selamat datang, <?php echo $this->session->userdata('username'); ?>!</p>
    <p>Sebagai penyewa, Anda dapat mencari kosan dan melakukan pemesanan.</p>
    <h2>Riwayat Pemesanan</h2>
    <?php if ($this->session->flashdata('success')): ?>
        <div class="alert alert-success"><?php echo $this->session->flashdata('success'); ?></div>
    <?php endif; ?>
    <?php if (empty($pemesanan)): ?>
        <p>Belum ada pemesanan.</p>
    <?php else: ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Kosan</th>
                    <th>Durasi (bulan)</th>
                    <th>Tanggal Mulai</th>
                    <th>Total Harga (Rp)</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pemesanan as $p): ?>
                    <tr>
                        <td><?php echo $p['nama_kosan']; ?></td>
                        <td><?php echo $p['durasi']; ?></td>
                        <td><?php echo $p['tanggal_mulai']; ?></td>
                        <td><?php echo number_format($p['total_harga'], 0, ',', '.'); ?></td>
                        <td><?php echo ucfirst($p['status']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>