<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="container mt-5">
    <h2>Daftar Pemesanan Anda</h2>

    <?php if ($this->session->flashdata('success')): ?>
        <div class="alert alert-success"><?php echo $this->session->flashdata('success'); ?></div>
    <?php endif; ?>
    <?php if ($this->session->flashdata('error')): ?>
        <div class="alert alert-danger"><?php echo $this->session->flashdata('error'); ?></div>
    <?php endif; ?>

    <?php if (!empty($pemesanan) && is_array($pemesanan)): ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Kosan</th>
                    <th>Tanggal Mulai</th>
                    <th>Tanggal Selesai</th>
                    <th>Total Harga</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pemesanan as $p): ?>
                    <tr>
                        <td><?php echo $p['nama_kosan']; ?></td>
                        <td><?php echo $p['tanggal_mulai']; ?></td>
                        <td><?php echo $p['tanggal_selesai']; ?></td>
                        <td>
                            <?php
                            $start = new DateTime($p['tanggal_mulai']);
                            $end = new DateTime($p['tanggal_selesai']);
                            $interval = $start->diff($end);
                            $months = $interval->y * 12 + $interval->m + ($interval->d > 0 ? 1 : 0); // Bulatkan ke bulan berikutnya jika ada hari tambahan
                            $total_harga = $p['harga_kosan'] * $months;
                            echo 'Rp ' . number_format($total_harga, 0, ',', '.');
                            ?>
                        </td>
                        <td><?php echo $p['status']; ?></td>
                        <td>
                            <?php if ($p['status'] == 'menunggu'): ?>
                                <a href="<?php echo base_url('penyewa/cancel_pemesanan/' . $p['id']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin membatalkan pemesanan ini?');">Batal</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Belum ada pemesanan yang diajukan.</p>
    <?php endif; ?>
</div>