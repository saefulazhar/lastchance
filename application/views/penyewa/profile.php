<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Penyewa</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f3f4f6;
        }
        .card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
        }
        .btn-primary {
            background-color: #a52a2a; /* Maroon cerah untuk tombol */
            transition: background-color 0.3s ease;
        }
        .btn-primary:hover {
            background-color: #8b2424; /* Maroon sedikit lebih gelap saat hover */
        }
        .alert {
            animation: slideIn 0.5s ease;
        }
        .alert-success {
            border-left-color: #a52a2a; /* Maroon cerah untuk border alert */
        }
        @keyframes slideIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .profile-img {
            width: 150px;
            height: 150px;
            object-fit: cover;
        }
    </style>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Profil Penyewa</h1>
        <?php if ($this->session->flashdata('success')): ?>
            <div class="alert alert-success bg-green-100 border-l-4 text-green-700 p-4 mb-6 rounded-lg">
                <?php echo htmlspecialchars($this->session->flashdata('success')); ?>
            </div>
        <?php endif; ?>
        <?php if ($this->session->flashdata('error')): ?>
            <div class="alert bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-lg">
                <?php echo htmlspecialchars($this->session->flashdata('error')); ?>
            </div>
        <?php endif; ?>
        <div class="card bg-white rounded-lg shadow-md">
            <div class="p-6">
                <div class="flex flex-col md:flex-row items-center md:items-start">
                    <div class="text-center md:w-1/4 mb-4 md:mb-0">
                        <?php if ($user['foto_profil'] && file_exists('./uploads/profile/' . $user['foto_profil'])): ?>
                            <img src="<?php echo base_url('uploads/profile/' . $user['foto_profil']); ?>" alt="Foto Profil" class="profile-img rounded-full mx-auto">
                        <?php else: ?>
                            <img src="<?php echo base_url('assets/images/default-profile.png'); ?>" alt="Foto Profil" class="profile-img rounded-full mx-auto">
                        <?php endif; ?>
                    </div>
                    <div class="md:w-3/4">
                        <h5 class="text-xl font-semibold text-gray-800 mb-3">Informasi Pengguna</h5>
                        <p class="text-gray-600 mb-2"><strong>Nama:</strong> <?php echo htmlspecialchars($user['nama'] ?? ''); ?></p>
                        <p class="text-gray-600 mb-2"><strong>Username:</strong> <?php echo htmlspecialchars($user['username'] ?? ''); ?></p>
                        <p class="text-gray-600 mb-2"><strong>Email:</strong> <?php echo htmlspecialchars($user['email'] ?? ''); ?></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-4">
            <a href="<?php echo base_url('penyewa/edit_profile'); ?>" class="btn-primary text-white font-medium py-2 px-4 rounded-lg">Edit Profil</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>