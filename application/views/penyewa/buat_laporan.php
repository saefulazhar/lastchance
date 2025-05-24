<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Laporan - BapakKos</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f3f4f6;
        }
        .form-control {
            border: 1px solid #e5e7eb;
            border-radius: 0.375rem;
            padding: 0.75rem;
            width: 100%;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }
        .form-control:focus {
            border-color: #a52a2a;
            box-shadow: 0 0 0 3px rgba(165, 42, 42, 0.1);
            outline: none;
        }
        label {
            font-weight: 500;
            color: #374151;
            margin-bottom: 0.5rem;
            display: block;
        }
        .btn-primary {
            background-color: #a52a2a; /* Maroon cerah untuk tombol */
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 0.375rem;
            font-weight: 500;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }
        .btn-primary:hover {
            background-color: #8b2424; /* Maroon sedikit lebih gelap */
            transform: translateY(-2px);
        }
        .alert {
            border-radius: 0.375rem;
            padding: 1rem;
            margin-bottom: 1.5rem;
            border-left: 4px solid;
            animation: slideIn 0.5s ease;
        }
        .alert-success {
            background-color: #dcfce7;
            color: #166534;
            border-color: #a52a2a; /* Maroon cerah untuk border */
        }
        .alert-danger {
            background-color: #fee2e2;
            color: #991b1b;
            border-color: #dc2626;
        }
        textarea.form-control {
            min-height: 120px;
            resize: vertical;
        }
        @keyframes slideIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body class="bg-gray-100">
    <div class="main-content">
        <div class="container mx-auto px-4 py-6 max-w-2xl">
            <h1 class="text-3xl font-bold text-gray-800 mb-6">Buat Laporan</h1>
            <?php if ($this->session->flashdata('success')): ?>
                <div class="alert alert-success">
                    <?php echo htmlspecialchars($this->session->flashdata('success')); ?>
                </div>
            <?php endif; ?>
            <?php if ($this->session->flashdata('error')): ?>
                <div class="alert alert-danger">
                    <?php echo htmlspecialchars($this->session->flashdata('error')); ?>
                </div>
            <?php endif; ?>
            <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>
            <?php echo form_open_multipart('penyewa/buat_laporan/' . ($selected_kosan_id ?: ''), ['class' => 'bg-white p-6 rounded-lg shadow-md']); ?>
                <?php if ($selected_kosan_id): ?>
                    <input type="hidden" name="kosan_id" value="<?php echo htmlspecialchars($selected_kosan_id); ?>">
                    <p class="text-gray-600 mb-4"><strong>Kosan yang Dilaporkan:</strong> <?php
                        $this->load->model('Kosan_model');
                        $kosan = $this->Kosan_model->get_kosan_by_id($selected_kosan_id);
                        echo htmlspecialchars($kosan['nama']);
                    ?></p>
                <?php endif; ?>
               
                <div class="mb-4">
                    <label for="judul" class="block">Judul Laporan</label>
                    <input type="text" class="form-control" id="judul" name="judul" value="<?php echo set_value('judul'); ?>" required>
                    <small class="text-red-500"><?php echo form_error('judul'); ?></small>
                </div>
                <div class="mb-4">
                    <label for="deskripsi" class="block">Deskripsi</label>
                    <textarea class="form-control" id="deskripsi" name="deskripsi" rows="5" required><?php echo set_value('deskripsi'); ?></textarea>
                    <small class="text-red-500"><?php echo form_error('deskripsi'); ?></small>
                </div>
                <div class="mb-4">
                    <label for="lampiran" class="block">Lampiran Gambar (Opsional)</label>
                    <input type="file" class="form-control" id="lampiran" name="lampiran" accept="image/*">
                </div>
                <button type="submit" class="btn-primary">Kirim Laporan</button>
            <?php echo form_close(); ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>