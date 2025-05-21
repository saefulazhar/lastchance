<div class="container mt-4">
    <h1>Edit Kosan: <?php echo htmlspecialchars($kosan['nama']); ?></h1>
    <?php if ($this->session->flashdata('success')): ?>
        <div class="alert alert-success"><?php echo htmlspecialchars($this->session->flashdata('success')); ?></div>
    <?php endif; ?>
    <?php if ($this->session->flashdata('error') || validation_errors()): ?>
        <div class="alert alert-danger"><?php echo htmlspecialchars($this->session->flashdata('error') ?: validation_errors()); ?></div>
    <?php endif; ?>
    <form method="post" action="<?php echo base_url('pemilik/edit_kosan/' . $kosan['id']); ?>" enctype="multipart/form-data" id="form-edit-kosan">
        <div class="mb-3">
            <label for="nama" class="form-label">Nama Kosan</label>
            <input type="text" class="form-control" id="nama" name="nama" value="<?php echo set_value('nama', $kosan['nama']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <textarea class="form-control" id="alamat" name="alamat" required><?php echo set_value('alamat', $kosan['alamat']); ?></textarea>
        </div>
        <div class="mb-3">
            <label for="kecamatan" class="form-label">Kecamatan</label>
            <input type="text" class="form-control" id="kecamatan" name="kecamatan" value="<?php echo set_value('kecamatan', $kosan['kecamatan']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="desa" class="form-label">Desa</label>
            <input type="text" class="form-control" id="desa" name="desa" value="<?php echo set_value('desa', $kosan['desa']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="harga" class="form-label">Harga per Bulan (Rp)</label>
            <input type="number" class="form-control" id="harga" name="harga" value="<?php echo set_value('harga', $kosan['harga']); ?>" required min="0">
        </div>
        <div class="mb-3">
            <label for="tipe" class="form-label">Tipe Kosan</label>
            <select class="form-control" id="tipe" name="tipe" required>
                <option value="putra" <?php echo set_select('tipe', 'putra', $kosan['tipe'] == 'putra'); ?>>Putra</option>
                <option value="putri" <?php echo set_select('tipe', 'putri', $kosan['tipe'] == 'putri'); ?>>Putri</option>
                <option value="campur" <?php echo set_select('tipe', 'campur', $kosan['tipe'] == 'campur'); ?>>Campur</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="kepribadian" class="form-label">Kepribadian</label>
            <select class="form-control" id="kepribadian" name="kepribadian" required>
                <option value="introvert" <?php echo set_select('kepribadian', 'introvert', $kosan['kepribadian'] == 'introvert'); ?>>Introvert</option>
                <option value="extrovert" <?php echo set_select('kepribadian', 'extrovert', $kosan['kepribadian'] == 'extrovert'); ?>>Extrovert</option>
                <option value="ambivert" <?php echo set_select('kepribadian', 'ambivert', $kosan['kepribadian'] == 'ambivert'); ?>>Ambivert</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="jumlah_kamar" class="form-label">Jumlah Kamar</label>
            <input type="number" class="form-control" id="jumlah_kamar" name="jumlah_kamar" value="<?php echo set_value('jumlah_kamar', $kosan['jumlah_kamar']); ?>" required min="1">
        </div>
        <div class="mb-3">
            <label for="kamar_tersedia" class="form-label">Kamar Tersedia</label>
            <input type="number" class="form-control" id="kamar_tersedia" name="kamar_tersedia" value="<?php echo set_value('kamar_tersedia', $kosan['kamar_tersedia']); ?>" required min="0">
        </div>
        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea class="form-control" id="deskripsi" name="deskripsi"><?php echo set_value('deskripsi', $kosan['deskripsi']); ?></textarea>
        </div>
        <div class="mb-3">
            <label for="google_maps_link" class="form-label">Link Google Maps (Opsional)</label>
            <input type="url" class="form-control" id="google_maps_link" name="google_maps_link" value="<?php echo set_value('google_maps_link', $kosan['google_maps_link']); ?>">
        </div>
        <div class="mb-3">
            <label for="fasilitas" class="form-label">Fasilitas (Tambah beberapa, misalnya: Wi-Fi, Kamar Mandi Dalam)</label>
            <div id="fasilitas-container">
                <?php if (empty($fasilitas)): ?>
                    <div class="input-group mb-2">
                        <input type="text" class="form-control" name="fasilitas[]" placeholder="Contoh: Wi-Fi">
                        <button type="button" class="btn btn-outline-secondary" onclick="addFasilitas()">+</button>
                    </div>
                <?php else: ?>
                    <?php foreach ($fasilitas as $f): ?>
                        <div class="input-group mb-2">
                            <input type="text" class="form-control" name="fasilitas[]" value="<?php echo htmlspecialchars($f['nama_fasilitas']); ?>">
                            <button type="button" class="btn btn-outline-secondary" onclick="addFasilitas()">+</button>
                            <button type="button" class="btn btn-outline-danger" onclick="this.parentElement.remove()">-</button>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
        <div class="mb-3">
            <label for="foto_kosan" class="form-label">Foto Kosan (Maksimal 8, masing-masing < 2MB, unggah ulang untuk mengganti)</label>
            <input type="file" class="form-control" id="foto_kosan" name="foto_kosan[]" accept="image/jpeg,image/png,image/jpg" multiple onchange="validateFileCount(this)">
            <small class="form-text text-muted">Pilih hingga 8 file gambar (jpg, jpeg, png) dengan ukuran masing-masing < 2MB. Foto lama akan diganti jika Anda mengunggah foto baru.</small>
            <?php if (!empty($foto_kosan)): ?>
                <div class="mt-2">
                    <label class="form-label">Foto Saat Ini:</label>
                    <div class="row">
                        <?php foreach ($foto_kosan as $foto): ?>
                            <div class="col-md-3 mb-2">
                                <img src="<?php echo base_url(htmlspecialchars($foto['path'])); ?>" alt="Foto Kosan" class="img-thumbnail" style="width: 100%;">
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>
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
        <input type="text" class="form-control" name="fasilitas[]" placeholder="Contoh: Kamar Mandi Dalam">
        <button type="button" class="btn btn-outline-secondary" onclick="addFasilitas()">+</button>
        <button type="button" class="btn btn-outline-danger" onclick="this.parentElement.remove()">-</button>
    `;
    container.appendChild(newInput);
}

function validateFileCount(input) {
    const maxFiles = 8;
    const maxSize = 2 * 1024 * 1024; // 2MB dalam bytes

    if (input.files.length > maxFiles) {
        alert('Maksimal 8 foto yang dapat diunggah!');
        input.value = '';
        return;
    }

    for (let i = 0; i < input.files.length; i++) {
        if (input.files[i].size > maxSize) {
            alert('File ' + input.files[i].name + ' terlalu besar! Maksimal 2MB per file.');
            input.value = '';
            return;
        }
        if (!['image/jpeg', 'image/png', 'image/jpg'].includes(input.files[i].type)) {
            alert('File ' + input.files[i].name + ' tidak diizinkan! Hanya jpg, jpeg, atau png.');
            input.value = '';
            return;
        }
    }
}
</script>