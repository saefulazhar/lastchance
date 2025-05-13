<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="container mt-5">
    <h2>Manajemen Pengguna</h2>

    <?php if ($this->session->flashdata('success')): ?>
        <div class="alert alert-success"><?php echo $this->session->flashdata('success'); ?></div>
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
                        <td><?php echo $user['username']; ?></td>
                        <td><?php echo $user['role']; ?></td>
                        <td>
                            <a href="<?php echo base_url('admin/delete_user/' . $user['id']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus pengguna ini?');">Hapus</a>
                            <a href="<?php echo base_url('admin/edit_user/' . $user['id']); ?>" class="btn btn-warning btn-sm" onclick="return confirm('Yakin ingin mengedit pengguna ini?');">Edit</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Belum ada pengguna di sistem.</p>
    <?php endif; ?>
</div>