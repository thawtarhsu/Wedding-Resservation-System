<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Gallery - WPMS</title>
    <style>
        body { font-family: Arial; background: #f0f0f0; padding: 20px; margin: 0; }
        .header { background: #6f42c1; color: white; padding: 20px; text-align: center; margin-bottom: 30px; }
        .container { max-width: 1200px; margin: 0 auto; }
        .gallery { display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px; }
        .gallery-item { background: white; border-radius: 5px; overflow: hidden; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        .gallery-item img { width: 100%; height: 250px; object-fit: cover; }
        .gallery-item h4 { padding: 15px; margin: 0; color: #6f42c1; background: #f9f9f9; }
        .gallery-item p { padding: 0 15px 15px; margin: 0; font-size: 14px; color: #666; }
        a { color: #6f42c1; text-decoration: none; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Wedding Gallery</h1>
        <p>Browse our beautiful wedding collections</p>
    </div>
    <div class="container">
        <h2 style="text-align: center; color: #6f42c1; margin-top: 30px;">Myanmar Style Weddings</h2>
        <div class="gallery">
            <div class="gallery-item">
                <img src="https://via.placeholder.com/300x250/8B4513/FFFFFF?text=Burmese+Tradition" alt="Myanmar Wedding">
                <h4>Traditional Burmese Ceremony</h4>
                <p>Beautiful traditional Thingyan style wedding with traditional attire</p>
            </div>
            <div class="gallery-item">
                <img src="https://via.placeholder.com/300x250/CD853F/FFFFFF?text=Gold+Ceremony" alt="Myanmar Gold">
                <h4>Golden Thingyan Celebration</h4>
                <p>Elegant gold and red decorations with traditional Myanmar style</p>
            </div>
            <div class="gallery-item">
                <img src="https://via.placeholder.com/300x250/B8860B/FFFFFF?text=Burmese+Hall" alt="Myanmar Hall">
                <h4>Grand Burmese Hall Wedding</h4>
                <p>Traditional pagoda-inspired venue with authentic Myanmar decor</p>
            </div>
        </div>

        <h2 style="text-align: center; color: #6f42c1; margin-top: 40px;">European Style Weddings</h2>
        <div class="gallery">
            <div class="gallery-item">
                <img src="https://via.placeholder.com/300x250/FFB6C1/FFFFFF?text=Church+Wedding" alt="European Church">
                <h4>Classic Church Wedding</h4>
                <p>Elegant European-style church ceremony with white flowers and decorations</p>
            </div>
            <div class="gallery-item">
                <img src="https://via.placeholder.com/300x250/F0E68C/FFFFFF?text=Garden+Romance" alt="European Garden">
                <h4>Romantic Garden Romance</h4>
                <p>Beautiful garden setting with European-style floral arrangements</p>
            </div>
            <div class="gallery-item">
                <img src="https://via.placeholder.com/300x250/DEB887/FFFFFF?text=Luxury+Palace" alt="European Palace">
                <h4>Luxury Palace Reception</h4>
                <p>Grand European palace-style venue with elegant decor and fine dining</p>
            </div>
        </div>

        <p style="text-align: center; margin-top: 40px;"><a href="index.php">← Back to Home</a></p>
    </div>
</body>
</html>
