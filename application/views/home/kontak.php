<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontak Kami - BapakKos</title>
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

        .contact-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-color-dark) 100%);
            color: white;
            padding: 3rem 0;
            border-radius: 0 0 15px 15px;
            margin-bottom: 2rem;
            box-shadow: var(--shadow);
            text-align: center;
        }

        .contact-header h1 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .contact-header p {
            font-size: 1.2rem;
            opacity: 0.9;
        }

        .contact-card {
            background: white;
            border-radius: 15px;
            box-shadow: var(--shadow);
            border: 1px solid var(--border-color);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            height: 100%;
        }

        .contact-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-lg);
        }

        .card-icon {
            font-size: 2.5rem;
            color: var(--primary-color);
            margin-bottom: 1rem;
        }

        .contact-info {
            color: #374151; /* Konsisten dengan teks sekunder */
            font-size: 1.1rem;
            margin-bottom: 1.5rem;
        }

        .btn-contact {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-color-dark) 100%);
            color: white;
            border: none;
            border-radius: 8px;
            padding: 0.75rem 1.5rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-contact:hover {
            background: linear-gradient(135deg, var(--primary-color-dark) 0%, var(--primary-color) 100%);
            transform: translateY(-2px);
            box-shadow: var(--shadow);
        }

        .footer {
            margin-top: 4rem;
            background: linear-gradient(135deg, #1f2937 0%, #374151 100%); /* Konsisten dengan warna sekunder */
            color: white;
            padding: 1.5rem 0;
            text-align: center;
            font-size: 0.9rem;
        }

        @media (max-width: 768px) {
            body {
                padding: 1rem 0;
            }

            .contact-header {
                padding: 2rem 0;
            }

            .contact-header h1 {
                font-size: 2rem;
            }

            .contact-header p {
                font-size: 1rem;
            }

            .contact-card {
                margin-bottom: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="contact-header">
        <div class="container">
            <h1><i class="bi bi-headset"></i> Kontak Kami</h1>
            <p>Kami siap membantu Anda menemukan kosan terbaik</p>
        </div>
    </div>

    <div class="container my-5">
        <div class="row mb-4">
            <div class="col-lg-6 offset-lg-3">
                <p class="text-center fs-5 text-secondary">
                    Jika Anda memiliki pertanyaan atau membutuhkan bantuan, silakan hubungi tim kami melalui salah satu kontak di bawah ini:
                </p>
            </div>
        </div>
        
        <div class="row g-4">
            <!-- Email -->
            <div class="col-md-4">
                <div class="card contact-card p-4 text-center">
                    <div class="card-body">
                        <div class="card-icon">
                            <i class="bi bi-envelope-fill"></i>
                        </div>
                        <h3 class="card-title">Email</h3>
                        <p class="contact-info">support@bapakkos.com</p>
                        <a href="mailto:support@bapakkos.com" class="btn btn-contact">Kirim Email</a>
                    </div>
                </div>
            </div>
            
            <!-- Telepon -->
            <div class="col-md-4">
                <div class="card contact-card p-4 text-center">
                    <div class="card-body">
                        <div class="card-icon">
                            <i class="bi bi-telephone-fill"></i>
                        </div>
                        <h3 class="card-title">Telepon</h3>
                        <p class="contact-info">+62 123-456-7890</p>
                        <a href="tel:+62123-456-7890" class="btn btn-contact">Hubungi Kami</a>
                    </div>
                </div>
            </div>
            
            <!-- Alamat -->
            <div class="col-md-4">
                <div class="card contact-card p-4 text-center">
                    <div class="card-body">
                        <div class="card-icon">
                            <i class="bi bi-geo-alt-fill"></i>
                        </div>
                        <h3 class="card-title">Alamat</h3>
                        <p class="contact-info">Jl. Raya Kosan No. 123, Jakarta</p>
                        <a href="https://maps.google.com/?q=Jl. Raya Kosan No. 123, Jakarta" target="_blank" class="btn btn-contact">Lihat Peta</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>