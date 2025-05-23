<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi - BapakKos</title>
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
        .register-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 30px;
        }
        .register-card {
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            overflow: hidden;
            background-color: white;
            margin-top: 20px;
            margin-bottom: 50px;
        }
        .register-header {
            background: linear-gradient(135deg, #0066cc 0%, #004999 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }
        .register-form {
            padding: 30px;
        }
        .form-control {
            border-radius: 8px;
            padding: 12px 15px;
            border: 1px solid #ced4da;
            font-size: 1rem;
        }
        .form-control:focus {
            box-shadow: 0 0 0 0.25rem rgba(0, 102, 204, 0.25);
            border-color: #0066cc;
        }
        .form-label {
            font-weight: 500;
            margin-bottom: 8px;
            color: #444;
        }
        .btn-register {
            background: linear-gradient(135deg, #0066cc 0%, #004999 100%);
            border: none;
            padding: 12px 30px;
            border-radius: 8px;
            font-weight: 600;
            letter-spacing: 0.5px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }
        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(0,0,0,0.15);
            background: linear-gradient(135deg, #005bb8 0%, #003d80 100%);
        }
        .register-divider {
            display: flex;
            align-items: center;
            margin: 25px 0;
        }
        .register-divider::before,
        .register-divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background-color: #e0e0e0;
        }
        .register-divider span {
            padding: 0 15px;
            color: #777;
            font-size: 0.9rem;
        }
        .form-check-input:checked {
            background-color: #0066cc;
            border-color: #0066cc;
        }
        .alert {
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 20px;
        }
        .custom-file-upload {
            position: relative;
            overflow: hidden;
            border: 1px dashed #ced4da;
            border-radius: 8px;
            padding: 20px;
            text-align: center;
            transition: all 0.3s ease;
            cursor: pointer;
            background-color: #f8f9fa;
        }
        .custom-file-upload:hover {
            background-color: #f0f0f0;
            border-color: #0066cc;
        }
        .custom-file-upload i {
            font-size: 2rem;
            color: #0066cc;
            margin-bottom: 10px;
        }
        .file-preview {
            max-width: 100px;
            max-height: 100px;
            margin: 10px auto;
            display: none;
        }
        .role-selection .btn {
            border-radius: 8px;
            padding: 10px 15px;
            margin-right: 10px;
            background-color: #fff;
            color: #444;
            border: 1px solid #ced4da;
            transition: all 0.3s ease;
        }
        .role-selection .btn.active {
            background-color: #0066cc;
            color: white;
            border-color: #0066cc;
        }
        .login-link {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #eee;
        }
        .login-link a {
            color: #0066cc;
            text-decoration: none;
            font-weight: 500;
        }
        .login-link a:hover {
            text-decoration: underline;
        }
        .form-icon {
            position: absolute;
            top: 50%;
            right: 15px;
            transform: translateY(-50%);
            color: #aaa;
        }
        .form-floating {
            position: relative;
        }
    </style>
</head>
<body>
    <div class="container register-container">
        <div class="register-card">
            <div class="register-header">
                <h1 class="mb-0">Registrasi ke BapakKos</h1>
                <p class="mt-2 mb-0">Temukan atau sewakan kosan dengan mudah</p>
            </div>
            
            <div class="register-form">
                <!-- Alert Notifications -->
                <?php if ($this->session->flashdata('success')): ?>
                    <div class="alert alert-success"><?php echo $this->session->flashdata('success'); ?></div>
                <?php endif; ?>
                
                <?php if ($this->session->flashdata('error') || validation_errors()): ?>
                    <div class="alert alert-danger"><?php echo $this->session->flashdata('error') ?: validation_errors(); ?></div>
                <?php endif; ?>
                
                <form method="post" action="<?php echo base_url('auth/register'); ?>" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="nama" class="form-label">Nama Lengkap</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan nama lengkap" required>
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="username" class="form-label">Username</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan username" required>
                                <span class="input-group-text"><i class="fas fa-at"></i></span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <div class="input-group">
                            <input type="email" class="form-control" id="email" name="email" placeholder="contoh@email.com" required>
                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="no_hp" class="form-label">No HP (Opsional)</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="no_hp" name="no_hp" placeholder="Contoh: 08123456789">
                            <span class="input-group-text"><i class="fas fa-phone"></i></span>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="password" class="form-label">Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="password" name="password" placeholder="Minimal 8 karakter" required>
                                <span class="input-group-text password-toggle" style="cursor: pointer;" onclick="togglePassword('password')">
                                    <i class="fas fa-eye-slash" id="password-icon"></i>
                                </span>
                            </div>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="konfirmasi_password" class="form-label">Konfirmasi Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="konfirmasi_password" name="konfirmasi_password" placeholder="Masukkan password kembali" required>
                                <span class="input-group-text password-toggle" style="cursor: pointer;" onclick="togglePassword('konfirmasi_password')">
                                    <i class="fas fa-eye-slash" id="konfirmasi-password-icon"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <label class="form-label">Daftar Sebagai</label>
                        <div class="role-selection">
                            <select class="form-select" id="role" name="role" required>
                                <option value="" disabled selected>Pilih role</option>
                                <option value="pemilik">Pemilik Kosan</option>
                                <option value="penyewa">Pencari Kosan</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <label for="foto_profil" class="form-label">Foto Profil (Opsional)</label>
                        <div class="custom-file-upload" id="file-upload-container" onclick="document.getElementById('foto_profil').click()">
                            <i class="fas fa-cloud-upload-alt"></i>
                            <p class="mb-0">Klik untuk unggah foto profil</p>
                            <p class="text-muted small">Format: JPG, JPEG, atau PNG</p>
                            <img id="image-preview" class="file-preview" src="#" alt="Preview">
                        </div>
                        <input type="file" class="form-control d-none" id="foto_profil" name="foto_profil" accept="image/jpeg,image/png,image/jpg">
                    </div>
                    
                    <button type="submit" class="btn btn-primary btn-register w-100">Daftar Sekarang</button>
                    
                    <div class="login-link">
                        <p>Sudah punya akun? <a href="<?php echo base_url('auth/login'); ?>">Login di sini</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        // Show preview image when file is selected
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
        
        // Toggle password visibility
        function togglePassword(inputId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(inputId === 'password' ? 'password-icon' : 'konfirmasi-password-icon');
            
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            }
        }
    </script>
</body>
</html>