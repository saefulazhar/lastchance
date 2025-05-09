<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="container mt-5">
    <h2>Manajemen Sewa</h2>

    <?php if ($this->session->flashdata('success')): ?>
        <div class="alert alert-success"><?php echo $this->session->flashdata('success'); ?></div>
    <?php endif; ?>
    <?php if ($this->session->flashdata('error')): ?>
        <div class="alert alert-danger"><?php echo $this->session->flashdata('error'); ?></div>
    <?php endif; ?>

    <?php if (!empty($sewa) && is_array($sewa)): ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Kosan</th>
                    <th>Penyewa</th>
                    <th>Tanggal Mulai</th>
                    <th>Tanggal Selesai</th>
                    <th>Total Harga</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($sewa as $s): ?>
                    <tr>
                        <td><?php echo $s['nama_kosan']; ?></td>
                        <td><?php echo $s['penyewa_username']; ?></td>
                        <td><?php echo $s['tanggal_mulai']; ?></td>
                        <td><?php echo $s['tanggal_selesai']; ?></td>
                        <td>
                            <?php
                            if (isset($s['harga_kosan']) && $s['harga_kosan']) {
                                $start = new DateTime($s['tanggal_mulai']);
                                $end = new DateTime($s['tanggal_selesai']);
                                $interval = $start->diff($end);
                                $months = $interval->y * 12 + $interval->m + ($interval->d > 0 ? 1 : 0);
                                $total_harga = $s['harga_kosan'] * $months;
                                echo 'Rp ' . number_format($total_harga, 0, ',', '.');
                            } else {
                                echo 'N/A';
                            }
                            ?>
                        </td>
                        <td><?php echo $s['status']; ?></td>
                        <td>
                            <?php if ($s['status'] == 'menunggu'): ?>
                                <a href="<?php echo base_url('pemilik/terima_sewa/' . $s['id']); ?>" class="btn btn-success btn-sm" onclick="return confirm('Yakin ingin menerima pemesanan ini?');">Terima</a>
                                <a href="<?php echo base_url('pemilik/tolak_sewa/' . $s['id']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menolak pemesanan ini?');">Tolak</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Belum ada pemesanan untuk kosan Anda.</p>
    <?php endif; ?>
</div>