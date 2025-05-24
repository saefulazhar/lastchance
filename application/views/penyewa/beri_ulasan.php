<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beri Ulasan Kosan - BapakKos</title>
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
            position: relative;
        }
        .review-header h1 {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 0.25rem;
        }
        .review-header p {
            font-size: 0.9rem;
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
            margin-top: 1.5rem;
        }
        .review-categories {
            display: flex;
            flex-wrap: wrap;
            gap: 0.75rem;
            margin-bottom: 1.5rem;
        }
        .category-item {
            background-color: #f3f4f6;
            border: 1px solid #e5e7eb;
            border-radius: 0.375rem;
            padding: 0.5rem 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .category-item:hover, .category-item.active {
            background-color: #fee2e2;
            border-color: #a52a2a;
        }
        .category-item i {
            color: #a52a2a;
        }
        .review-tips {
            background-color: #f3f4f6;
            border-radius: 0.375rem;
            padding: 1rem;
            margin-top: 1.5rem;
            border-left: 4px solid #a52a2a;
        }
        .review-tips h5 {
            color: #a52a2a;
            margin-bottom: 0.5rem;
            font-size: 0.875rem;
            font-weight: 600;
        }
        .review-tips ul {
            margin: 0;
            padding-left: 1.25rem;
            color: #4b5563;
        }
        .review-tips li {
            margin-bottom: 0.25rem;
        }
    </style>
</head>
<body>
    <div class="review-container">
        <div class="review-card">
            <div class="review-header">
                <h1><i class="fas fa-star mr-2"></i>Beri Ulasan untuk Kosan</h1>
                <p>Bagikan pengalaman Anda untuk membantu pengguna lain</p>
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
                <?php echo form_open('penyewa/beri_ulasan/' . $kosan_id); ?>
                    <div class="mb-6">
                        <label for="rating" class="flex items-center">
                            <i class="fas fa-star mr-2"></i>Rating (1-5)
                        </label>
                        <div class="rating-control">
                            <input type="range" class="custom-range" id="ratingSlider" min="0" max="5" step="0.1" value="3" oninput="updateRating(this.value)">
                            <span class="rating-value" id="ratingValue">3</span>
                            <span class="emoji-rating" id="ratingEmoji">😊</span>
                            <input type="hidden" name="rating" id="rating" value="3">
                        </div>
                        <div class="star-rating-display" id="starDisplay">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="far fa-star"></i>
                            <i class="far fa-star"></i>
                        </div>
                    </div>
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
                    <div class="mb-6">
                        <label for="ulasan" class="flex items-center">
                            <i class="fas fa-comment mr-2"></i>Ulasan Anda
                        </label>
                        <textarea name="ulasan" id="ulasan" class="form-control" rows="4" placeholder="Bagikan pengalaman Anda tinggal di kosan ini..."></textarea>
                        <small class="text-red-500"><?php echo form_error('ulasan'); ?></small>
                    </div>
                    <div class="review-tips">
                        <h5><i class="fas fa-lightbulb mr-2"></i>Tips Menulis Ulasan yang Baik:</h5>
                        <ul>
                            <li>Jelaskan pengalaman Anda secara detail dan jujur</li>
                            <li>Sebutkan kelebihan dan kekurangan kosan</li>
                            <li>Berikan informasi tentang lokasi, fasilitas, dan lingkungan sekitar</li>
                            <li>Sampaikan apakah kosan ini sesuai dengan nilai uang yang dibayarkan</li>
                        </ul>
                    </div>
                    <div class="action-buttons">
                        <button type="submit" class="btn-primary">
                            <i class="fas fa-paper-plane mr-2"></i>Kirim Ulasan
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
            updateRating(3);
        });

        function updateRating(value) {
            document.getElementById('rating').value = value;
            document.getElementById('ratingValue').textContent = value;
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

        function toggleActive(element) {
            element.classList.toggle('active');
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