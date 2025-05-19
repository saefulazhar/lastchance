<div class="main-content">
    <div class="container mt-4">
        <h1>Tanggapi Laporan</h1>
        
        <?php if ($this->session->flashdata('success')): ?>
            <div class="alert alert-success"><?php echo $this->session->flashdata('success'); ?></div>
            <?php endif; ?>
            <?php if ($this->session->flashdata('error')): ?>
                <div class="alert alert-danger"><?php echo $this->session->flashdata('error'); ?></div>
                <?php endif; ?>
                
                <?php if ($laporan): ?>
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($laporan['judul']); ?></h5>
                            <p><strong>Deskripsi:</strong> <?php echo htmlspecialchars($laporan['deskripsi']); ?></p>
                            <p><strong>Kosan:</strong> <?php echo htmlspecialchars($laporan['nama_kosan'] ?? 'Tidak Ditentukan'); ?></p>
                            <p><strong>Pelapor:</strong> <?php echo htmlspecialchars($laporan['nama_user'] ?? 'Tidak Diketahui'); ?></p>
                            <p><strong>Status:</strong> <?php echo htmlspecialchars($laporan['status']); ?></p>
                            <p><strong>Tanggal Dibuat:</strong> <?php echo htmlspecialchars($laporan['created_at']); ?></p>
                            <?php if ($laporan['lampiran']): ?>
                                <p><strong>Lampiran:</strong></p>
                                <img src="<?php echo base_url($laporan['lampiran']); ?>" alt="Lampiran Laporan" class="img-fluid" style="max-width: 300px;">
                                <?php else: ?>
                                    <p><strong>Lampiran:</strong> Tidak ada</p>
                                    <?php endif; ?>
                                </div>
                            </div>
                            
                            <?php if ($laporan['status'] !== 'Sudah Ditanggapi'): ?>
                                <?php echo form_open('admin/tanggapi_laporan/' . $laporan['id']); ?>
                                <div class="mb-3">
                                    <label for="tanggapan" class="form-label">Tanggapan</label>
                                    <textarea class="form-control" id="tanggapan" name="tanggapan" rows="5" required><?php echo set_value('tanggapan'); ?></textarea>
                                    <?php echo form_error('tanggapan', '<div class="text-danger">', '</div>'); ?>
                                </div>
                                <button type="submit" class="btn btn-success">Kirim Tanggapan</button>
                                <a href="<?php echo base_url('admin/daftar_laporan'); ?>" class="btn btn-secondary">Kembali</a>
                                <?php echo form_close(); ?>
            <?php else: ?>
                <p class="alert alert-info">Laporan ini sudah ditanggapi.</p>
            <?php endif; ?>
        <?php else: ?>
            <p class="alert alert-danger">Laporan tidak ditemukan.</p>
        <?php endif; ?>
    </div>
</div>