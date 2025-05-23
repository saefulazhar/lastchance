<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Kosan - <?php echo htmlspecialchars($kosan['nama']); ?></title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #2563eb;
            --secondary-color: #64748b;
            --success-color: #10b981;
            --warning-color: #f59e0b;
            --danger-color: #ef4444;
            --light-gray: #f8fafc;
            --border-color: #e2e8f0;
            --shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }

        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            padding: 2rem 0;
        }

        .main-container {
            background: white;
            border-radius: 20px;
            box-shadow: var(--shadow-lg);
            overflow: hidden;
            margin: 0 auto;
            max-width: 1200px;
        }

        .header-section {
            background: linear-gradient(135deg, var(--primary-color) 0%, #1e40af 100%);
            color: white;
            padding: 2rem;
            position: relative;
        }

        .header-section h1 {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            text-shadow: 0 2px 4px rgba(0,0,0,0.2);
        }

        .back-btn {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.3);
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
        }

        .back-btn:hover {
            background: rgba(255, 255, 255, 0.3);
            color: white;
            transform: translateY(-2px);
        }

        .content-section {
            padding: 2rem;
        }

        .info-card {
            background: white;
            border-radius: 15px;
            padding: 2rem;
            box-shadow: var(--shadow);
            border: 1px solid var(--border-color);
            margin-bottom: 2rem;
        }

        .gallery-section {
            margin-bottom: 2rem;
        }

        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
        }

        .gallery-item {
            border-radius: 15px;
            overflow: hidden;
            box-shadow: var(--shadow);
            transition: transform 0.3s ease;
        }

        .gallery-item:hover {
            transform: scale(1.05);
        }

        .gallery-item img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .detail-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .detail-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem;
            background: var(--light-gray);
            border-radius: 10px;
            border-left: 4px solid var(--primary-color);
        }

        .detail-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, var(--primary-color) 0%, #1e40af 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            flex-shrink: 0;
        }

        .detail-content h6 {
            margin: 0;
            color: var(--secondary-color);
            font-size: 0.9rem;
            font-weight: 500;
        }

        .detail-content p {
            margin: 0;
            color: #1f2937;
            font-weight: 600;
        }

        .rating-display {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .stars {
            color: #fbbf24;
        }

        .facilities-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-top: 1rem;
        }

        .facility-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem 1rem;
            background: rgba(37, 99, 235, 0.05);
            border-radius: 10px;
            border: 1px solid rgba(37, 99, 235, 0.1);
        }

        .facility-icon {
            color: var(--primary-color);
            font-size: 1.1rem;
        }

        .section-title {
            color: var(--primary-color);
            font-weight: 700;
            font-size: 1.5rem;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .review-card {
            background: white;
            border-radius: 15px;
            padding: 1.5rem;
            box-shadow: var(--shadow);
            border: 1px solid var(--border-color);
            margin-bottom: 1rem;
        }

        .review-header {
            display: flex;
            justify-content: between;
            align-items: flex-start;
            margin-bottom: 1rem;
        }

        .reviewer-info {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .reviewer-avatar {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, var(--primary-color) 0%, #1e40af 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 1.2rem;
        }

        .reviewer-details h6 {
            margin: 0;
            color: #1f2937;
            font-weight: 600;
        }

        .review-rating {
            display: flex;
            align-items: center;
            gap: 0.25rem;
            margin: 0.25rem 0;
        }

        .review-content {
            background: var(--light-gray);
            padding: 1rem;
            border-radius: 10px;
            margin: 1rem 0;
            font-style: italic;
        }

        .review-date {
            color: var(--secondary-color);
            font-size: 0.85rem;
        }

        .btn {
            border-radius: 10px;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 0.75rem 1.5rem;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary-color) 0%, #1e40af 100%);
            border: none;
            box-shadow: var(--shadow);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
        }

        .btn-warning {
            background: linear-gradient(135deg, var(--warning-color) 0%, #d97706 100%);
            border: none;
        }

        .no-data {
            text-align: center;
            padding: 2rem;
            color: var(--secondary-color);
        }

        .no-data i {
            font-size: 3rem;
            color: var(--border-color);
            margin-bottom: 1rem;
        }

        .maps-link {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .maps-link:hover {
            color: #1e40af;
            transform: translateX(5px);
        }

        @media (max-width: 768px) {
            body {
                padding: 1rem 0;
            }

            .main-container {
                margin: 0 1rem;
                border-radius: 15px;
            }

            .header-section, .content-section {
                padding: 1.5rem;
            }

            .header-section h1 {
                font-size: 1.5rem;
            }

            .detail-grid {
                grid-template-columns: 1fr;
            }

            .gallery-grid {
                grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            }

            .facilities-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="main-container">
        <div class="header-section">
            <a href="<?php echo base_url('home'); ?>" class="btn back-btn mb-3">
                <i class="fas fa-arrow-left"></i> Kembali ke Daftar
            </a>
            <h1><i class="fas fa-home"></i> <?php echo htmlspecialchars($kosan['nama']); ?></h1>
        </div>

        <div class="content-section">
            <!-- Gallery Section -->
            <?php if (!empty($foto_kosan)): ?>
                <div class="gallery-section">
                    <h3 class="section-title">
                        <i class="fas fa-images"></i> Galeri Foto
                    </h3>
                    <div class="gallery-grid">
                        <?php foreach ($foto_kosan as $foto): ?>
                            <div class="gallery-item">
                                <img src="<?php echo base_url($foto['path']); ?>" alt="Foto Kosan" onclick="openModal(this.src)">
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php else: ?>
                <div class="no-data">
                    <i class="fas fa-image"></i>
                    <h4>Tidak Ada Foto</h4>
                    <p>Belum ada foto yang tersedia untuk kosan ini.</p>
                </div>
            <?php endif; ?>

            <!-- Detail Information -->
            <div class="info-card">
                <h3 class="section-title">
                    <i class="fas fa-info-circle"></i> Informasi Detail
                </h3>
                <div class="detail-grid">
                    <div class="detail-item">
                        <div class="detail-icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div class="detail-content">
                            <h6>Alamat</h6>
                            <p><?php echo htmlspecialchars($kosan['alamat']); ?>, <?php echo htmlspecialchars($kosan['desa']); ?>, <?php echo htmlspecialchars($kosan['kecamatan']); ?></p>
                        </div>
                    </div>

                    <div class="detail-item">
                        <div class="detail-icon">
                            <i class="fas fa-money-bill-wave"></i>
                        </div>
                        <div class="detail-content">
                            <h6>Harga per Bulan</h6>
                            <p>Rp <?php echo number_format($kosan['harga'], 0, ',', '.'); ?></p>
                        </div>
                    </div>

                    <div class="detail-item">
                        <div class="detail-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="detail-content">
                            <h6>Tipe Kosan</h6>
                            <p><?php echo htmlspecialchars(ucfirst($kosan['tipe'])); ?></p>
                        </div>
                    </div>

                    <div class="detail-item">
                        <div class="detail-icon">
                            <i class="fas fa-user-friends"></i>
                        </div>
                        <div class="detail-content">
                            <h6>Kepribadian</h6>
                            <p><?php echo htmlspecialchars(ucfirst($kosan['kepribadian'])); ?></p>
                        </div>
                    </div>

                    <div class="detail-item">
                        <div class="detail-icon">
                            <i class="fas fa-door-open"></i>
                        </div>
                        <div class="detail-content">
                            <h6>Jumlah Kamar</h6>
                            <p><?php echo htmlspecialchars($kosan['jumlah_kamar']); ?> kamar</p>
                        </div>
                    </div>

                    <div class="detail-item">
                        <div class="detail-icon">
                            <i class="fas fa-door-closed"></i>
                        </div>
                        <div class="detail-content">
                            <h6>Kamar Tersedia</h6>
                            <p><?php echo htmlspecialchars($kosan['kamar_tersedia']); ?> kamar</p>
                        </div>
                    </div>

                    <div class="detail-item">
                        <div class="detail-icon">
                            <i class="fas fa-star"></i>
                        </div>
                        <div class="detail-content">
                            <h6>Rating</h6>
                            <div class="rating-display">
                                <div class="stars">
                                    <?php 
                                    $rating = number_format($rata_rating, 1);
                                    $fullStars = floor($rating);
                                    $hasHalfStar = ($rating - $fullStars) >= 0.5;
                                    
                                    for ($i = 0; $i < $fullStars; $i++) {
                                        echo '<i class="fas fa-star"></i>';
                                    }
                                    if ($hasHalfStar) {
                                        echo '<i class="fas fa-star-half-alt"></i>';
                                    }
                                    for ($i = $fullStars + ($hasHalfStar ? 1 : 0); $i < 5; $i++) {
                                        echo '<i class="far fa-star"></i>';
                                    }
                                    ?>
                                </div>
                                <span><?php echo $rating; ?>/5</span>
                            </div>
                        </div>
                    </div>

                    <div class="detail-item">
                        <div class="detail-icon">
                            <i class="fas fa-user"></i>
                        </div>
                        <div class="detail-content">
                            <h6>Pemilik</h6>
                            <p><?php echo htmlspecialchars($kosan['nama_pemilik'] ?: 'Tidak diketahui'); ?></p>
                        </div>
                    </div>
                </div>

                <?php if ($kosan['deskripsi']): ?>
                    <div class="detail-item" style="grid-column: 1 / -1; margin-top: 1rem;">
                        <div class="detail-icon">
                            <i class="fas fa-align-left"></i>
                        </div>
                        <div class="detail-content">
                            <h6>Deskripsi</h6>
                            <p><?php echo htmlspecialchars($kosan['deskripsi']); ?></p>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if ($kosan['google_maps_link']): ?>
                    <div class="detail-item" style="grid-column: 1 / -1; margin-top: 1rem;">
                        <div class="detail-icon">
                            <i class="fas fa-map"></i>
                        </div>
                        <div class="detail-content">
                            <h6>Lokasi</h6>
                            <a href="<?php echo htmlspecialchars($kosan['google_maps_link']); ?>" target="_blank" class="maps-link">
                                <i class="fas fa-external-link-alt"></i> Lihat di Google Maps
                            </a>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Facilities Section -->
            <div class="info-card">
                <h3 class="section-title">
                    <i class="fas fa-concierge-bell"></i> Fasilitas
                </h3>
                <?php if (!empty($fasilitas)): ?>
                    <div class="facilities-grid">
                        <?php foreach ($fasilitas as $f): ?>
                            <div class="facility-item">
                                <i class="fas fa-check-circle facility-icon"></i>
                                <span><?php echo htmlspecialchars($f['nama_fasilitas']); ?></span>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="no-data">
                        <i class="fas fa-concierge-bell"></i>
                        <h4>Tidak Ada Fasilitas</h4>
                        <p>Belum ada fasilitas yang terdaftar untuk kosan ini.</p>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Reviews Section -->
            <div class="info-card">
                <h3 class="section-title">
                    <i class="fas fa-comments"></i> Ulasan & Rating
                </h3>
                
                <?php if (empty($ulasan_list)): ?>
                    <div class="no-data">
                        <i class="fas fa-comment-slash"></i>
                        <h4>Belum Ada Ulasan</h4>
                        <p>Jadilah yang pertama memberikan ulasan untuk kosan ini.</p>
                    </div>
                <?php else: ?>
                    <?php foreach ($ulasan_list as $ulasan): ?>
                        <div class="review-card">
                            <div class="review-header">
                                <div class="reviewer-info">
                                    <div class="reviewer-avatar">
                                        <?php echo strtoupper(substr($ulasan['penyewa_username'] ?: 'A', 0, 1)); ?>
                                    </div>
                                    <div class="reviewer-details">
                                        <h6><?php echo htmlspecialchars($ulasan['penyewa_username'] ?: 'Anonim'); ?></h6>
                                        <div class="review-rating">
                                            <?php 
                                            $userRating = $ulasan['rating'];
                                            for ($i = 1; $i <= 5; $i++) {
                                                echo $i <= $userRating ? '<i class="fas fa-star" style="color: #fbbf24;"></i>' : '<i class="far fa-star" style="color: #d1d5db;"></i>';
                                            }
                                            ?>
                                            <span class="ms-2"><?php echo number_format($ulasan['rating'], 1); ?>/5</span>
                                        </div>
                                        <div class="review-date">
                                            <i class="fas fa-calendar-alt"></i>
                                            <?php echo date('d F Y, H:i', strtotime($ulasan['created_at'])); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <?php if ($ulasan['ulasan']): ?>
                                <div class="review-content">
                                    <i class="fas fa-quote-left" style="color: var(--secondary-color); margin-right: 0.5rem;"></i>
                                    <?php echo htmlspecialchars($ulasan['ulasan']); ?>
                                    <i class="fas fa-quote-right" style="color: var(--secondary-color); margin-left: 0.5rem;"></i>
                                </div>
                            <?php endif; ?>

                            <?php if ($this->session->userdata('user_id') == $ulasan['penyewa_id']): ?>
                                <a href="<?php echo base_url('penyewa/edit_ulasan/' . $ulasan['id']); ?>" class="btn btn-warning btn-sm mt-2">
                                    <i class="fas fa-edit"></i> Edit Ulasan
                                </a>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>

                <?php if ($bisa_ulas && !$ulasan_exist): ?>
                    <div class="text-center mt-3">
                        <a href="<?php echo base_url('penyewa/beri_ulasan/' . $kosan['id']); ?>" class="btn btn-primary">
                            <i class="fas fa-star"></i> Beri Ulasan dari Riwayat Sewa
                        </a>
                    </div>
                <?php elseif ($bisa_ulas && $ulasan_exist): ?>
                    <div class="alert alert-info mt-3">
                        <i class="fas fa-info-circle"></i>
                        Anda sudah memberikan ulasan untuk riwayat sewa kosan ini.
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Modal for Image Gallery -->
    <div class="modal fade" id="imageModal" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Foto Kosan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body text-center">
                    <img id="modalImage" src="" class="img-fluid" alt="Foto Kosan">
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        function openModal(imageSrc) {
            document.getElementById('modalImage').src = imageSrc;
            new bootstrap.Modal(document.getElementById('imageModal')).show();
        }
    </script>
</body>
</html>