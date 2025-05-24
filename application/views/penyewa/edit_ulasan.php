<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Ulasan Kosan - BapakKos</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f3f4f6;
        }
        .review-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 0 1rem;
        }
        .review-card {
            background-color: white;
            border-radius: 0.5rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .review-header {
            background: #a52a2a; /* Maroon cerah untuk header */
            color: white;
            padding: 1.5rem;
        }
        .review-header h1 {
            font-size: 1.5rem;
            font-weight: 600;
            margin: 0;
        }
        .review-form {
            padding: 1.5rem;
        }
        .form-control {
            border: 1px solid #e5e7eb;
            border-radius: 0.375rem;
            padding: 0.75rem;
            width: 100%;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }
        .form-control:focus {
            border-color: #a52a2a;
            box-shadow: 0 0 0 3px rgba(165, 42, 42, 0.1);
            outline: none;
        }
        label {
            font-weight: 500;
            color: #374151;
            margin-bottom: 0.5rem;
            display: block;
        }
        .alert {
            border-radius: 0.375rem;
            padding: 1rem;
            margin-bottom: 1.5rem;
            border-left: 4px solid;
            animation: slideIn 0.5s ease;
        }
        .alert-success {
            background-color: #dcfce7;
            color: #166534;
            border-color: #a52a2a; /* Maroon cerah untuk border */
        }
        .alert-danger {
            background-color: #fee2e2;
            color: #991b1b;
            border-color: #dc2626;
        }
        .btn-primary {
            background-color: #a52a2a; /* Maroon cerah untuk tombol */
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 0.375rem;
            font-weight: 500;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }
        .btn-primary:hover {
            background-color: #8b2424; /* Maroon sedikit lebih gelap */
            transform: translateY(-2px);
        }
        .btn-secondary {
            background-color: #6b7280;
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 0.375rem;
            font-weight: 500;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }
        .btn-secondary:hover {
            background-color: #4b5563;
            transform: translateY(-2px);
        }
        .rating-control {
            display: flex;
            align-items: center;
            margin-bottom: 1rem;
        }
        .rating-value {
            font-size: 1.5rem;
            font-weight: bold;
            color: #a52a2a;
            margin-left: 0.75rem;
        }
        .emoji-rating {
            font-size: 1.5rem;
            margin-left: 0.5rem;
        }
        .custom-range {
            width: 100%;
            height: 8px;
            background: #e5e7eb;
            border-radius: 0.25rem;
            cursor: pointer;
        }
        .custom-range::-webkit-slider-thumb {
            appearance: none;
            width: 16px;
            height: 16px;
            border-radius: 50%;
            background: #a52a2a;
            cursor: pointer;
        }
        .star-rating-display {
            font-size: 1.25rem;
            color: #f59e0b;
            margin-bottom: 1rem;
        }
        textarea.form-control {
            min-height: 120px;
            resize: vertical;
        }
        .action-buttons {
            display: flex;
            gap: 1rem;
        }
        .form-text {
            color: #6b7280;
            font-size: 0.875rem;
            margin-top: 0.5rem;
            display: flex;
            align-items: center;
        }
        @keyframes slideIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>
    <div class="review-container">
        <div class="review-card">
            <div class="review-header">
                <h1><i class="fas fa-edit mr-2"></i>Edit Ulasan untuk Kosan</h1>
            </div>
            <div class="review-form">
                <?php if ($this->session->flashdata('success')): ?>
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle mr-2"></i>
                        <?php echo htmlspecialchars($this->session->flashdata('success')); ?>
                    </div>
                <?php endif; ?>
                <?php if ($this->session->flashdata('error')): ?>
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-circle mr-2"></i>
                        <?php echo htmlspecialchars($this->session->flashdata('error')); ?>
                    </div>
                <?php endif; ?>
                <?php echo validation_errors('<div class="alert alert-danger"><i class="fas fa-exclamation-circle mr-2"></i>', '</div>'); ?>
                <?php echo form_open('penyewa/edit_ulasan/' . $ulasan['id'], ['class' => 'space-y-6']); ?>
                    <div>
                        <label for="rating" class="flex items-center">
                            <i class="fas fa-star mr-2"></i>Rating (1-5)
                        </label>
                        <div class="rating-control">
                            <input type="range" class="custom-range" id="ratingSlider" min="0" max="5" step="0.1" value="<?php echo htmlspecialchars($ulasan['rating']); ?>" oninput="updateRating(this.value)">
                            <span class="rating-value" id="ratingValue"><?php echo htmlspecialchars($ulasan['rating']); ?></span>
                            <span class="emoji-rating" id="ratingEmoji"></span>
                            <input type="hidden" name="rating" id="rating" value="<?php echo htmlspecialchars($ulasan['rating']); ?>">
                        </div>
                        <div class="star-rating-display" id="starDisplay">
                            <?php
                                $rating = floatval($ulasan['rating']);
                                $full_stars = floor($rating);
                                $fraction = $rating - $full_stars;
                                for ($i = 0; $i < $full_stars; $i++) {
                                    echo '<i class="fas fa-star"></i>';
                                }
                                if ($fraction >= 0.3 && $fraction < 0.8) {
                                    echo '<i class="fas fa-star-half-alt"></i>';
                                } elseif ($fraction >= 0.8) {
                                    echo '<i class="fas fa-star"></i>';
                                }
                                $empty_stars = 5 - ceil($rating);
                                for ($i = 0; $i < $empty_stars; $i++) {
                                    echo '<i class="far fa-star"></i>';
                                }
                            ?>
                        </div>
                    </div>
                    <div>
                        <label for="ulasan" class="flex items-center">
                            <i class="fas fa-comment mr-2"></i>Ulasan Anda
                        </label>
                        <textarea name="ulasan" id="ulasan" class="form-control" rows="4" placeholder="Bagikan pengalaman Anda tinggal di kosan ini..."><?php echo htmlspecialchars($ulasan['ulasan']); ?></textarea>
                        <div class="form-text">
                            <i class="fas fa-info-circle mr-1"></i>Tips: Sebutkan hal-hal seperti kebersihan, kenyamanan, lokasi, atau fasilitas yang tersedia.
                        </div>
                        <small class="text-red-500"><?php echo form_error('ulasan'); ?></small>
                    </div>
                    <div class="action-buttons">
                        <button type="submit" class="btn-primary">
                            <i class="fas fa-save mr-2"></i>Perbarui Ulasan
                        </button>
                        <a href="javascript:history.back()" class="btn-secondary">
                            <i class="fas fa-arrow-left mr-2"></i>Kembali
                        </a>
                    </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            updateRating(document.getElementById('ratingSlider').value);
        });

        function updateRating(value) {
            document.getElementById('rating').value = value;
            document.getElementById('ratingValue').textContent = parseFloat(value).toFixed(1);
            const ratingEmoji = document.getElementById('ratingEmoji');
            if (value >= 4.5) {
                ratingEmoji.textContent = '😍';
            } else if (value >= 3.5) {
                ratingEmoji.textContent = '😊';
            } else if (value >= 2.5) {
                ratingEmoji.textContent = '😐';
            } else if (value >= 1.5) {
                ratingEmoji.textContent = '😕';
            } else {
                ratingEmoji.textContent = '😞';
            }
            const starDisplay = document.getElementById('starDisplay');
            starDisplay.innerHTML = '';
            const starCount = Math.floor(value);
            const fraction = value - starCount;
            for (let i = 0; i < starCount; i++) {
                starDisplay.innerHTML += '<i class="fas fa-star"></i>';
            }
            if (fraction >= 0.3 && fraction < 0.8) {
                starDisplay.innerHTML += '<i class="fas fa-star-half-alt"></i>';
            } else if (fraction >= 0.8) {
                starDisplay.innerHTML += '<i class="fas fa-star"></i>';
            }
            const emptyStars = 5 - Math.ceil(value);
            for (let i = 0; i < emptyStars; i++) {
                starDisplay.innerHTML += '<i class="far fa-star"></i>';
            }
        }
    </script>
</body>
</html>