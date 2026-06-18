<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Pricing - WPMS</title>
    <style>
        body { font-family: Arial; background: #f0f0f0; padding: 20px; margin: 0; }
        .header { background: #6f42c1; color: white; padding: 20px; text-align: center; margin-bottom: 30px; }
        .container { max-width: 1200px; margin: 0 auto; }
        .currency-toggle { text-align: center; margin-bottom: 20px; }
        .currency-toggle button { background: #6f42c1; color: white; padding: 8px 15px; border: none; border-radius: 3px; cursor: pointer; margin: 0 5px; }
        .currency-toggle button.active { background: #5a2fa0; }
        .packages { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; }
        .package { background: white; padding: 20px; border-radius: 5px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        .package h3 { color: #6f42c1; margin-top: 0; }
        .price { font-size: 28px; font-weight: bold; color: #6f42c1; margin: 15px 0; }
        .price-usd { display: none; }
        .price-kyat { display: block; }
        ul { margin: 15px 0; padding-left: 20px; }
        ul li { margin: 8px 0; }
        button.book { background: #6f42c1; color: white; padding: 12px 20px; border: none; border-radius: 3px; cursor: pointer; width: 100%; margin-top: 15px; font-size: 16px; }
        button.book:hover { background: #5a2fa0; }
        a { color: #6f42c1; text-decoration: none; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Wedding Packages & Pricing</h1>
    </div>
    
    <div class="container">
        <div class="currency-toggle">
            <button class="active" onclick="showCurrency('kyat')">Myanmar Kyat (MMK)</button>
            <button onclick="showCurrency('usd')">US Dollar (USD)</button>
        </div>

        <div class="packages">
            <div class="package">
                <h3>Basic Package</h3>
                <p>Perfect for intimate gatherings</p>
                <div class="price price-kyat">၇,០००,०००</div>
                <div class="price price-usd">$3,500</div>
                <ul>
                    <li>Venue coordination</li>
                    <li>Guest list management</li>
                    <li>Basic decorations</li>
                    <li>Up to 100 guests</li>
                </ul>
                <button class="book" onclick="alert('Booking feature coming soon!')">Book Now</button>
            </div>
            <div class="package">
                <h3>Premium Package</h3>
                <p>For larger celebrations</p>
                <div class="price price-kyat">२०,००००००</div>
                <div class="price price-usd">$10,000</div>
                <ul>
                    <li>Full venue setup</li>
                    <li>Catering service</li>
                    <li>Professional decorations</li>
                    <li>Photography</li>
                    <li>Up to 200 guests</li>
                </ul>
                <button class="book" onclick="alert('Booking feature coming soon!')">Book Now</button>
            </div>
            <div class="package">
                <h3>Luxury Package</h3>
                <p>The ultimate experience</p>
                <div class="price price-kyat">४०,०००००००</div>
                <div class="price price-usd">$20,000</div>
                <ul>
                    <li>Premium venue</li>
                    <li>Full catering & bar</li>
                    <li>Luxury decorations</li>
                    <li>Photography & videography</li>
                    <li>Live entertainment</li>
                    <li>Up to 300+ guests</li>
                </ul>
                <button class="book" onclick="alert('Booking feature coming soon!')">Book Now</button>
            </div>
        </div>
        <p style="text-align: center; margin-top: 30px;"><a href="index.php">← Back to Home</a></p>
    </div>

    <script>
        function showCurrency(currency) {
            const priceKyat = document.querySelectorAll('.price-kyat');
            const priceUsd = document.querySelectorAll('.price-usd');
            const buttons = document.querySelectorAll('.currency-toggle button');
            
            buttons.forEach(btn => btn.classList.remove('active'));
            event.target.classList.add('active');
            
            if (currency === 'kyat') {
                priceKyat.forEach(p => p.style.display = 'block');
                priceUsd.forEach(p => p.style.display = 'none');
            } else {
                priceKyat.forEach(p => p.style.display = 'none');
                priceUsd.forEach(p => p.style.display = 'block');
            }
        }
    </script>
</body>
</html>
