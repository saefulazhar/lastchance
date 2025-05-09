<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="container mt-5">
    <h2>Ajukan Pemesanan untuk <?php echo $kosan['nama']; ?></h2>

    <?php if (validation_errors()): ?>
        <div class="alert alert-danger"><?php echo validation_errors(); ?></div>
    <?php endif; ?>

    <form action="<?php echo base_url('penyewa/sewa/' . $kosan['id']); ?>" method="post">
        <div class="form-group">
            <label for="durasi">Durasi Sewa (bulan)</label>
            <input type="number" class="form-control" id="durasi" name="durasi" value="<?php echo set_value('durasi'); ?>" min="1" required>
        </div>
        <div class="form-group">
            <label for="tanggal_mulai">Tanggal Mulai</label>
            <input type="date" class="form-control" id="tanggal_mulai" name="tanggal_mulai" value="<?php echo set_value('tanggal_mulai'); ?>" required>
        </div>
        <div class="form-group">
            <label>Harga per Bulan</label>
            <p>Rp <?php echo number_format($kosan['harga'], 0, ',', '.'); ?></p>
        </div>
        <button type="submit" class="btn btn-primary">Ajukan Pemesanan</button>
        <a href="<?php echo base_url('home/detail/' . $kosan['id']); ?>" class="btn btn-secondary">Kembali</a>
    </form>
</div>