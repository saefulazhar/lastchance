<div class="container mt-4">
    <h1>Daftar Kosan</h1>
    <?php if ($this->session->flashdata('success')): ?>
        <div class="alert alert-success"><?php echo htmlspecialchars($this->session->flashdata('success')); ?></div>
    <?php endif; ?>
    <?php if ($this->session->flashdata('error')): ?>
        <div class="alert alert-danger"><?php echo htmlspecialchars($this->session->flashdata('error')); ?></div>
    <?php endif; ?>
    <?php if (empty($kosan_list)): ?>
        <div class="alert alert-info">Belum ada kosan yang terdaftar.</div>
    <?php else: ?>
        <table class="table table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>No</th>
                    <th>Nama Kosan</th>
                    <th>Alamat</th>
                    <th>Harga/Bulan (Rp)</th>
                    <th>Tipe</th>
                    <th>Jumlah Kamar</th>
                    <th>Kamar Tersedia</th>
                    <th>Pemilik</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; foreach ($kosan_list as $kosan): ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo htmlspecialchars($kosan['nama']); ?></td>
                        <td>
                            <?php echo htmlspecialchars($kosan['alamat']); ?>, 
                            <?php echo htmlspecialchars($kosan['desa']); ?>, 
                            <?php echo htmlspecialchars($kosan['kecamatan']); ?>
                        </td>
                        <td><?php echo number_format($kosan['harga'], 0, ',', '.'); ?></td>
                        <td><?php echo htmlspecialchars(ucfirst($kosan['tipe'])); ?></td>
                        <td><?php echo htmlspecialchars($kosan['jumlah_kamar']); ?></td>
                        <td><?php echo htmlspecialchars($kosan['kamar_tersedia']); ?></td>
                        <td><?php echo htmlspecialchars($kosan['nama_pemilik'] ?: 'Tidak diketahui'); ?></td>
                        <td>
                            <?php 
                            if ($kosan['status'] == 'menunggu') {
                                echo '<span class="badge badge-warning">Menunggu</span>';
                            } elseif ($kosan['status'] == 'aktif') {
                                echo '<span class="badge badge-success">Aktif</span>';
                            } else {
                                echo '<span class="badge badge-danger">Ditolak</span>';
                            }
                            ?>
                        </td>
                        <td>
                            <a href="<?php echo base_url('admin/detail_kosan/' . $kosan['id']); ?>" class="btn btn-sm btn-info">Detail</a>
                            <?php if ($kosan['status'] == 'menunggu'): ?>
                                <a href="<?php echo base_url('admin/verifikasi_kosan/' . $kosan['id'] . '/setujui'); ?>" class="btn btn-sm btn-success" onclick="return confirm('Setujui kosan ini?')">Setujui</a>
                                <a href="<?php echo base_url('admin/verifikasi_kosan/' . $kosan['id'] . '/tolak'); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Tolak kosan ini?')">Tolak</a>
                            <?php endif; ?>
                            <a href="<?php echo base_url('admin/hapus_kosan/' . $kosan['id']); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus kosan ini?')">Hapus</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>