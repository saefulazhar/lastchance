<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f6f9;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .container {
            max-width: 1200px;
            margin-top: 2rem;
            padding: 2rem;
            background: #ffffff;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #800000; /* Maroon untuk judul */
            font-weight: 600;
            margin-bottom: 1.5rem;
            text-align: center;
        }
        .table {
            border-radius: 10px;
            overflow: hidden;
        }
        .table thead {
            background: linear-gradient(45deg, #800000, #a52a2a); /* Gradien maroon */
            color: #ffffff;
        }
        .table th, .table td {
            vertical-align: middle;
            padding: 1rem;
        }
        .table tbody tr {
            transition: background-color 0.3s ease;
        }
        .table tbody tr:hover {
            background-color: #f5e6e6; /* Warna hover dengan sentuhan maroon */
        }
        .btn-sm {
            padding: 0.5rem 1rem;
            font-size: 0.875rem;
            border-radius: 8px;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .btn-sm:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }
        .btn-danger {
            background-color: #800000; /* Maroon untuk tombol Hapus */
            border-color: #800000;
        }
        .btn-warning {
            background-color: #a52a2a; /* Maroon lebih terang untuk tombol Edit */
            border-color: #a52a2a;
            color: #ffffff;
        }
        .alert-success {
            background-color: #d1fae5;
            color: #065f46;
            border: none;
            border-radius: 8px;
            padding: 1rem;
            margin-bottom: 1.5rem;
        }
        .no-data {
            text-align: center;
            color: #6b7280;
            font-style: italic;
            padding: 2rem;
        }
        .icon {
            margin-right: 0.5rem;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <h2>Manajemen Pengguna</h2>

    <?php if ($this->session->flashdata('success')): ?>
        <div class="alert alert-success">
            <i class="bi bi-check-circle-fill icon"></i>
            <?php echo $this->session->flashdata('success'); ?>
        </div>
    <?php endif; ?>

    <?php if (!empty($users) && is_array($users)): ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Role</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($user['username'], ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><?php echo htmlspecialchars($user['role'], ENT_QUOTES, 'UTF-8'); ?></td>
                        <td>
                            <a href="<?php echo base_url('admin/edit_user/' . $user['id']); ?>" 
                               class="btn btn-warning btn-sm" 
                               onclick="return confirm('Yakin ingin mengedit pengguna ini?');">
                                <i class="bi bi-pencil-square icon"></i>Edit
                            </a>
                            <a href="<?php echo base_url('admin/delete_user/' . $user['id']); ?>" 
                               class="btn btn-danger btn-sm" 
                               onclick="return confirm('Yakin ingin menghapus pengguna ini?');">
                                <i class="bi bi-trash-fill icon"></i>Hapus
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p class="no-data">Belum ada pengguna di sistem.</p>
    <?php endif; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.js"></script>
</body>
</html>