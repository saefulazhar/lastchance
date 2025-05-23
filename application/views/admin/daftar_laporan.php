<div class="main-content">
    <div class="container mt-4">
        <h1 class="display-4 fw-bold mb-4" style="color: #8B0000;">Daftar Laporan</h1>
        <?php if ($this->session->flashdata('success')): ?>
            <div class="alert alert-success" style="background: linear-gradient(135deg, #28a745 0%, #1e7e34 100%); color: #fff; border: none; border-radius: 10px;">
                <?php echo htmlspecialchars($this->session->flashdata('success')); ?>
            </div>
        <?php endif; ?>
        <?php if ($this->session->flashdata('error')): ?>
            <div class="alert alert-danger" style="background: linear-gradient(135deg, #dc3545 0%, #a71d2a 100%); color: #fff; border: none; border-radius: 10px;">
                <?php echo htmlspecialchars($this->session->flashdata('error')); ?>
            </div>
        <?php endif; ?>
        <?php if (empty($laporan)): ?>
            <div class="alert alert-info" style="background: linear-gradient(135deg, #17a2b8 0%, #117a8b 100%); color: #fff; border: none; border-radius: 10px;">
                Tidak ada laporan yang tersedia.
            </div>
        <?php else: ?>
            <table class="table table-bordered mt-3" style="background: #fff; color: #000; border-radius: 10px; overflow: hidden; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);">
                <thead style="background: #fff;">
                    <tr>
                        <th style="color: black;">Judul</th>
                        <th style="color: black;">Deskripsi</th>
                        <th style="color: black;">Kosan</th>
                        <th style="color: black;">Pelapor</th>
                        <th style="color: black;">Tanggal Dibuat</th>
                        <th style="color: black;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($laporan as $item): ?>
                        <tr style="transition: all 0.3s ease-in-out;" onmouseover="this.style.background='#f8f9fa';" onmouseout="this.style.background='#fff';">
                            <td style="color: #000;"><?php echo htmlspecialchars($item['judul']); ?></td>
                            <td style="color: #000;"><?php echo htmlspecialchars($item['deskripsi']); ?></td>
                            <td style="color: #000;"><?php echo htmlspecialchars($item['nama_kosan'] ?? 'Tidak Ditentukan'); ?></td>
                            <td style="color: #000;"><?php echo htmlspecialchars($item['nama_user'] ?? 'Tidak Diketahui'); ?></td>
                            <td style="color: #000;"><?php echo htmlspecialchars($item['created_at']); ?></td>
                            <td>
                                <a href="<?php echo base_url('admin/detail_laporan/' . $item['id']); ?>" 
                                   class="btn btn-sm btn-info" 
                                   style="background: #17a2b8; color: #fff; border: none; border-radius: 8px; transition: all 0.3s ease-in-out;"
                                   onmouseover="this.style.background='#138496'; this.style.transform='scale(1.05)';"
                                   onmouseout="this.style.background='#17a2b8'; this.style.transform='scale(1)';">Detail</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</div>

<style>
.table {
    transition: all 0.3s ease-in-out;
}
.transition-all {
    transition: all 0.3s ease-in-out;
}
</style>