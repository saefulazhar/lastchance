<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f6f9;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .container {
            max-width: 1200px;
            margin-top: 2rem;
            padding: 2rem;
            background: #ffffff;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #800000; /* Maroon untuk judul */
            font-weight: 600;
            margin-bottom: 1.5rem;
            text-align: center;
        }
        .alert-success {
            background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
            color: #065f46;
            border: none;
            border-radius: 8px;
            padding: 1rem;
            margin-bottom: 1.5rem;
        }
        .alert-danger {
            background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
            color: #991b1b;
            border: none;
            border-radius: 8px;
            padding: 1rem;
            margin-bottom: 1.5rem;
        }
        .alert-info {
            background: linear-gradient(135deg, #e0f2fe 0%, #bae6fd 100%);
            color: #1e40af;
            border: none;
            border-radius: 8px;
            padding: 1rem;
            margin-bottom: 1.5rem;
        }
        .card {
            background: #ffffff;
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
            background: linear-gradient(135deg, #a52a2a 0%, #800000 100%); /* Maroon gradien pada hover */
            color: #ffffff;
        }
        .card:hover .card-title,
        .card:hover .card-text,
        .card:hover .card-text strong {
            color: #ffffff !important; /* Pastikan teks tetap putih saat hover */
        }
        .card-title {
            color: #800000; /* Maroon untuk judul card */
            font-weight: 500;
        }
        .card-text {
            color: #374151;
        }
        .card-text strong {
            color: #1f2937;
        }
        .badge {
            font-size: 0.85rem;
            padding: 0.5rem 1rem;
            border-radius: 8px;
        }
        .badge-menunggu {
            background: linear-gradient(135deg, #fef08a 0%, #facc15 100%);
            color: #713f12;
        }
        .badge-aktif {
            background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
            color: #065f46;
        }
        .badge-ditolak {
            background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
            color: #991b1b;
        }
        .btn-sm {
            padding: 0.5rem 1rem;
            font-size: 0.875rem;
            border-radius: 8px;
            border: none;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .btn-sm:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }
        .btn-info {
            background: linear-gradient(135deg, #38bdf8 0%, #0ea5e9 100%);
            color: #ffffff;
        }
        .btn-info:hover {
            background: linear-gradient(135deg, #0ea5e9 0%, #0284c7 100%);
        }
        .btn-success {
            background: linear-gradient(135deg, #22c55e 0%, #16a34a 100%);
            color: #ffffff;
        }
        .btn-success:hover {
            background: linear-gradient(135deg, #16a34a 0%, #15803d 100%);
        }
        .btn-danger {
            background: linear-gradient(135deg, #800000 0%, #a52a2a 100%); /* Maroon untuk tombol */
            color: #ffffff;
        }
        .btn-danger:hover {
            background: linear-gradient(135deg, #a52a2a 0%, #800000 100%);
        }
        .icon {
            margin-right: 0.5rem;
        }
    </style>
</head>
<body>
<div class="container mt-4">
    <h1>Daftar Kosan</h1>

    <?php if ($this->session->flashdata('success')): ?>
        <div class="alert alert-success">
            <i class="bi bi-check-circle-fill icon"></i>
            <?php echo htmlspecialchars($this->session->flashdata('success'), ENT_QUOTES, 'UTF-8'); ?>
        </div>
    <?php endif; ?>
    <?php if ($this->session->flashdata('error')): ?>
        <div class="alert alert-danger">
            <i class="bi bi-exclamation-circle-fill icon"></i>
            <?php echo htmlspecialchars($this->session->flashdata('error'), ENT_QUOTES, 'UTF-8'); ?>
        </div>
    <?php endif; ?>
    <?php if (empty($kosan_list)): ?>
        <div class="alert alert-info">
            <i class="bi bi-info-circle-fill icon"></i>
            Belum ada kosan yang terdaftar.
        </div>
    <?php else: ?>
        <div class="row g-4">
            <?php foreach ($kosan_list as $kosan): ?>
                <div class="col-md-6 col-lg-4">
                    <div class="card p-3">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($kosan['nama'], ENT_QUOTES, 'UTF-8'); ?></h5>
                            <p class="card-text">
                                <strong>Alamat:</strong> <?php echo htmlspecialchars($kosan['alamat'], ENT_QUOTES, 'UTF-8'); ?>, 
                                <?php echo htmlspecialchars($kosan['desa'], ENT_QUOTES, 'UTF-8'); ?>, 
                                <?php echo htmlspecialchars($kosan['kecamatan'], ENT_QUOTES, 'UTF-8'); ?><br>
                                <strong>Harga/Bulan:</strong> Rp <?php echo number_format($kosan['harga'], 0, ',', '.'); ?><br>
                                <strong>Tipe:</strong> <?php echo htmlspecialchars(ucfirst($kosan['tipe']), ENT_QUOTES, 'UTF-8'); ?><br>
                                <strong>Jumlah Kamar:</strong> <?php echo htmlspecialchars($kosan['jumlah_kamar'], ENT_QUOTES, 'UTF-8'); ?><br>
                                <strong>Kamar Tersedia:</strong> <?php echo htmlspecialchars($kosan['kamar_tersedia'], ENT_QUOTES, 'UTF-8'); ?><br>
                                <strong>Pemilik:</strong> <?php echo htmlspecialchars($kosan['nama_pemilik'] ?: 'Tidak diketahui', ENT_QUOTES, 'UTF-8'); ?><br>
                                <strong>Status:</strong> 
                                <?php 
                                if ($kosan['status'] == 'menunggu') {
                                    echo '<span class="badge badge-menunggu">Menunggu</span>';
                                } elseif ($kosan['status'] == 'aktif') {
                                    echo '<span class="badge badge-aktif">Aktif</span>';
                                } else {
                                    echo '<span class="badge badge-ditolak">Ditolak</span>';
                                }
                                ?>
                            </p>
                            <div class="d-flex flex-wrap gap-2">
                                <a href="<?php echo base_url('admin/detail_kosan/' . $kosan['id']); ?>" 
                                   class="btn btn-sm btn-info">
                                    <i class="bi bi-eye-fill icon"></i>Detail
                                </a>
                                <?php if ($kosan['status'] == 'menunggu'): ?>
                                    <a href="<?php echo base_url('admin/verifikasi_kosan/' . $kosan['id'] . '/setujui'); ?>" 
                                       class="btn btn-sm btn-success" 
                                       onclick="return confirm('Setujui kosan ini?')">
                                        <i class="bi bi-check-circle-fill icon"></i>Setujui
                                    </a>
                                    <a href="<?php echo base_url('admin/verifikasi_kosan/' . $kosan['id'] . '/tolak'); ?>" 
                                       class="btn btn-sm btn-danger" 
                                       onclick="return confirm('Tolak kosan ini?')">
                                        <i class="bi bi-x-circle-fill icon"></i>Tolak
                                    </a>
                                <?php endif; ?>
                                <a href="<?php echo base_url('admin/hapus_kosan/' . $kosan['id']); ?>" 
                                   class="btn btn-sm btn-danger" 
                                   onclick="return confirm('Yakin ingin menghapus kosan ini?')">
                                    <i class="bi bi-trash-fill icon"></i>Hapus
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.js"></script>
</body>
</html>