<div class="main-content">
    <div class="container mt-4">
        <h1>Daftar Laporan</h1>
        <?php if ($this->session->flashdata('success')): ?>
            <div class="alert alert-success"><?php echo $this->session->flashdata('success'); ?></div>
        <?php endif; ?>
        <?php if ($this->session->flashdata('error')): ?>
            <div class="alert alert-danger"><?php echo $this->session->flashdata('error'); ?></div>
        <?php endif; ?>

        <?php if (empty($laporan)): ?>
            <p class="mt-3">Tidak ada laporan yang tersedia.</p>
        <?php else: ?>
            <table class="table table-bordered mt-3">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Judul</th>
                        <th>Deskripsi</th>
                        <th>Kosan</th>
                        <th>Pelapor</th>
                        <!-- <th>Status</th> -->
                        <th>Tanggal Dibuat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; foreach ($laporan as $item): ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo htmlspecialchars($item['judul']); ?></td>
                            <td><?php echo htmlspecialchars($item['deskripsi']); ?></td>
                            <td><?php echo htmlspecialchars($item['nama_kosan'] ?? 'Tidak Ditentukan'); ?></td>
                            <td><?php echo htmlspecialchars($item['nama_user'] ?? 'Tidak Diketahui'); ?></td>
                            <!-- <td><?php echo htmlspecialchars($item['status']); ?></td> -->
                            <td><?php echo htmlspecialchars($item['created_at']); ?></td>
                            <td>
                                <a href="<?php echo base_url('admin/detail_laporan/' . $item['id']); ?>" class="btn btn-info btn-sm">Detail</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</div>