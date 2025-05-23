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
            max-width: 1000px; /* Sedikit lebih lebar untuk detail kosan */
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
        .badge-fasilitas {
            font-size: 0.9rem;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            background: linear-gradient(135deg, #38bdf8 0%, #0ea5e9 100%);
            color: #ffffff;
            transition: transform 0.3s ease;
        }
        .badge-fasilitas:hover {
            transform: scale(1.1);
        }
        .foto-kosan {
            width: 100%;
            border-radius: 10px;
            border: 2px solid #800000; /* Maroon untuk border gambar */
            transition: transform 0.3s ease;
        }
        .foto-kosan:hover {
            transform: scale(1.05);
        }
        .google-maps-link {
            color: #38bdf8;
            text-decoration: none;
            transition: color 0.3s ease;
        }
        .google-maps-link:hover {
            color: #0ea5e9;
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
<div class="container mt-4">
    <h1>Detail Kosan: <?php echo htmlspecialchars($kosan['nama'], ENT_QUOTES, 'UTF-8'); ?></h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title"><?php echo htmlspecialchars($kosan['nama'], ENT_QUOTES, 'UTF-8'); ?></h5>
            <p class="card-text"><strong>Alamat:</strong> <?php echo htmlspecialchars($kosan['alamat'], ENT_QUOTES, 'UTF-8'); ?>, <?php echo htmlspecialchars($kosan['desa'], ENT_QUOTES, 'UTF-8'); ?>, <?php echo htmlspecialchars($kosan['kecamatan'], ENT_QUOTES, 'UTF-8'); ?></p>
            <p class="card-text"><strong>Harga per Bulan:</strong> Rp <?php echo number_format($kosan['harga'], 0, ',', '.'); ?></p>
            <p class="card-text"><strong>Tipe:</strong> <?php echo htmlspecialchars(ucfirst($kosan['tipe']), ENT_QUOTES, 'UTF-8'); ?></p>
            <p class="card-text"><strong>Kepribadian:</strong> <?php echo htmlspecialchars(ucfirst($kosan['kepribadian']), ENT_QUOTES, 'UTF-8'); ?></p>
            <p class="card-text"><strong>Jumlah Kamar:</strong> <?php echo htmlspecialchars($kosan['jumlah_kamar'], ENT_QUOTES, 'UTF-8'); ?></p>
            <p class="card-text"><strong>Kamar Tersedia:</strong> <?php echo htmlspecialchars($kosan['kamar_tersedia'], ENT_QUOTES, 'UTF-8'); ?></p>
            <p class="card-text"><strong>Deskripsi:</strong> <?php echo htmlspecialchars($kosan['deskripsi'] ?: 'Tidak ada deskripsi.', ENT_QUOTES, 'UTF-8'); ?></p>
            <p class="card-text"><strong>Link Google Maps:</strong> 
                <?php if ($kosan['google_maps_link']): ?>
                    <a href="<?php echo htmlspecialchars($kosan['google_maps_link'], ENT_QUOTES, 'UTF-8'); ?>" target="_blank" class="google-maps-link">
                        <i class="bi bi-geo-alt-fill icon"></i>Lihat di Google Maps
                    </a>
                <?php else: ?>
                    <span>Tidak tersedia.</span>
                <?php endif; ?>
            </p>
            <p class="card-text"><strong>Pemilik:</strong> <?php echo htmlspecialchars($kosan['nama_pemilik'] ?: 'Tidak diketahui', ENT_QUOTES, 'UTF-8'); ?></p>
            <p class="card-text"><strong>Fasilitas:</strong> 
                <?php if (empty($fasilitas)): ?>
                    <span>Tidak ada fasilitas.</span>
                <?php else: ?>
                    <div class="d-flex flex-wrap gap-2">
                        <?php foreach ($fasilitas as $f): ?>
                            <span class="badge badge-fasilitas"><?php echo htmlspecialchars($f['nama_fasilitas'], ENT_QUOTES, 'UTF-8'); ?></span>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </p>
            <p class="card-text"><strong>Foto Kosan:</strong></p>
            <?php if (empty($foto_kosan)): ?>
                <p>Tidak ada foto.</p>
            <?php else: ?>
                <div class="row g-3">
                    <?php foreach ($foto_kosan as $foto): ?>
                        <div class="col-md-3">
                            <img src="<?php echo base_url(htmlspecialchars($foto['path'], ENT_QUOTES, 'UTF-8')); ?>" alt="Foto Kosan" class="foto-kosan">
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <a href="<?php echo base_url('admin/daftar_kosan'); ?>" class="btn btn-kembali mt-3">
        <i class="bi bi-arrow-left-circle-fill icon"></i>Kembali ke Daftar
    </a>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.js"></script>
</body>
</html>