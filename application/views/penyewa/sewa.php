<div class="container mt-4">
    <h1>Pemesanan Kosan: <?php echo $kosan['nama']; ?></h1>
    <?php if ($this->session->flashdata('success')): ?>
        <div class="alert alert-success"><?php echo $this->session->flashdata('success'); ?></div>
    <?php endif; ?>
    <?php if ($this->session->flashdata('error') || validation_errors()): ?>
        <div class="alert alert-danger"><?php echo $this->session->flashdata('error') ?: validation_errors(); ?></div>
    <?php endif; ?>
    <form method="post" action="<?php echo base_url('penyewa/sewa/' . $kosan['id']); ?>">
        <div class="mb-3">
            <label for="durasi" class="form-label">Durasi Sewa (bulan)</label>
            <input type="number" class="form-control" id="durasi" name="durasi" required>
        </div>
        <div class="mb-3">
            <label for="tanggal_mulai" class="form-label">Tanggal Mulai</label>
            <input type="date" class="form-control" id="tanggal_mulai" name="tanggal_mulai" required>
        </div>
        <div class="mb-3">
            <p><strong>Harga per Bulan:</strong> Rp <?php echo number_format($kosan['harga'], 0, ',', '.'); ?></p>
        </div>
        <button type="submit" class="btn btn-success">Ajukan Pemesanan</button>
    </form>
</div>