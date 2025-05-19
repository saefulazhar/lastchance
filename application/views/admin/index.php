<div class="container mt-4">
    <h1>Dashboard Admin</h1>
    <p>Selamat datang, <?php echo $this->session->userdata('username'); ?>!</p>
    <p>Sebagai admin, Anda dapat mengelola pengguna dan kosan di platform BapakKos.</p>
     <a href="<?php echo base_url('admin/users'); ?>" class="btn btn-primary mb-3">Daftar Pengguna</a>
     <a href="<?php echo base_url('admin/daftar_laporan'); ?>" class="btn btn-danger mb-3">Daftar Laporan</a>
</div>