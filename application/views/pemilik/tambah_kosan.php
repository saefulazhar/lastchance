<div class="container mt-4">
    <h1>Tambah Kosan Baru</h1>
    <?php if ($this->session->flashdata('success')): ?>
        <div class="alert alert-success"><?php echo $this->session->flashdata('success'); ?></div>
    <?php endif; ?>
    <?php if ($this->session->flashdata('error') || validation_errors()): ?>
        <div class="alert alert-danger"><?php echo $this->session->flashdata('error') ?: validation_errors(); ?></div>
    <?php endif; ?>
    <form method="post" action="<?php echo base_url('pemilik/tambah_kosan'); ?>" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="nama" class="form-label">Nama Kosan</label>
            <input type="text" class="form-control" id="nama" name="nama" required>
        </div>
        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <textarea class="form-control" id="alamat" name="alamat" required></textarea>
        </div>
        <div class="mb-3">
            <label for="kecamatan" class="form-label">Kecamatan</label>
            <input type="text" class="form-control" id="kecamatan" name="kecamatan" required>
        </div>
        <div class="mb-3">
            <label for="desa" class="form-label">Desa</label>
            <input type="text" class="form-control" id="desa" name="desa" required>
        </div>
        <div class="mb-3">
            <label for="harga" class="form-label">Harga per Bulan (Rp)</label>
            <input type="number" class="form-control" id="harga" name="harga" required>
        </div>
        <div class="mb-3">
            <label for="tipe" class="form-label">Tipe Kosan</label>
            <select class="form-control" id="tipe" name="tipe" required>
                <option value="putra">Putra</option>
                <option value="putri">Putri</option>
                <option value="campur">Campur</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="kepribadian" class="form-label">Kepribadian</label>
            <select class="form-control" id="kepribadian" name="kepribadian" required>
                <option value="introvert">Introvert</option>
                <option value="ekstrovert">Ekstrovert</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea class="form-control" id="deskripsi" name="deskripsi"></textarea>
        </div>
        <div class="mb-3">
            <label for="google_maps_link" class="form-label">Link Google Maps (Opsional)</label>
            <input type="url" class="form-control" id="google_maps_link" name="google_maps_link">
        </div>
        <div class="mb-3">
            <label for="fasilitas" class="form-label">Fasilitas (Tambah beberapa)</label>
            <div id="fasilitas-container">
                <div class="input-group mb-2">
                    <input type="text" class="form-control" name="fasilitas[]" placeholder="Contoh: Wi-Fi">
                    <button type="button" class="btn btn-outline-secondary" onclick="addFasilitas()">+</button>
                </div>
            </div>
        </div>
        <div class="mb-3">
            <label for="foto_kosan" class="form-label">Foto Kosan (Maksimal 8, masing-masing < 2MB)</label>
            <input type="file" class="form-control" id="foto_kosan" name="foto_kosan[]" accept="image/jpeg,image/png,image/jpg" multiple>
        </div>
        <button type="submit" class="btn btn-primary">Tambah Kosan</button>
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