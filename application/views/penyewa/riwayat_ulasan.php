<div class="container mt-4">
    <h1>Riwayat Ulasan</h1>
    <?php if (empty($riwayat_ulasan)): ?>
        <p>Belum ada riwayat ulasan.</p>
    <?php else: ?>
        <div class="list-group">
            <?php foreach ($riwayat_ulasan as $review): ?>
                <a href="<?php echo base_url('home/detail/' . $review['kosan_id']); ?>" class="list-group-item list-group-item-action">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1"><?php echo htmlspecialchars($review['kosan_nama']); ?></h5>
                        <small><?php echo date('d-m-Y', strtotime($review['created_at'])); ?></small>
                        </div>
                        
                    </div>
                    <p class="mb-1">
                        Rating: 
                        <?php for ($i = 1; $i <= 5; $i++): ?>
                            <?php if ($i <= floor($review['rating'])): ?>
                                <i class="bi bi-star-fill text-warning"></i>
                            <?php else: ?>
                                <i class="bi bi-star text-warning"></i>
                            <?php endif; ?>
                        <?php endfor; ?>
                        (<?php echo number_format($review['rating'], 1); ?>)
                    </p>
                    <p class="mb-1"><?php echo htmlspecialchars($review['ulasan']); ?></p>
                </a>
                    <a href="<?php echo base_url('penyewa/edit_ulasan/' . $review['id']); ?>" class="btn btn-sm btn-secondary mt-2">Edit</a>
            <?php endforeach; ?>
            <hr>
        </div>
    <?php endif; ?>
</div>

