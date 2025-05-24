<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang BapakKos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #800000; /* Maroon utama */
            --primary-color-dark: #a52a2a; /* Maroon untuk hover */
            --secondary-color: #64748b;
            --light-gray: #f8fafc;
            --border-color: #e2e8f0;
            --shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; /* Konsisten dengan desain sebelumnya */
            background-color: #f4f6f9; /* Konsisten dengan desain sebelumnya */
            color: #1f2937;
            min-height: 100vh;
            padding: 2rem 0;
        }

        .about-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-color-dark) 100%);
            color: white;
            padding: 4rem 0;
            position: relative;
            border-radius: 0 0 15px 15px;
            box-shadow: var(--shadow);
            text-align: center;
        }

        .about-header .container {
            position: relative;
            z-index: 1;
        }

        .section-title {
            position: relative;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            color: var(--primary-color);
            font-weight: 700;
            font-size: 2rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .section-title::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            width: 60px;
            height: 3px;
            background-color: var(--primary-color);
        }

        .feature-card {
            background: white;
            border-radius: 15px;
            box-shadow: var(--shadow);
            border: 1px solid var(--border-color);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            height: 100%;
        }

        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-lg);
        }

        .feature-icon {
            font-size: 2.5rem;
            color: var(--primary-color);
            margin-bottom: 1rem;
        }

        .mission-box {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-color-dark) 100%);
            color: white;
            border-radius: 15px;
            padding: 2.5rem;
            box-shadow: var(--shadow);
            margin: 2rem 0;
        }

        .cta-section {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-color-dark) 100%);
            color: white;
            padding: 4rem 0;
            border-radius: 15px;
            margin: 4rem 0;
            text-align: center;
        }

        .btn-cta {
            background: white;
            color: var(--primary-color);
            border: none;
            border-radius: 8px;
            padding: 0.75rem 2rem;
            font-weight: 500;
            font-size: 1.1rem;
            transition: all 0.3s ease;
        }

        .btn-cta:hover {
            background: var(--light-gray);
            transform: translateY(-2px);
            box-shadow: var(--shadow);
        }

        .footer {
            background: linear-gradient(135deg, #1f2937 0%, #374151 100%); /* Konsisten dengan warna sekunder */
            color: white;
            padding: 1.5rem 0;
            text-align: center;
            font-size: 0.9rem;
        }

        .about-img {
            border-radius: 15px;
            box-shadow: var(--shadow);
            width: 100%;
            height: auto;
        }

        @media (max-width: 768px) {
            body {
                padding: 1rem 0;
            }

            .about-header {
                padding: 2.5rem 0;
            }

            .about-header h1 {
                font-size: 2rem;
            }

            .about-header p {
                font-size: 1rem;
            }

            .section-title {
                font-size: 1.5rem;
            }

            .feature-card {
                margin-bottom: 1.5rem;
            }

            .mission-box {
                padding: 1.5rem;
            }

            .cta-section {
                padding: 2.5rem 0;
            }
        }
    </style>
</head>
<body>
    <!-- Header Section -->
    <div class="about-header">
        <div class="container">
            <h1><i class="bi bi-house-heart-fill"></i> Tentang BapakKos</h1>
            <p class="lead">Platform pintar untuk menemukan kosan yang sesuai dengan kepribadian Anda</p>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container my-5">
        <!-- About Us Section -->
        <div class="row align-items-center mb-5">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <h2 class="section-title"><i class="bi bi-info-circle"></i> Siapa Kami</h2>
                <p class="fs-5 text-secondary">BapakKos adalah platform pencarian kosan yang membantu Anda menemukan tempat tinggal yang sesuai dengan kebutuhan dan kepribadian Anda. Kami menyediakan informasi lengkap tentang kosan, mulai dari harga, lokasi, tipe, hingga fasilitas yang tersedia.</p>
                <p class="fs-5 text-secondary">Dengan BapakKos, Anda dapat mencari kosan berdasarkan tipe (putra, putri, atau campur) dan kepribadian (introvert, ekstrovert, dan ambivert), sehingga Anda bisa menemukan lingkungan yang nyaman untuk tinggal.</p>
            </div>
            <div class="col-lg-6">
                <img src="<?php echo base_url('assets/img/about-team.jpg'); ?>" alt="BapakKos Team" class="about-img img-fluid">
            </div>
        </div>

        <!-- Our Features -->
        <div class="row mt-5 mb-5">
            <div class="col-12 text-center mb-4">
                <h2 class="section-title"><i class="bi bi-star-fill"></i> Mengapa Memilih BapakKos?</h2>
                <p class="lead text-secondary">Keunggulan kami dalam membantu Anda menemukan kosan ideal sesuai dengan kepribadian Anda</p>
            </div>
        </div>

        <div class="row g-4 mb-5">
            <!-- Feature 1 -->
            <div class="col-md-4">
                <div class="card feature-card p-4 text-center">
                    <div class="card-body">
                        <div class="feature-icon">
                            <i class="bi bi-search"></i>
                        </div>
                        <h3>Pencarian Lengkap</h3>
                        <p class="text-secondary">Temukan kosan dengan kriteria lengkap: lokasi, harga, tipe, dan fasilitas.</p>
                    </div>
                </div>
            </div>

            <!-- Feature 2 -->
            <div class="col-md-4">
                <div class="card feature-card p-4 text-center">
                    <div class="card-body">
                        <div class="feature-icon">
                            <i class="bi bi-people"></i>
                        </div>
                        <h3>Sesuai Kepribadian</h3>
                        <p class="text-secondary">Filter kosan berdasarkan tipe (putra, putri, campur) dan kepribadian (introvert, ekstrovert, dan ambivert).</p>
                    </div>
                </div>
            </div>

            <!-- Feature 3 -->
            <div class="col-md-4">
                <div class="card feature-card p-4 text-center">
                    <div class="card-body">
                        <div class="feature-icon">
                            <i class="bi bi-info-circle"></i>
                        </div>
                        <h3>Informasi Detail</h3>
                        <p class="text-secondary">Lihat informasi lengkap tentang fasilitas, peraturan, dan lingkungan sekitar kosan.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Our Mission -->
        <div class="row my-5">
            <div class="col-12">
                <div class="mission-box">
                    <div class="row align-items-center">
                        <div class="col-lg-8">
                        <h2 class="section-title"><i class="bi bi-rocket-takeoff"></i> Misi Kami</h2>
                            <p class="fs-5">Membantu setiap pencari kosan menemukan tempat tinggal yang tidak hanya sesuai dengan budget, tetapi juga cocok dengan kepribadian dan gaya hidup mereka, sehingga menciptakan lingkungan tinggal yang harmonis dan nyaman.</p>
                        </div>
                        <div class="col-lg-4 text-center">
                            <i class="bi bi-house-door-fill fa-5x opacity-75"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- CTA Section -->
        <div class="cta-section">
            <div class="container">
                <h2 class="mb-4">Siap Menemukan Kosan Impian?</h2>
                <p class="lead mb-4">Mulai pencarian sekarang dan temukan kosan yang sesuai dengan kepribadian Anda</p>
                <a href="<?php echo base_url('home'); ?>" class="btn btn-cta">Cari Kosan Sekarang</a>
            </div>
        </div>
    </div>

    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>