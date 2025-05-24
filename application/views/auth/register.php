<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi - BapakKos</title>
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

        .register-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 1rem;
        }

        .register-card {
            background: white;
            border-radius: 15px;
            box-shadow: var(--shadow-lg);
            overflow: hidden;
            margin: 2rem 0;
        }

        .register-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-color-dark) 100%);
            color: white;
            padding: 2rem;
            text-align: center;
        }

        .register-header h1 {
            font-weight: 600;
            font-size: 1.8rem;
            margin-bottom: 0.5rem;
        }

        .register-header p {
            font-size: 1rem;
            opacity: 0.9;
        }

        .register-form {
            padding: 2rem;
        }

        .form-control, .form-select {
            border-radius: 8px;
            padding: 0.75rem 1rem;
            border: 1px solid var(--border-color);
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(128, 0, 0, 0.1);
        }

        .form-label {
            font-weight: 500;
            margin-bottom: 0.5rem;
            color: #374151;
        }

        .input-group-text {
            background: var(--light-gray);
            border: 1px solid var(--border-color);
            color: var(--primary-color);
        }

        .btn-register {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-color-dark) 100%);
            border: none;
            padding: 0.75rem;
            border-radius: 8px;
            font-weight: 500;
            box-shadow: var(--shadow);
            transition: all 0.3s ease;
            width: 100%;
            margin-top: 1rem;
        }

        .btn-register:hover {
            background: linear-gradient(135deg, var(--primary-color-dark) 0%, var(--primary-color) 100%);
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
        }

        .alert {
            border-radius: 8px;
            padding: 1rem;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .form-check-input:checked {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .custom-file-upload {
            border: 1px dashed var(--border-color);
            border-radius: 8px;
            padding: 1.5rem;
            text-align: center;
            transition: all 0.3s ease;
            cursor: pointer;
            background-color: var(--light-gray);
        }

        .custom-file-upload:hover {
            background-color: #f0f0f0;
            border-color: var(--primary-color);
        }

        .custom-file-upload i {
            font-size: 2rem;
            color: var(--primary-color);
            margin-bottom: 0.5rem;
        }

        .file-preview {
            max-width: 100px;
            max-height: 100px;
            margin: 0.5rem auto;
            display: none;
            border-radius: 8px;
        }

        .login-link {
            text-align: center;
            margin-top: 1.5rem;
            padding-top: 1.5rem;
            border-top: 1px solid var(--border-color);
        }

        .login-link a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
        }

        .login-link a:hover {
            color: var(--primary-color-dark);
            text-decoration: underline;
        }

        .password-field {
            position: relative;
        }

        .password-toggle {
            cursor: pointer;
            color: var(--secondary-color);
        }

        @media (max-width: 768px) {
            .register-container {
                padding: 0.5rem;
            }

            .register-header {
                padding: 1.5rem;
            }

            .register-form {
                padding: 1.5rem;
            }

            .register-header h1 {
                font-size: 1.5rem;
            }

            .register-header p {
                font-size: 0.9rem;
            }
        }
    </style>
</head>
<body>
    <div class="container register-container">
        <div class="register-card">
            <div class="register-header">
                <h1><i class="bi bi-person-plus-fill me-2"></i> Registrasi ke Horikos</h1>
                <p>Temukan atau sewakan kosan dengan mudah</p>
            </div>
            
            <div class="register-form">
                <!-- Alert Notifications -->
                <?php if ($this->session->flashdata('success')): ?>
                    <div class="alert alert-success">
                        <i class="bi bi-check-circle me-2"></i>
                        <?php echo htmlspecialchars($this->session->flashdata('success'), ENT_QUOTES, 'UTF-8'); ?>
                    </div>
                <?php endif; ?>
                
                <?php if ($this->session->flashdata('error') || validation_errors()): ?>
                    <div class="alert alert-danger">
                        <i class="bi bi-exclamation-circle me-2"></i>
                        <?php echo htmlspecialchars($this->session->flashdata('error') ?: validation_errors(), ENT_QUOTES, 'UTF-8'); ?>
                    </div>
                <?php endif; ?>
                
                <form method="post" action="<?php echo base_url('auth/register'); ?>" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="nama" class="form-label">Nama Lengkap</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan nama lengkap" required>
                                <span class="input-group-text"><i class="bi bi-person"></i></span>
                            </div>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="username" class="form-label">Username</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan username" required>
                                <span class="input-group-text"><i class="bi bi-at"></i></span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <div class="input-group">
                            <input type="email" class="form-control" id="email" name="email" placeholder="contoh@email.com" required>
                            <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="no_hp" class="form-label">No HP (Opsional)</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="no_hp" name="no_hp" placeholder="Contoh: 08123456789">
                            <span class="input-group-text"><i class="bi bi-telephone"></i></span>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3 password-field">
                            <label for="password" class="form-label">Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="password" name="password" placeholder="Minimal 8 karakter" required>
                                <span class="input-group-text password-toggle" onclick="togglePassword('password')">
                                    <i class="bi bi-eye-slash" id="password-icon"></i>
                                </span>
                            </div>
                        </div>
                        
                        <div class="col-md-6 mb-3 password-field">
                            <label for="konfirmasi_password" class="form-label">Konfirmasi Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="konfirmasi_password" name="konfirmasi_password" placeholder="Masukkan password kembali" required>
                                <span class="input-group-text password-toggle" onclick="togglePassword('konfirmasi_password')">
                                    <i class="bi bi-eye-slash" id="konfirmasi-password-icon"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <label for="role" class="form-label">Daftar Sebagai</label>
                        <select class="form-select" id="role" name="role" required>
                            <option value="" disabled selected>Pilih role</option>
                            <option value="pemilik">Pemilik Kosan</option>
                            <option value="penyewa">Pencari Kosan</option>
                        </select>
                    </div>
                    
                    <div class="mb-4">
                        <label for="foto_profil" class="form-label">Foto Profil (Opsional)</label>
                        <div class="custom-file-upload" id="file-upload-container" onclick="document.getElementById('foto_profil').click()">
                            <i class="bi bi-cloud-upload"></i>
                            <p class="mb-0">Klik untuk unggah foto profil</p>
                            <p class="text-muted small">Format: JPG, JPEG, atau PNG</p>
                            <img id="image-preview" class="file-preview" src="#" alt="Preview">
                        </div>
                        <input type="file" class="form-control d-none" id="foto_profil" name="foto_profil" accept="image/jpeg,image/png,image/jpg">
                    </div>
                    
                    <button type="submit" class="btn btn-register">
                        <i class="bi bi-person-plus me-2"></i> Daftar Sekarang
                    </button>
                    
                    <div class="login-link">
                        <p>Sudah punya akun? <a href="<?php echo base_url('auth/login'); ?>">Login di sini</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('foto_profil').addEventListener('change', function(e) {
            const preview = document.getElementById('image-preview');
            const file = e.target.files[0];
            
            if (file) {
                preview.src = URL.createObjectURL(file);
                preview.style.display = 'block';
            } else {
                preview.style.display = 'none';
            }
        });
        
        function togglePassword(inputId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(inputId === 'password' ? 'password-icon' : 'konfirmasi-password-icon');
            
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('bi-eye-slash');
                icon.classList.add('bi-eye');
            } else {
                input.type = 'password';
                icon.classList.remove('bi-eye');
                icon.classList.add('bi-eye-slash');
            }
        }
    </script>
</body>
</html>