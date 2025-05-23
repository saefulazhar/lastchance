<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beri Ulasan Kosan - BapakKos</title>
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
        .review-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('/api/placeholder/800/300') center/cover no-repeat;
            opacity: 0.1;
            z-index: 0;
        }
        .review-header h1 {
            font-size: 1.8rem;
            margin-bottom: 5px;
            font-weight: 600;
            position: relative;
            z-index: 1;
        }
        .review-header p {
            margin-bottom: 0;
            position: relative;
            z-index: 1;
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
        .rating-stars {
            display: flex;
            flex-direction: row-reverse;
            justify-content: flex-start;
            margin-bottom: 15px;
        }
        .rating-stars input {
            display: none;
        }
        .rating-stars label {
            cursor: pointer;
            font-size: 35px;
            color: #ddd;
            margin-right: 10px;
            transition: color 0.3s ease;
        }
        .rating-stars label:hover,
        .rating-stars label:hover ~ label,
        .rating-stars input:checked ~ label {
            color: #ffcc00;
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
        .star-rating-display {
            font-size: 24px;
            margin-bottom: 15px;
            color: #ffcc00;
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
        .review-categories {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            margin-bottom: 25px;
        }
        .category-item {
            background-color: #f8f9fa;
            border-radius: 8px;
            padding: 10px 15px;
            display: flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
            border: 1px solid #e0e0e0;
        }
        .category-item:hover, .category-item.active {
            background-color: #e6f3ff;
            border-color: #0066cc;
        }
        .category-item i {
            color: #0066cc;
        }
        .review-tips {
            background-color: #f8f9fa;
            border-radius: 8px;
            padding: 15px;
            margin-top: 20px;
            border-left: 4px solid #0066cc;
        }
        .review-tips h5 {
            color: #0066cc;
            margin-bottom: 10px;
            font-size: 1rem;
        }
        .review-tips ul {
            margin-bottom: 0;
            padding-left: 20px;
        }
        .review-tips li {
            margin-bottom: 5px;
            color: #555;
        }
    </style>
</head>
<body>
    <div class="review-container">
        <div class="review-card">
            <div class="review-header">
                <h1><i class="fas fa-star me-2"></i> Beri Ulasan untuk Kosan</h1>
                <p>Bagikan pengalaman Anda untuk membantu pengguna lain</p>
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
                
                <?php echo form_open('penyewa/beri_ulasan/' . $kosan_id); ?>
                    <!-- Rating Section -->
                    <div class="form-group">
                        <label for="rating">
                            <i class="fas fa-star me-2"></i>Rating (1-5)
                        </label>
                        
                        <div class="rating-control">
                            <input type="range" class="custom-range" id="ratingSlider" min="0" max="5" step="0.1" value="3" oninput="updateRating(this.value)">
                            <span class="rating-value" id="ratingValue">3</span>
                            <span class="emoji-rating" id="ratingEmoji">😊</span>
                            <input type="hidden" name="rating" id="rating" value="3">
                        </div>
                        
                        <div class="star-rating-display mb-2" id="starDisplay">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="far fa-star"></i>
                            <i class="far fa-star"></i>
                        </div>
                    </div>
                    
                    <!-- Review Categories (Optional, for UI only) -->
                    <div class="review-categories">
                        <div class="category-item" onclick="toggleActive(this)">
                            <i class="fas fa-broom"></i>
                            <span>Kebersihan</span>
                        </div>
                        <div class="category-item" onclick="toggleActive(this)">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>Lokasi</span>
                        </div>
                        <div class="category-item" onclick="toggleActive(this)">
                            <i class="fas fa-money-bill-wave"></i>
                            <span>Harga</span>
                        </div>
                        <div class="category-item" onclick="toggleActive(this)">
                            <i class="fas fa-couch"></i>
                            <span>Fasilitas</span>
                        </div>
                        <div class="category-item" onclick="toggleActive(this)">
                            <i class="fas fa-user-shield"></i>
                            <span>Keamanan</span>
                        </div>
                    </div>
                    
                    <!-- Ulasan Section -->
                    <div class="form-group">
                        <label for="ulasan">
                            <i class="fas fa-comment me-2"></i>Ulasan Anda
                        </label>
                        <textarea name="ulasan" id="ulasan" class="form-control" rows="4" placeholder="Bagikan pengalaman Anda tinggal di kosan ini..."></textarea>
                    </div>
                    
                    <!-- Review Tips -->
                    <div class="review-tips">
                        <h5><i class="fas fa-lightbulb me-2"></i>Tips Menulis Ulasan yang Baik:</h5>
                        <ul>
                            <li>Jelaskan pengalaman Anda secara detail dan jujur</li>
                            <li>Sebutkan kelebihan dan kekurangan kosan</li>
                            <li>Berikan informasi tentang lokasi, fasilitas, dan lingkungan sekitar</li>
                            <li>Sampaikan apakah kosan ini sesuai dengan nilai uang yang dibayarkan</li>
                        </ul>
                    </div>
                    
                    <!-- Action Buttons -->
                    <div class="action-buttons mt-4">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-paper-plane me-2"></i>Kirim Ulasan
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
            updateRating(3); // Default rating of 3
        });
        
        // Update rating display
        function updateRating(value) {
            // Update hidden input and visible value
            document.getElementById('rating').value = value;
            document.getElementById('ratingValue').textContent = value;
            
            // Update stars display
            const starCount = Math.floor(value);
            const fraction = value - starCount;
            
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
        
        // Toggle active class for category items
        function toggleActive(element) {
            element.classList.toggle('active');
            
            // Get all selected categories to help with review suggestions
            const selectedCategories = document.querySelectorAll('.category-item.active');
            let placeholderText = "Bagikan pengalaman Anda tinggal di kosan ini...";
            
            if (selectedCategories.length > 0) {
                placeholderText += "\n\nBeberapa hal yang dapat Anda bahas:";
                selectedCategories.forEach(category => {
                    const categoryText = category.querySelector('span').textContent;
                    
                    switch(categoryText) {
                        case 'Kebersihan':
                            placeholderText += "\n- Bagaimana kondisi kebersihan kamar dan area umum?";
                            break;
                        case 'Lokasi':
                            placeholderText += "\n- Bagaimana akses transportasi dan jarak ke fasilitas umum?";
                            break;
                        case 'Harga':
                            placeholderText += "\n- Apakah harga sesuai dengan fasilitas yang didapat?";
                            break;
                        case 'Fasilitas':
                            placeholderText += "\n- Apa fasilitas yang tersedia dan bagaimana kondisinya?";
                            break;
                        case 'Keamanan':
                            placeholderText += "\n- Bagaimana tingkat keamanan kosan dan lingkungan sekitar?";
                            break;
                    }
                });
            }
            
            document.getElementById('ulasan').placeholder = placeholderText;
        }
    </script>
</body>
</html>