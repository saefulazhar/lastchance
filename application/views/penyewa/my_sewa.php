<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Sewa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
</head>
<body>
    <div class="d-flex min-vh-100">
        <!-- Sidebar -->
        <div class="bg-dark text-white" style="width: 250px;">
            <ul class="nav flex-column p-3">
                <li class="nav-item">
                    <a class="nav-link text-white d-flex align-items-center" href="<?php echo base_url('penyewa'); ?>">
                        <svg class="bi me-2" width="20" height="20" fill="currentColor"><use xlink:href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css#house"/></svg>
                        Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white d-flex align-items-center" href="<?php echo base_url('penyewa/profile'); ?>">
                        <svg class="bi me-2" width="20" height="20" fill="currentColor"><use xlink:href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css#person"/></svg>
                        Profile
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white d-flex align-items-center" href="<?php echo base_url('penyewa/my_sewa'); ?>">
                        <svg class="bi me-2" width="20" height="20" fill="currentColor"><use xlink:href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css#clock-history"/></svg>
                        Riwayat Sewa
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white d-flex align-items-center" href="<?php echo base_url('penyewa/laporan'); ?>">
                        <svg class="bi me-2" width="20" height="20" fill="currentColor"><use xlink:href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css#file-text"/></svg>
                        Laporan Saya
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white d-flex align-items-center" href="<?php echo base_url('penyewa/riwayat_ulasan'); ?>">
                        <svg class="bi me-2" width="20" height="20" fill="currentColor"><use xlink:href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css#chat-left-text"/></svg>
                        Riwayat Ulasan
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white d-flex align-items-center" href="<?php echo base_url('auth/logout'); ?>">
                        <svg class="bi me-2" width="20" height="20" fill="currentColor"><use xlink:href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css#box-arrow-left"/></svg>
                        Logout
                    </a>
                </li>
            </ul>
        </div>

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
                                        <?php if ($pem['status'] == 'menunggu'): ?>
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
                                    <td><?php echo htmlspecialchars($sewa['tanggal_mulai']); ?></td>
                                    <td><?php echo htmlspecialchars($sewa['tanggal_selesai']); ?></td>
                                    <td><?php echo htmlspecialchars($sewa['status']); ?></td>
                                    <td>
                                        <?php if (!$sewa['has_ulasan']): ?>
                                            <a href="<?php echo base_url('penyewa/add_ulasan/' . $sewa['id']); ?>" class="btn btn-primary btn-sm">Beri Ulasan</a>
                                        <?php else: ?>
                                            <span class="text-muted">Sudah diulas</span>
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
                                    <td><?php echo htmlspecialchars($sewa['tanggal_mulai']); ?></td>
                                    <td><?php echo htmlspecialchars($sewa['tanggal_selesai']); ?></td>
                                    <td><?php echo htmlspecialchars($sewa['status']); ?></td>
                                    <td>
                                        <?php if (!$sewa['has_ulasan']): ?>
                                            <a href="<?php echo base_url('penyewa/add_ulasan/' . $sewa['id']); ?>" class="btn btn-primary btn-sm">Beri Ulasan</a>
                                        <?php else: ?>
                                            <span class="text-muted">Sudah diulas</span>
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
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>