<?php
include "db_connect.php";

$cat = isset($_GET['cat']) ? $_GET['cat'] : "Classroom";

$data = mysqli_query($conn, "SELECT * FROM photos WHERE category='$cat' ORDER BY id DESC");
$total_photos = mysqli_num_rows($data);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Photo Gallery | Visual Collection</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #4361ee;
            --primary-dark: #3a56d4;
            --secondary: #7209b7;
            --light: #f8f9fa;
            --light-gray: #e9ecef;
            --medium-gray: #adb5bd;
            --dark-gray: #495057;
            --dark: #212529;
            --shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            --shadow-hover: 0 8px 24px rgba(0, 0, 0, 0.12);
            --radius: 12px;
            --transition: all 0.3s ease;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #e4e8f0 100%);
            color: var(--dark);
            line-height: 1.6;
            min-height: 100vh;
        }

        /* Header */
        .header {
            background: var(--primary);
            color: white;
            padding: 25px 0;
            position: relative;
            overflow: hidden;
        }

        .header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, var(--primary) 0%, var(--secondary) 100%);
            opacity: 0.9;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            position: relative;
            z-index: 1;
        }

        .header-content {
            text-align: center;
            padding-bottom: 20px;
        }

        .logo {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            margin-bottom: 15px;
        }

        .logo-icon {
            font-size: 32px;
            color: white;
        }

        .logo-text {
            font-size: 28px;
            font-weight: 700;
            letter-spacing: -0.5px;
        }

        .tagline {
            font-size: 16px;
            font-weight: 300;
            opacity: 0.9;
            max-width: 600px;
            margin: 0 auto 25px;
        }

        /* Category Navigation */
        .category-nav {
            display: flex;
            justify-content: center;
            gap: 10px;
            flex-wrap: wrap;
            margin-top: 20px;
        }

        .category-btn {
            background: rgba(255, 255, 255, 0.15);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 30px;
            font-family: 'Poppins', sans-serif;
            font-size: 15px;
            font-weight: 500;
            cursor: pointer;
            transition: var(--transition);
            backdrop-filter: blur(5px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .category-btn:hover {
            background: rgba(255, 255, 255, 0.25);
            transform: translateY(-2px);
        }

        .category-btn.active {
            background: white;
            color: var(--primary);
            font-weight: 600;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        /* Gallery Info */
        .gallery-info {
            text-align: center;
            padding: 30px 0 20px;
        }

        .category-title {
            font-size: 32px;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 8px;
            position: relative;
            display: inline-block;
        }

        .category-title::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 3px;
            background: var(--primary);
            border-radius: 2px;
        }

        .photo-count {
            font-size: 16px;
            color: var(--medium-gray);
            margin-bottom: 30px;
        }

        /* Photo Grid */
        .photo-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 25px;
            padding: 0 20px 50px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .photo-card {
            background: white;
            border-radius: var(--radius);
            overflow: hidden;
            box-shadow: var(--shadow);
            transition: var(--transition);
            position: relative;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .photo-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-hover);
        }

        .photo-image-container {
            height: 220px;
            overflow: hidden;
            position: relative;
        }

        .photo-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .photo-card:hover .photo-image {
            transform: scale(1.05);
        }

        .photo-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(to bottom, transparent 60%, rgba(0, 0, 0, 0.7) 100%);
            opacity: 0;
            transition: var(--transition);
            display: flex;
            align-items: flex-end;
            padding: 20px;
        }

        .photo-card:hover .photo-overlay {
            opacity: 1;
        }

        .photo-actions {
            display: flex;
            gap: 10px;
            transform: translateY(10px);
            transition: var(--transition);
        }

        .photo-card:hover .photo-actions {
            transform: translateY(0);
        }

        .action-btn {
            background: white;
            border: none;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            cursor: pointer;
            transition: var(--transition);
            font-size: 14px;
        }

        .action-btn:hover {
            background: var(--primary);
            color: white;
            transform: scale(1.1);
        }

        .photo-content {
            padding: 20px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .photo-caption {
            font-size: 16px;
            font-weight: 500;
            color: var(--dark);
            margin-bottom: 10px;
            line-height: 1.4;
        }

        .photo-date {
            font-size: 13px;
            color: var(--medium-gray);
            margin-top: auto;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 80px 20px;
            grid-column: 1 / -1;
        }

        .empty-icon {
            font-size: 64px;
            color: var(--light-gray);
            margin-bottom: 20px;
        }

        .empty-title {
            font-size: 24px;
            color: var(--dark-gray);
            margin-bottom: 10px;
        }

        .empty-text {
            color: var(--medium-gray);
            max-width: 500px;
            margin: 0 auto 30px;
        }

        /* Footer */
        .footer {
            background: var(--dark);
            color: white;
            padding: 30px 0;
            text-align: center;
        }

        .footer-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .footer p {
            margin-bottom: 10px;
            opacity: 0.8;
        }

        .social-links {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-top: 20px;
        }

        .social-link {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-decoration: none;
            transition: var(--transition);
        }

        .social-link:hover {
            background: var(--primary);
            transform: translateY(-3px);
        }

        /* Modal */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.9);
            z-index: 1000;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .modal-content {
            max-width: 90%;
            max-height: 90%;
            position: relative;
        }

        .modal-image {
            max-width: 100%;
            max-height: 80vh;
            border-radius: 8px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
        }

        .modal-caption {
            color: white;
            text-align: center;
            margin-top: 20px;
            font-size: 18px;
        }

        .modal-close {
            position: absolute;
            top: -40px;
            right: 0;
            background: none;
            border: none;
            color: white;
            font-size: 30px;
            cursor: pointer;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .photo-grid {
                grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
                gap: 20px;
                padding: 0 15px 40px;
            }
            
            .category-title {
                font-size: 28px;
            }
            
            .logo-text {
                font-size: 24px;
            }
        }

        @media (max-width: 576px) {
            .photo-grid {
                grid-template-columns: 1fr;
                max-width: 400px;
                margin: 0 auto;
            }
            
            .category-nav {
                gap: 8px;
            }
            
            .category-btn {
                padding: 8px 16px;
                font-size: 14px;
            }
            
            .header {
                padding: 20px 0;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="header">
        <div class="container">
            <div class="header-content">
                <div class="logo">
                    <i class="fas fa-camera-retro logo-icon"></i>
                    <h1 class="logo-text">Visual Gallery</h1>
                </div>
                <p class="tagline">Capturing moments, creating memories. Explore our collection of photos from various events and activities.</p>
                
                <!-- Category Navigation -->
                <nav class="category-nav">
                    <a href="?cat=Classroom" class="category-btn <?php echo $cat == 'Classroom' ? 'active' : ''; ?>">
                        <i class="fas fa-chalkboard-teacher"></i> Classroom
                    </a>
                    <a href="?cat=Events" class="category-btn <?php echo $cat == 'Events' ? 'active' : ''; ?>">
                        <i class="fas fa-calendar-alt"></i> Events
                    </a>
                  
                </nav>
            </div>
        </div>
    </header>

    <!-- Gallery Info -->
    <section class="gallery-info">
        <div class="container">
            <h2 class="category-title"><?php echo htmlspecialchars($cat); ?> Gallery</h2>
            <p class="photo-count"><?php echo $total_photos; ?> photos in this collection</p>
        </div>
    </section>

    <!-- Photo Grid -->
    <main class="container">
        <div class="photo-grid">
            <?php if ($total_photos > 0): ?>
                <?php while($row = mysqli_fetch_assoc($data)): 
                    $upload_date = date("F j, Y", strtotime($row['upload_date'] ?? 'now'));
                ?>
                    <div class="photo-card" data-id="<?php echo $row['id']; ?>">
                        <div class="photo-image-container">
                            <img src="uploads/<?php echo htmlspecialchars($row['image_path']); ?>" 
                                 alt="<?php echo htmlspecialchars($row['caption']); ?>" 
                                 class="photo-image"
                                 onerror="this.src='https://images.unsplash.com/photo-1551963831-b3b1ca40c98e?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'">
                            <div class="photo-overlay">
                                <div class="photo-actions">
                                    <button class="action-btn view-btn" title="View Full Size">
                                        <i class="fas fa-expand"></i>
                                    </button>
                                    <button class="action-btn download-btn" title="Download">
                                        <i class="fas fa-download"></i>
                                    </button>
                                    <button class="action-btn share-btn" title="Share">
                                        <i class="fas fa-share-alt"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="photo-content">
                            <p class="photo-caption"><?php echo htmlspecialchars($row['caption']); ?></p>
                            <p class="photo-date">
                                <i class="far fa-calendar"></i> <?php echo $upload_date; ?>
                            </p>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <div class="empty-state">
                    <div class="empty-icon">
                        <i class="far fa-images"></i>
                    </div>
                    <h3 class="empty-title">No Photos Found</h3>
                    <p class="empty-text">There are no photos in the "<?php echo htmlspecialchars($cat); ?>" category yet. Please check back later or explore other categories.</p>
                    <a href="?cat=Classroom" class="category-btn active" style="display: inline-block;">
                        <i class="fas fa-chalkboard-teacher"></i> View Classroom Photos
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-content">
            <p>&copy; <?php echo date('Y'); ?> Visual Gallery. All rights reserved.</p>
            <p>Capturing moments that matter</p>
            <div class="social-links">
                <a href="#" class="social-link"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="social-link"><i class="fab fa-twitter"></i></a>
                <a href="#" class="social-link"><i class="fab fa-instagram"></i></a>
                <a href="#" class="social-link"><i class="fab fa-pinterest"></i></a>
            </div>
        </div>
    </footer>

    <!-- Modal for Full-size View -->
    <div class="modal" id="imageModal">
        <button class="modal-close" id="closeModal">&times;</button>
        <div class="modal-content">
            <img id="modalImage" class="modal-image" src="" alt="">
            <p id="modalCaption" class="modal-caption"></p>
        </div>
    </div>

    <script>
        // Image modal functionality
        const modal = document.getElementById('imageModal');
        const modalImage = document.getElementById('modalImage');
        const modalCaption = document.getElementById('modalCaption');
        const closeModal = document.getElementById('closeModal');
        
        // View button click handler
        document.querySelectorAll('.view-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const card = this.closest('.photo-card');
                const imageSrc = card.querySelector('.photo-image').src;
                const caption = card.querySelector('.photo-caption').textContent;
                
                modalImage.src = imageSrc;
                modalCaption.textContent = caption;
                modal.style.display = 'flex';
                document.body.style.overflow = 'hidden';
            });
        });
        
        // Close modal
        closeModal.addEventListener('click', () => {
            modal.style.display = 'none';
            document.body.style.overflow = 'auto';
        });
        
        // Close modal when clicking outside
        modal.addEventListener('click', (e) => {
            if (e.target === modal) {
                modal.style.display = 'none';
                document.body.style.overflow = 'auto';
            }
        });
        
        // Download button functionality
        document.querySelectorAll('.download-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const card = this.closest('.photo-card');
                const imageSrc = card.querySelector('.photo-image').src;
                const caption = card.querySelector('.photo-caption').textContent;
                
                // Create a temporary link for download
                const link = document.createElement('a');
                link.href = imageSrc;
                link.download = caption.substring(0, 30) + '.jpg';
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
                
                // Show feedback
                const originalHTML = this.innerHTML;
                this.innerHTML = '<i class="fas fa-check"></i>';
                this.style.background = '#2ecc71';
                this.style.color = 'white';
                
                setTimeout(() => {
                    this.innerHTML = originalHTML;
                    this.style.background = '';
                    this.style.color = '';
                }, 1500);
            });
        });
        
        // Share button functionality
        document.querySelectorAll('.share-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const card = this.closest('.photo-card');
                const caption = card.querySelector('.photo-caption').textContent;
                const imageSrc = card.querySelector('.photo-image').src;
                
                // For demo purposes - in a real app, you'd use the Web Share API
                if (navigator.share) {
                    navigator.share({
                        title: 'Photo from Visual Gallery',
                        text: caption,
                        url: window.location.href,
                    });
                } else {
                    // Fallback: Copy to clipboard
                    const shareText = `${caption} - View this photo at ${window.location.href}`;
                    navigator.clipboard.writeText(shareText).then(() => {
                        const originalHTML = this.innerHTML;
                        this.innerHTML = '<i class="fas fa-check"></i>';
                        this.style.background = '#3498db';
                        this.style.color = 'white';
                        
                        setTimeout(() => {
                            this.innerHTML = originalHTML;
                            this.style.background = '';
                            this.style.color = '';
                        }, 1500);
                    });
                }
            });
        });
        
        // Add animation to photo cards on page load
        document.addEventListener('DOMContentLoaded', function() {
            const cards = document.querySelectorAll('.photo-card');
            cards.forEach((card, index) => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';
                
                setTimeout(() => {
                    card.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, index * 100);
            });
        });
    </script>
</body>
</html>