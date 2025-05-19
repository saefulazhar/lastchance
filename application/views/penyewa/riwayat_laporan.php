<div class="main-content">
    <div class="container mt-4">
        <h1>Riwayat Laporan</h1>
        <?php if ($this->session->flashdata('success')): ?>
            <div class="alert alert-success"><?php echo $this->session->flashdata('success'); ?></div>
        <?php endif; ?>
        <?php if ($this->session->flashdata('error')): ?>
            <div class="alert alert-danger"><?php echo $this->session->flashdata('error'); ?></div>
        <?php endif; ?>

        <?php if (empty($laporan)): ?>
            <p>Anda belum membuat laporan.</p>
        <?php else: ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Judul</th>
                        <th>Deskripsi</th>
                        <th>Kosan</th>
                        <th>Pembuat</th>
                        <!-- <th>Status</th> -->
                        <th>Tanggal Dibuat</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($laporan as $item): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($item['judul']); ?></td>
                            <td><?php echo htmlspecialchars($item['deskripsi']); ?></td>
                            <td><?php echo htmlspecialchars($item['nama_kosan'] ?? 'Tidak Ditentukan'); ?></td>
                            <td><?php echo htmlspecialchars($item['nama_user'] ?? 'Tidak Diketahui'); ?></td>
                            <!-- <td><?php echo htmlspecialchars($item['status']); ?></td> -->
                            <td><?php echo htmlspecialchars($item['created_at']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</div>