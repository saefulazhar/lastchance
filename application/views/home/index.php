<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kosan Finder</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #800000; /* Maroon utama */
            --primary-color-dark: #a52a2a; /* Maroon untuk hover */
            --secondary-color: #64748b;
            --success-color: #22c55e;
            --warning-color: #f59e0b;
            --danger-color: #ef4444;
            --light-gray: #f8fafc;
            --border-color: #e2e8f0;
            --shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }

        body {
            background: #f4f6f9; /* Konsisten dengan desain sebelumnya */
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            padding: 2rem 0;
        }

        .main-container {
            background: white;
            border-radius: 15px;
            box-shadow: var(--shadow-lg);
            overflow: hidden;
            margin: 0 auto;
            max-width: 1400px;
        }

        .header-section {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-color-dark) 100%);
            color: white;
            padding: 2rem;
            text-align: center;
        }

        .header-section h1 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .header-section p {
            font-size: 1.1rem;
            opacity: 0.9;
            margin: 0;
        }

        .content-section {
            padding: 2rem;
        }

        .search-card {
            background: var(--light-gray);
            border-radius: 15px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            border: 1px solid var(--border-color);
        }

        .search-card h4 {
            color: var(--primary-color);
            font-weight: 600;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .form-control, .btn {
            border-radius: 8px;
            border: 1px solid var(--border-color);
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(128, 0, 0, 0.1);
        }

        .btn {
            font-weight: 500;
            padding: 0.75rem 1.5rem;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-color-dark) 100%);
            border: none;
            box-shadow: var(--shadow);
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, var(--primary-color-dark) 0%, var(--primary-color) 100%);
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
        }

        .btn-success {
            background: linear-gradient(135deg, var(--success-color) 0%, #16a34a 100%);
            border: none;
        }

        .btn-success:hover {
            background: linear-gradient(135deg, #16a34a 0%, #15803d 100%);
            transform: translateY(-2px);
            box-shadow: var(--shadow);
        }

        .btn-warning {
            background: linear-gradient(135deg, var(--warning-color) 0%, #d97706 100%);
            border: none;
        }

        .btn-warning:hover {
            background: linear-gradient(135deg, #d97706 0%, #b45309 100%);
            transform: translateY(-2px);
            box-shadow: var(--shadow);
        }

        .filter-section {
            background: white;
            border-radius: 15px;
            padding: 1.5rem;
            box-shadow: var(--shadow);
            border: 1px solid var(--border-color);
        }

        .filter-group {
            margin-bottom: 1.5rem;
        }

        .filter-group:last-child {
            margin-bottom: 0;
        }

        .filter-group label.form-label {
            font-weight: 600;
            color: var(--primary-color);
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .form-check {
            padding: 0.5rem;
            border-radius: 8px;
            transition: background-color 0.2s ease;
        }

        .form-check:hover {
            background-color: rgba(128, 0, 0, 0.05);
        }

        .form-check-input:checked {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .kosan-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 2rem;
            margin-top: 2rem;
        }

        .kosan-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: var(--shadow);
            border: 1px solid var(--border-color);
            transition: all 0.3s ease;
        }

        .kosan-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-lg);
        }

        .kosan-image {
            height: 220px;
            overflow: hidden;
            position: relative;
        }

        .kosan-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .kosan-card:hover .kosan-image img {
            transform: scale(1.05);
        }

        .price-badge {
            position: absolute;
            top: 1rem;
            right: 1rem;
            background: linear-gradient(135deg, var(--success-color) 0%, #16a34a 100%);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 25px;
            font-weight: 600;
            font-size: 0.9rem;
            box-shadow: var(--shadow);
        }

        .type-badge {
            position: absolute;
            top: 1rem;
            left: 1rem;
            background: rgba(255, 255, 255, 0.9);
            color: var(--primary-color);
            padding: 0.25rem 0.75rem;
            border-radius: 15px;
            font-weight: 600;
            font-size: 0.8rem;
            text-transform: uppercase;
        }

        .kosan-content {
            padding: 1.5rem;
        }

        .kosan-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 1rem;
            line-height: 1.3;
        }

        .kosan-info {
            margin-bottom: 1.5rem;
        }

        .info-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 0.5rem;
            color: var(--secondary-color);
            font-size: 0.9rem;
        }

        .info-item i {
            width: 16px;
            color: var(--primary-color);
        }

        .personality-tag {
            display: inline-block;
            background: rgba(128, 0, 0, 0.1);
            color: var(--primary-color);
            padding: 0.25rem 0.75rem;
            border-radius: 15px;
            font-size: 0.8rem;
            font-weight: 500;
            margin-top: 0.5rem;
        }

        .kosan-actions {
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
        }

        .kosan-actions .btn {
            flex: 1;
            min-width: 100px;
            font-size: 0.9rem;
            padding: 0.5rem 1rem;
        }

        .no-results {
            text-align: center;
            padding: 4rem 2rem;
            color: var(--secondary-color);
        }

        .no-results i {
            font-size: 4rem;
            color: var(--border-color);
            margin-bottom: 1rem;
        }

        .no-results h3 {
            color: var(--secondary-color);
            margin-bottom: 0.5rem;
        }

        .results-header {
            background: var(--light-gray);
            padding: 1rem 1.5rem;
            border-radius: 10px;
            margin-bottom: 2rem;
            border-left: 4px solid var(--primary-color);
        }

        .results-header h2 {
            color: var(--primary-color);
            font-weight: 600;
            margin: 0;
            font-size: 1.5rem;
        }

        @media (max-width: 768px) {
            body {
                padding: 1rem 0;
            }

            .main-container {
                margin: 0 1rem;
                border-radius: 15px;
            }

            .header-section {
                padding: 1.5rem;
            }

            .header-section h1 {
                font-size: 2rem;
            }

            .content-section {
                padding: 1.5rem;
            }

            .kosan-grid {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }

            .kosan-actions {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <div class="main-container">
        <div class="header-section">
            <h1><i class="fas fa-home"></i> Kosan Finder</h1>
            <p>Temukan kosan impian Anda dengan mudah</p>
        </div>

        <div class="content-section">
            <!-- Form Pencarian -->
            <div class="search-card">
                <h4><i class="fas fa-search"></i> Pencarian Kosan</h4>
                <form action="<?php echo base_url('home/search'); ?>" method="get">
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                        <input type="text" name="kecamatan" class="form-control" 
                               placeholder="Cari berdasarkan kecamatan, alamat, atau desa..." 
                               value="<?php echo isset($kecamatan_searched) ? htmlspecialchars($kecamatan_searched) : ''; ?>" required>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-search"></i> Cari
                        </button>
                    </div>
                </form>
            </div>

            <!-- Form Filter -->
            <div class="search-card">
                <h4><i class="fas fa-filter"></i> Filter Kosan</h4>
                <form action="<?php echo base_url('home/filter'); ?>" method="get">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="filter-section">
                                <div class="filter-group">
                                    <label class="form-label">
                                        <i class="fas fa-money-bill-wave"></i> Harga
                                    </label>
                                    <div class="form-check">
                                        <input type="checkbox" name="harga[]" value="1-1000000" class="form-check-input" id="harga1">
                                        <label class="form-check-label" for="harga1">0 - 1 Juta</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" name="harga[]" value="1000001-2000000" class="form-check-input" id="harga2">
                                        <label class="form-check-label" for="harga2"> 1 Juta - 2 Juta</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" name="harga[]" value="2000001-999999999" class="form-check-input" id="harga3">
                                        <label class="form-check-label" for="harga3">> 2 Juta</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="filter-section">
                                <div class="filter-group">
                                    <label class="form-label">
                                        <i class="fas fa-users"></i> Tipe Kosan
                                    </label>
                                    <div class="form-check">
                                        <input type="checkbox" name="tipe[]" value="putra" class="form-check-input" id="tipe1">
                                        <label class="form-check-label" for="tipe1">Putra</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" name="tipe[]" value="putri" class="form-check-input" id="tipe2">
                                        <label class="form-check-label" for="tipe2">Putri</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" name="tipe[]" value="campur" class="form-check-input" id="tipe3">
                                        <label class="form-check-label" for="tipe3">Campur</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="filter-section">
                                <div class="filter-group">
                                    <label class="form-label">
                                        <i class="fas fa-user-friends"></i> Kepribadian
                                    </label>
                                    <div class="form-check">
                                        <input type="checkbox" name="kepribadian[]" value="introvert" class="form-check-input" id="kepribadian1">
                                        <label class="form-check-label" for="kepribadian1">Introvert</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" name="kepribadian[]" value="extrovert" class="form-check-input" id="kepribadian2">
                                        <label class="form-check-label" for="kepribadian2">Extrovert</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" name="kepribadian[]" value="ambivert" class="form-check-input" id="kepribadian3">
                                        <label class="form-check-label" for="kepribadian3">Ambivert</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center mt-3">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="fas fa-filter"></i> Terapkan Filter
                        </button>
                    </div>
                </form>
            </div>

            <!-- Hasil -->
            <div class="results-header">
                <h2><?php echo isset($kecamatan_searched) ? 'Hasil Pencarian/Filter untuk "' . htmlspecialchars($kecamatan_searched) . '"' : 'Semua Kosan Tersedia'; ?></h2>
            </div>

            <?php if (!empty($kosan_list)): ?>
                <div class="kosan-grid">
                    <?php foreach ($kosan_list as $kosan): ?>
                        <div class="kosan-card">
                            <div class="kosan-image">
                                <img src="<?php echo base_url($kosan['foto'] ? 'uploads/kosan/' . $kosan['foto'] : 'assets/img/no-image.jpg'); ?>" 
                                     alt="<?php echo htmlspecialchars($kosan['nama']); ?>">
                                <div class="price-badge">
                                    Rp <?php echo number_format($kosan['harga'], 0, ',', '.'); ?>/bln
                                </div>
                                <div class="type-badge">
                                    <?php echo htmlspecialchars(ucfirst($kosan['tipe'])); ?>
                                </div>
                            </div>
                            <div class="kosan-content">
                                <h5 class="kosan-title"><?php echo htmlspecialchars($kosan['nama']); ?></h5>
                                
                                <div class="kosan-info">
                                    <div class="info-item">
                                        <i class="fas fa-map-marker-alt"></i>
                                        <span><?php echo htmlspecialchars($kosan['alamat']); ?>, <?php echo htmlspecialchars($kosan['desa']); ?>, <?php echo htmlspecialchars($kosan['kecamatan']); ?></span>
                                    </div>
                                    <div class="personality-tag">
                                        <i class="fas fa-user"></i> <?php echo htmlspecialchars(ucfirst($kosan['kepribadian'])); ?>
                                    </div>
                                </div>

                                <div class="kosan-actions">
                                    <a href="<?php echo base_url('home/detail/' . $kosan['id']); ?>" class="btn btn-primary">
                                        <i class="fas fa-eye"></i> Detail
                                    </a>
                                    <?php if (isset($is_logged_in) && $is_logged_in): ?>
                                        <a href="<?php echo base_url('penyewa/sewa/' . $kosan['id']); ?>" class="btn btn-success">
                                            <i class="fas fa-key"></i> Sewa
                                        </a>
                                        <a href="<?php echo base_url('penyewa/buat_laporan/' . $kosan['id']); ?>" class="btn btn-warning btn-sm">
                                            <i class="fas fa-exclamation-triangle"></i> Lapor
                                        </a>
                                    <?php else: ?>
                                        <a href="<?php echo base_url('auth/login'); ?>" class="btn btn-success">
                                            <i class="fas fa-sign-in-alt"></i> Login untuk Sewa
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="no-results">
                    <i class="fas fa-search"></i>
                    <h3>Tidak Ada Kosan Ditemukan</h3>
                    <p>Maaf, tidak ada kosan yang sesuai dengan kriteria pencarian Anda.</p>
                    <p>Silakan coba dengan kata kunci atau filter yang berbeda.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>