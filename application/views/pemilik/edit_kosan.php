<div class="container mt-4">
    <h1>Edit Kosan: <?php echo $kosan['nama']; ?></h1>
    <?php if ($this->session->flashdata('success')): ?>
        <div class="alert alert-success"><?php echo $this->session->flashdata('success'); ?></div>
    <?php endif; ?>
    <?php if ($this->session->flashdata('error') || validation_errors()): ?>
        <div class="alert alert-danger"><?php echo $this->session->flashdata('error') ?: validation_errors(); ?></div>
    <?php endif; ?>
    <form method="post" action="<?php echo base_url('pemilik/edit_kosan/' . $kosan['id']); ?>" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="nama" class="form-label">Nama Kosan</label>
            <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $kosan['nama']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <textarea class="form-control" id="alamat" name="alamat" required><?php echo $kosan['alamat']; ?></textarea>
        </div>
        <div class="mb-3">
            <label for="kecamatan" class="form-label">Kecamatan</label>
            <input type="text" class="form-control" id="kecamatan" name="kecamatan" value="<?php echo $kosan['kecamatan']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="desa" class="form-label">Desa</label>
            <input type="text" class="form-control" id="desa" name="desa" value="<?php echo $kosan['desa']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="harga" class="form-label">Harga per Bulan (Rp)</label>
            <input type="number" class="form-control" id="harga" name="harga" value="<?php echo $kosan['harga']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="tipe" class="form-label">Tipe Kosan</label>
            <select class="form-control" id="tipe" name="tipe" required>
                <option value="putra" <?php echo $kosan['tipe'] == 'putra' ? 'selected' : ''; ?>>Putra</option>
                <option value="putri" <?php echo $kosan['tipe'] == 'putri' ? 'selected' : ''; ?>>Putri</option>
                <option value="campur" <?php echo $kosan['tipe'] == 'campur' ? 'selected' : ''; ?>>Campur</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="kepribadian" class="form-label">Kepribadian</label>
            <select class="form-control" id="kepribadian" name="kepribadian" required>
                <option value="introvert" <?php echo $kosan['kepribadian'] == 'introvert' ? 'selected' : ''; ?>>Introvert</option>
                <option value="ekstrovert" <?php echo $kosan['kepribadian'] == 'ekstrovert' ? 'selected' : ''; ?>>Ekstrovert</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea class="form-control" id="deskripsi" name="deskripsi"><?php echo $kosan['deskripsi']; ?></textarea>
        </div>
        <div class="mb-3">
            <label for="google_maps_link" class="form-label">Link Google Maps (Opsional)</label>
            <input type="url" class="form-control" id="google_maps_link" name="google_maps_link" value="<?php echo $kosan['google_maps_link']; ?>">
        </div>
        <div class="mb-3">
            <label for="fasilitas" class="form-label">Fasilitas (Tambah beberapa)</label>
            <div id="fasilitas-container">
                <?php foreach ($fasilitas as $f): ?>
                    <div class="input-group mb-2">
                        <input type="text" class="form-control" name="fasilitas[]" value="<?php echo $f['nama_fasilitas']; ?>">
                        <button type="button" class="btn btn-outline-secondary" onclick="addFasilitas()">+</button>
                        <button type="button" class="btn btn-outline-danger" onclick="this.parentElement.remove()">-</button>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="mb-3">
            <label for="foto_kosan" class="form-label">Foto Kosan (Maksimal 8, masing-masing < 2MB, unggah ulang untuk mengganti)</label>
            <input type="file" class="form-control" id="foto_kosan" name="foto_kosan[]" accept="image/jpeg,image/png,image/jpg" multiple>
            <small class="form-text text-muted">Foto saat ini:</small>
            <div class="row">
                <?php foreach ($foto_kosan as $foto): ?>
                    <div class="col-md-3">
                        <img src="<?php echo base_url($foto['path']); ?>" alt="Foto Kosan" class="img-thumbnail" style="width: 100%;">
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
    </form>
</div>
<script>
function addFasilitas() {
    const container = document.getElementById('fasilitas-container');
    const newInput = document.createElement('div');
    newInput.className = 'input-group mb-2';
    newInput.innerHTML = `
        <input type="text" class="form-control" name="fasilitas[]" placeholder="Contoh: Wi-Fi">
        <button type="button" class="btn btn-outline-secondary" onclick="addFasilitas()">+</button>
        <button type="button" class="btn btn-outline-danger" onclick="this.parentElement.remove()">-</button>
    `;
    container.appendChild(newInput);
}
</script>