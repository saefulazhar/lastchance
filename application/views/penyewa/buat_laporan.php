<div class="main-content">
    <div class="container mt-4">
        <h1>Buat Laporan</h1>
        <?php if ($this->session->flashdata('success')): ?>
            <div class="alert alert-success"><?php echo $this->session->flashdata('success'); ?></div>
        <?php endif; ?>
        <?php if ($this->session->flashdata('error')): ?>
            <div class="alert alert-danger"><?php echo $this->session->flashdata('error'); ?></div>
        <?php endif; ?>

        <?php echo form_open_multipart('penyewa/buat_laporan/' . ($selected_kosan_id ?: '') . '/' . ($selected_sewa_id ?: '')); ?>
            <?php if ($selected_kosan_id): ?>
                <input type="hidden" name="kosan_id" value="<?php echo htmlspecialchars($selected_kosan_id); ?>">
                <p><strong>Kosan yang Dilaporkan:</strong> <?php
                    $this->load->model('Kosan_model');
                    $kosan = $this->Kosan_model->get_kosan_by_id($selected_kosan_id);
                    echo htmlspecialchars($kosan['nama']);
                ?></p>
            <?php endif; ?>
            <?php if ($selected_sewa_id): ?>
                <input type="hidden" name="sewa_id" value="<?php echo htmlspecialchars($selected_sewa_id); ?>">
            <?php endif; ?>
            <div class="mb-3">
                <label for="judul" class="form-label">Judul Laporan</label>
                <input type="text" class="form-control" id="judul" name="judul" value="<?php echo set_value('judul'); ?>" required>
                <?php echo form_error('judul', '<div class="text-danger">', '</div>'); ?>
            </div>
            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="5" required"><?php echo set_value('deskripsi'); ?></textarea>
                <?php echo form_error('deskripsi', '<div class="text-danger">', '</div>'); ?>
            </div>
            <div class="mb-3">
                <label for="lampiran" class="form-label">Lampiran Gambar (Opsional)</label>
                <input type="file" class="form-control" id="lampiran" name="lampiran" accept="image/*">
            </div>
            <button type="submit" class="btn btn-primary">Kirim Laporan</button>
        <?php echo form_close(); ?>
    </div>
</div>