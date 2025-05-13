<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="container mt-4">
    <h1>Beri Ulasan untuk <?php echo htmlspecialchars($sewa['nama_kosan']); ?></h1>
    <?php if ($this->session->flashdata('error') || validation_errors()): ?>
        <div class="alert alert-danger"><?php echo $this->session->flashdata('error') ?: validation_errors(); ?></div>
    <?php endif; ?>
    <form method="post" action="<?php echo base_url('penyewa/save_ulasan'); ?>">
        <input type="hidden" name="sewa_id" value="<?php echo htmlspecialchars($sewa['id']); ?>">
        <input type="hidden" name="kosan_id" value="<?php echo htmlspecialchars($sewa['kosan_id']); ?>">
        <div class="mb-3">
            <label for="rating" class="form-label">Rating (1-5)</label>
            <select class="form-control" id="rating" name="rating" required>
                <option value="">Pilih rating</option>
                <option value="1">1 - Sangat Buruk</option>
                <option value="2">2 - Buruk</option>
                <option value="3">3 - Cukup</option>
                <option value="4">4 - Baik</option>
                <option value="5">5 - Sangat Baik</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="ulasan" class="form-label">Ulasan</label>
            <textarea class="form-control" id="ulasan" name="ulasan" rows="5" required><?php echo set_value('ulasan'); ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Kirim Ulasan</button>
    </form>
</div>