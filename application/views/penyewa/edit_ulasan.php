<div class="container mt-4">
    <h1>Edit Ulasan</h1>
    <?php echo validation_errors(); ?>
    <?php echo form_open('penyewa/edit_ulasan/' . ($ulasan['id'] ?? '')); ?>
        <div class="mb-3">
            <label for="kosan_nama" class="form-label">Nama Kosan</label>
            <input type="text" class="form-control" id="kosan_nama" value="<?php echo htmlspecialchars($ulasan['kosan_nama'] ?? ''); ?>" readonly>
        </div>
        <div class="mb-3">
            <label for="rating" class="form-label">Rating (1-5)</label>
            <select class="form-control" id="rating" name="rating" required>
                <option value="">Pilih rating</option>
                <option value="1" <?php echo isset($ulasan['rating']) && $ulasan['rating'] == 1 ? 'selected' : ''; ?>>1 - Sangat Buruk</option>
                <option value="2" <?php echo isset($ulasan['rating']) && $ulasan['rating'] == 2 ? 'selected' : ''; ?>>2 - Buruk</option>
                <option value="3" <?php echo isset($ulasan['rating']) && $ulasan['rating'] == 3 ? 'selected' : ''; ?>>3 - Cukup</option>
                <option value="4" <?php echo isset($ulasan['rating']) && $ulasan['rating'] == 4 ? 'selected' : ''; ?>>4 - Baik</option>
                <option value="5" <?php echo isset($ulasan['rating']) && $ulasan['rating'] == 5 ? 'selected' : ''; ?>>5 - Sangat Baik</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="ulasan" class="form-label">Ulasan</label>
            <textarea class="form-control" id="ulasan" name="ulasan" rows="3" required><?php echo htmlspecialchars($ulasan['ulasan'] ?? ''); ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        <a href="<?php echo base_url('penyewa/riwayat_ulasan'); ?>" class="btn btn-secondary">Batal</a>
    </form>
</div>