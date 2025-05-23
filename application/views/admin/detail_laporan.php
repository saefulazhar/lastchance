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
        .main-content {
            padding: 2rem 0;
        }
        .container {
            max-width: 800px; /* Lebih sempit untuk fokus pada detail */
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
        }
        .card-title {
            color: #800000; /* Maroon untuk judul card */
            font-weight: 500;
            font-size: 1.5rem;
        }
        .card-text {
            color: #374151;
            line-height: 1.6;
        }
        .card-text strong {
            color: #1f2937;
            font-weight: 500;
        }
        .status-badge {
            font-size: 0.85rem;
            padding: 0.5rem 1rem;
            border-radius: 8px;
        }
        .status-menunggu {
            background: linear-gradient(135deg, #fef08a 0%, #facc15 100%);
            color: #713f12;
        }
        .status-diproses {
            background: linear-gradient(135deg, #bfdbfe 0%, #93c5fd 100%);
            color: #1e40af;
        }
        .status-selesai {
            background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
            color: #065f46;
        }
        .status-ditolak {
            background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
            color: #991b1b;
        }
        .lampiran-img {
            max-width: 300px;
            border-radius: 10px;
            border: 2px solid #800000; /* Maroon untuk border gambar */
            transition: transform 0.3s ease;
        }
        .lampiran-img:hover {
            transform: scale(1.05);
        }
        .btn-kembali {
            background: linear-gradient(135deg, #800000 0%, #a52a2a 100%); /* Maroon untuk tombol */
            color: #ffffff;
            border: none;
            border-radius: 8px;
            padding: 0.75rem 1.5rem;
            font-size: 1rem;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .btn-kembali:hover {
            background: linear-gradient(135deg, #a52a2a 0%, #800000 100%);
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }
        .icon {
            margin-right: 0.5rem;
        }
    </style>
</head>
<body>
<div class="main-content">
    <div class="container mt-4">
        <h1>Detail Laporan</h1>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-3"><?php echo htmlspecialchars($laporan['judul'], ENT_QUOTES, 'UTF-8'); ?></h5>
                <div class="mb-3">
                    <p class="mb-1"><strong>Deskripsi:</strong></p>
                    <p class="card-text"><?php echo htmlspecialchars($laporan['deskripsi'], ENT_QUOTES, 'UTF-8'); ?></p>
                </div>
                <div class="mb-3">
                    <p class="mb-1"><strong>Kosan:</strong></p>
                    <p class="card-text"><?php echo htmlspecialchars($laporan['nama_kosan'] ?? 'Tidak Ditentukan', ENT_QUOTES, 'UTF-8'); ?></p>
                </div>
                <div class="mb-3">
                    <p class="mb-1"><strong>Pelapor:</strong></p>
                    <p class="card-text"><?php echo htmlspecialchars($laporan['nama_user'] ?? 'Tidak Diketahui', ENT_QUOTES, 'UTF-8'); ?></p>
                </div>
                <!-- <div class="mb-3">
                    <p class="mb-1"><strong>Status:</strong></p>
                    <p class="card-text">
                        <span class="status-badge status-<?php echo htmlspecialchars(strtolower($laporan['status']), ENT_QUOTES, 'UTF-8'); ?>">
                            <?php echo htmlspecialchars($laporan['status'], ENT_QUOTES, 'UTF-8'); ?>
                        </span>
                    </p>
                </div> -->
                <div class="mb-3">
                    <p class="mb-1"><strong>Tanggal Dibuat:</strong></p>
                    <p class="card-text"><?php echo htmlspecialchars($laporan['created_at'], ENT_QUOTES, 'UTF-8'); ?></p>
                </div>
                <div class="mb-3">
                    <p class="mb-1"><strong>Lampiran:</strong></p>
                    <?php if ($laporan['lampiran']): ?>
                        <a href="<?php echo base_url($laporan['lampiran']); ?>" target="_blank">
                            <img src="<?php echo base_url($laporan['lampiran']); ?>" alt="Lampiran Laporan" class="lampiran-img">
                        </a>
                    <?php else: ?>
                        <p class="card-text">Tidak ada</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <a href="<?php echo base_url('admin/daftar_laporan'); ?>" class="btn btn-kembali mt-3">
            <i class="bi bi-arrow-left-circle-fill icon"></i>Kembali
        </a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.js"></script>
</body>
</html>