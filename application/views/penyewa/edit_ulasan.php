<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Ulasan Kosan - BapakKos</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome untuk ikon -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
            color: #333;
        }
        .review-container {
            max-width: 800px;
            margin: 40px auto;
            padding: 0 20px;
        }
        .review-card {
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
            overflow: hidden;
        }
        .review-header {
            background: linear-gradient(135deg, #0066cc 0%, #004999 100%);
            color: white;
            padding: 25px 30px;
            position: relative;
        }
        .review-header h1 {
            font-size: 1.8rem;
            margin-bottom: 0;
            font-weight: 600;
        }
        .review-form {
            padding: 30px;
        }
        .form-group {
            margin-bottom: 25px;
        }
        .form-control {
            border-radius: 8px;
            padding: 12px 15px;
            border: 1px solid #ced4da;
        }
        .form-control:focus {
            box-shadow: 0 0 0 0.25rem rgba(0, 102, 204, 0.25);
            border-color: #0066cc;
        }
        label {
            font-weight: 500;
            margin-bottom: 10px;
            color: #444;
            display: block;
        }
        .alert {
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 20px;
        }
        .btn-primary {
            background: linear-gradient(135deg, #0066cc 0%, #004999 100%);
            border: none;
            padding: 12px 25px;
            border-radius: 8px;
            font-weight: 500;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(0,0,0,0.15);
            background: linear-gradient(135deg, #005bb8 0%, #003d80 100%);
        }
        .star-rating {
            display: flex;
            flex-direction: row-reverse;
            justify-content: flex-end;
            margin-bottom: 15px;
        }
        .star-rating input {
            display: none;
        }
        .star-rating label {
            cursor: pointer;
            font-size: 30px;
            color: #ccc;
            margin: 0 2px;
            transition: color 0.3s ease;
        }
        .star-rating input:checked ~ label,
        .star-rating label:hover,
        .star-rating label:hover ~ label {
            color: #ffcc00;
        }
        .star-rating-display {
            font-size: 24px;
            margin-bottom: 15px;
            color: #ffcc00;
        }
        .review-info {
            background-color: #f8f9fa;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 20px;
            border-left: 4px solid #0066cc;
        }
        .review-info p {
            margin-bottom: 8px;
            color: #555;
        }
        .review-info strong {
            color: #333;
        }
        .custom-range {
            width: 100%;
            height: 10px;
            padding: 0;
            background-color: transparent;
            appearance: none;
        }
        .custom-range::-webkit-slider-thumb {
            appearance: none;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background: #0066cc;
            cursor: pointer;
            margin-top: -6px;
        }
        .custom-range::-webkit-slider-runnable-track {
            width: 100%;
            height: 8px;
            cursor: pointer;
            background: #e0e0e0;
            border-radius: 4px;
        }
        .rating-value {
            font-size: 24px;
            font-weight: bold;
            color: #0066cc;
            margin-left: 15px;
        }
        .rating-control {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }
        .emoji-rating {
            font-size: 28px;
            margin-left: 10px;
        }
        textarea.form-control {
            min-height: 150px;
            resize: vertical;
        }
        .action-buttons {
            display: flex;
            gap: 15px;
        }
        .btn-secondary {
            background-color: #6c757d;
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 8px;
            font-weight: 500;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }
        .btn-secondary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(0,0,0,0.15);
            background-color: #5a6268;
        }
    </style>
</head>
<body>
    <div class="review-container">
        <div class="review-card">
            <div class="review-header">
                <h1><i class="fas fa-edit me-2"></i> Edit Ulasan untuk Kosan</h1>
            </div>
            
            <div class="review-form">
                <!-- Alert Notifications -->
                <?php if ($this->session->flashdata('success')): ?>
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle me-2"></i>
                        <?php echo htmlspecialchars($this->session->flashdata('success')); ?>
                    </div>
                <?php endif; ?>
                
                <?php if ($this->session->flashdata('error')): ?>
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-circle me-2"></i>
                        <?php echo htmlspecialchars($this->session->flashdata('error')); ?>
                    </div>
                <?php endif; ?>
                
                <?php echo validation_errors('<div class="alert alert-danger"><i class="fas fa-exclamation-circle me-2"></i>', '</div>'); ?>
                
                <?php echo form_open('penyewa/edit_ulasan/' . $ulasan['id']); ?>
                    <!-- Rating Section -->
                    <div class="form-group">
                        <label for="rating">Rating (1-5)</label>
                        <div class="rating-control">
                            <input type="range" class="custom-range" id="ratingSlider" min="0" max="5" step="0.1" value="<?php echo htmlspecialchars($ulasan['rating']); ?>" oninput="updateRating(this.value)">
                            <span class="rating-value" id="ratingValue"><?php echo htmlspecialchars($ulasan['rating']); ?></span>
                            <span class="emoji-rating" id="ratingEmoji">★★★★★</span>
                            <input type="hidden" name="rating" id="rating" value="<?php echo htmlspecialchars($ulasan['rating']); ?>">
                        </div>
                        
                        <div class="star-rating-display mb-2" id="starDisplay">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                    
                    <!-- Ulasan Section -->
                    <div class="form-group">
                        <label for="ulasan">
                            <i class="fas fa-comment me-2"></i>Ulasan Anda
                        </label>
                        <textarea name="ulasan" id="ulasan" class="form-control" rows="4" placeholder="Bagikan pengalaman Anda tinggal di kosan ini..."><?php echo htmlspecialchars($ulasan['ulasan']); ?></textarea>
                        <div class="form-text text-muted mt-2">
                            <i class="fas fa-info-circle me-1"></i> Tips: Sebutkan hal-hal seperti kebersihan, kenyamanan, lokasi, atau fasilitas yang tersedia.
                        </div>
                    </div>
                    
                    <!-- Action Buttons -->
                    <div class="action-buttons">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Perbarui Ulasan
                        </button>
                        <a href="javascript:history.back()" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Kembali
                        </a>
                    </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
    
    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        // Initialize the display on page load
        document.addEventListener('DOMContentLoaded', function() {
            updateRating(document.getElementById('ratingSlider').value);
        });
        
        // Update rating display
        function updateRating(value) {
            // Update hidden input and visible value
            document.getElementById('rating').value = value;
            document.getElementById('ratingValue').textContent = value;
            
            // Update stars display
            const starCount = Math.floor(value);
            const fraction = value - starCount;
            let stars = '';
            
            // Update emoji based on rating
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
            
            // Update star display
            const starDisplay = document.getElementById('starDisplay');
            starDisplay.innerHTML = '';
            
            // Full stars
            for (let i = 0; i < Math.floor(value); i++) {
                starDisplay.innerHTML += '<i class="fas fa-star"></i>';
            }
            
            // Half star if needed
            if (fraction >= 0.3 && fraction < 0.8) {
                starDisplay.innerHTML += '<i class="fas fa-star-half-alt"></i>';
            } else if (fraction >= 0.8) {
                starDisplay.innerHTML += '<i class="fas fa-star"></i>';
            }
            
            // Empty stars
            const emptyStars = 5 - Math.ceil(value);
            for (let i = 0; i < emptyStars; i++) {
                starDisplay.innerHTML += '<i class="far fa-star"></i>';
            }
        }
    </script>
</body>
</html>