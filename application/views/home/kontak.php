<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontak Kami - BapakKos</title>
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
        .contact-header {
            background-color: #0066cc;
            color: white;
            padding: 40px 0;
            border-radius: 0 0 15px 15px;
            margin-bottom: 30px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        .contact-card {
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            transition: transform 0.3s ease;
            border: none;
            height: 100%;
        }
        .contact-card:hover {
            transform: translateY(-5px);
        }
        .card-icon {
            font-size: 2.5rem;
            color: #0066cc;
            margin-bottom: 15px;
        }
        .contact-info {
            color: #555;
            font-size: 1.1rem;
        }
        .footer {
            margin-top: 60px;
            background-color: #343a40;
            color: white;
            padding: 20px 0;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="contact-header text-center">
        <div class="container">
            <h1 class="display-4">Kontak Kami</h1>
            <p class="lead">Kami siap membantu Anda menemukan kosan terbaik</p>
        </div>
    </div>

    <div class="container my-5">
        <div class="row mb-4">
            <div class="col-lg-6 offset-lg-3">
                <p class="text-center fs-5">Jika Anda memiliki pertanyaan atau membutuhkan bantuan, silakan hubungi tim kami melalui salah satu kontak di bawah ini:</p>
            </div>
        </div>
        
        <div class="row g-4">
            <!-- Email -->
            <div class="col-md-4">
                <div class="card contact-card p-4 text-center">
                    <div class="card-body">
                        <div class="card-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <h3 class="card-title">Email</h3>
                        <p class="contact-info">support@bapakkos.com</p>
                        <a href="mailto:support@bapakkos.com" class="btn btn-outline-primary mt-3">Kirim Email</a>
                    </div>
                </div>
            </div>
            
            <!-- Telepon -->
            <div class="col-md-4">
                <div class="card contact-card p-4 text-center">
                    <div class="card-body">
                        <div class="card-icon">
                            <i class="fas fa-phone-alt"></i>
                        </div>
                        <h3 class="card-title">Telepon</h3>
                        <p class="contact-info">+62 123-456-7890</p>
                        <a href="tel:+62123-456-7890" class="btn btn-outline-primary mt-3">Hubungi Kami</a>
                    </div>
                </div>
            </div>
            
            <!-- Alamat -->
            <div class="col-md-4">
                <div class="card contact-card p-4 text-center">
                    <div class="card-body">
                        <div class="card-icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <h3 class="card-title">Alamat</h3>
                        <p class="contact-info">Jl. Raya Kosan No. 123, Jakarta</p>
                        <a href="https://maps.google.com/?q=Jl. Raya Kosan No. 123, Jakarta" target="_blank" class="btn btn-outline-primary mt-3">Lihat Peta</a>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row mt-5">
            <div class="col-lg-8 offset-lg-2">
                <div class="card contact-card p-4">
                    <div class="card-body">
                        <h3 class="card-title text-center mb-4">Kirim Pesan</h3>
                        <form>
                            <div class="row mb-3">
                                <div class="col-md-6 mb-3 mb-md-0">
                                    <input type="text" class="form-control" placeholder="Nama Lengkap" required>
                                </div>
                                <div class="col-md-6">
                                    <input type="email" class="form-control" placeholder="Email" required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <input type="text" class="form-control" placeholder="Subjek" required>
                            </div>
                            <div class="mb-3">
                                <textarea class="form-control" rows="5" placeholder="Pesan Anda" required></textarea>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary px-4 py-2">Kirim Pesan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>