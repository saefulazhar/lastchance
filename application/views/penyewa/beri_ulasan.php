<div class="container mt-4">
    <h1>Beri Ulasan untuk Kosan</h1>
    <?php if ($this->session->flashdata('success')): ?>
        <div class="alert alert-success"><?php echo htmlspecialchars($this->session->flashdata('success')); ?></div>
    <?php endif; ?>
    <?php if ($this->session->flashdata('error')): ?>
        <div class="alert alert-danger"><?php echo htmlspecialchars($this->session->flashdata('error')); ?></div>
    <?php endif; ?>

    <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>

    <?php echo form_open('penyewa/beri_ulasan/' . $kosan_id); ?>
        <div class="form-group">
            <label for="rating">Rating (1-5)</label>
            <input type="number" name="rating" id="rating" class="form-control" step="0.1" min="0" max="5" required>
        </div>
        <div class="form-group">
            <label for="ulasan">Ulasan</label>
            <textarea name="ulasan" id="ulasan" class="form-control" rows="4"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Kirim Ulasan</button>
    <?php echo form_close(); ?>
</div>