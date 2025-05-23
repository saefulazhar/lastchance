<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang BapakKos</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome untuk ikon -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
            color: #333;
        }
        .about-header {
            background-color: #0066cc;
            color: white;
            padding: 60px 0;
            position: relative;
            overflow: hidden;
        }
        .about-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('/api/placeholder/1200/400') center/cover no-repeat;
            opacity: 0.15;
            z-index: 0;
        }
        .about-header .container {
            position: relative;
            z-index: 1;
        }
        .section-title {
            position: relative;
            margin-bottom: 30px;
            padding-bottom: 15px;
        }
        .section-title::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            width: 60px;
            height: 3px;
            background-color: #0066cc;
        }
        .feature-card {
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            transition: all 0.3s ease;
            border: none;
            height: 100%;
        }
        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        }
        .feature-icon {
            font-size: 2.5rem;
            color: #0066cc;
            margin-bottom: 15px;
        }
        .mission-box {
            background: linear-gradient(135deg, #0066cc 0%, #004999 100%);
            color: white;
            border-radius: 10px;
            padding: 40px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        .stats-card {
            text-align: center;
            padding: 30px 20px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        }
        .stats-number {
            font-size: 2.5rem;
            font-weight: 700;
            color: #0066cc;
            margin-bottom: 10px;
        }
        .testimonial-card {
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        }
        .testimonial-img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid white;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
        }
        .cta-section {
            background: linear-gradient(135deg, #0066cc 0%, #004999 100%);
            color: white;
            padding: 60px 0;
            border-radius: 10px;
            margin: 60px 0;
        }
        .footer {
            background-color: #343a40;
            color: white;
            padding: 20px 0;
            text-align: center;
        }
    </style>
</head>
<body>
    <!-- Header Section -->
    <div class="about-header text-center">
        <div class="container">
            <h1 class="display-4 fw-bold">Tentang BapakKos</h1>
            <p class="lead">Platform pintar untuk menemukan kosan yang sesuai dengan kepribadian Anda</p>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container my-5">
        <!-- About Us Section -->
        <div class="row align-items-center mb-5">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <h2 class="section-title">Siapa Kami</h2>
                <p class="fs-5">BapakKos adalah platform pencarian kosan yang membantu Anda menemukan tempat tinggal yang sesuai dengan kebutuhan dan kepribadian Anda. Kami menyediakan informasi lengkap tentang kosan, mulai dari harga, lokasi, tipe, hingga fasilitas yang tersedia.</p>
                <p class="fs-5">Dengan BapakKos, Anda dapat mencari kosan berdasarkan tipe (putra, putri, atau campur) dan kepribadian (introvert atau ekstrovert), sehingga Anda bisa menemukan lingkungan yang nyaman untuk tinggal.</p>
            </div>
            <div class="col-lg-6">
                <img src="/api/placeholder/600/400" alt="BapakKos Team" class="img-fluid rounded shadow">
            </div>
        </div>
        
        <!-- Our Features -->
        <div class="row mt-5 mb-5">
            <div class="col-12 text-center mb-4">
                <h2>Mengapa Memilih BapakKos?</h2>
                <p class="lead">Keunggulan kami dalam membantu Anda menemukan kosan ideal</p>
            </div>
        </div>
        
        <div class="row g-4 mb-5">
            <!-- Feature 1 -->
            <div class="col-md-4">
                <div class="card feature-card p-4 text-center">
                    <div class="card-body">
                        <div class="feature-icon">
                            <i class="fas fa-search"></i>
                        </div>
                        <h3>Pencarian Lengkap</h3>
                        <p>Temukan kosan dengan kriteria lengkap: lokasi, harga, tipe, dan fasilitas.</p>
                    </div>
                </div>
            </div>
            
            <!-- Feature 2 -->
            <div class="col-md-4">
                <div class="card feature-card p-4 text-center">
                    <div class="card-body">
                        <div class="feature-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <h3>Sesuai Kepribadian</h3>
                        <p>Filter kosan berdasarkan tipe (putra, putri, campur) dan kepribadian (introvert, ekstrovert).</p>
                    </div>
                </div>
            </div>
            
            <!-- Feature 3 -->
            <div class="col-md-4">
                <div class="card feature-card p-4 text-center">
                    <div class="card-body">
                        <div class="feature-icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <h3>Informasi Detail</h3>
                        <p>Lihat informasi lengkap tentang fasilitas, peraturan, dan lingkungan sekitar kosan.</p>
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
                            <h2 class="mb-4">Misi Kami</h2>
                            <p class="fs-5">Membantu setiap pencari kosan menemukan tempat tinggal yang tidak hanya sesuai dengan budget, tetapi juga cocok dengan kepribadian dan gaya hidup mereka, sehingga menciptakan lingkungan tinggal yang harmonis dan nyaman.</p>
                        </div>
                        <div class="col-lg-4 text-center">
                            <i class="fas fa-home fa-5x opacity-75"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Stats -->
        <div class="row mt-5 g-4">
            <div class="col-md-4">
                <div class="stats-card">
                    <div class="stats-number">1000+</div>
                    <p class="fs-5">Kosan Terdaftar</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stats-card">
                    <div class="stats-number">10.000+</div>
                    <p class="fs-5">Pengguna Aktif</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stats-card">
                    <div class="stats-number">15+</div>
                    <p class="fs-5">Kota di Indonesia</p>
                </div>
            </div>
        </div>
        
        <!-- CTA Section -->
        <div class="cta-section text-center">
            <div class="container">
                <h2 class="mb-4">Siap Menemukan Kosan Impian?</h2>
                <p class="lead mb-4">Mulai pencarian sekarang dan temukan kosan yang sesuai dengan kepribadian Anda</p>
                <a href="#" class="btn btn-light btn-lg px-4">Cari Kosan Sekarang</a>
            </div>
        </div>
    </div>
    
    
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>