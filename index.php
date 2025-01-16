<?php
$categories = [
    "Ambientes Integrados" => "ambientes",
    "Construídos" => "construidos",
    "Lavanderias" => "lavanderias",
    "Banheiros" => "banheiros",
    "Salas" => "salas",
    "Quartos" => "quartos",
    "Comercial" => "comercial",
    "Cozinhas" => "cozinhas",
    "Escritórios" => "escritorios"
];

$currentCategory = $_GET['category'] ?? array_key_first($categories);
$directory = "images/{$categories[$currentCategory]}";
$images = is_dir($directory) ? array_diff(scandir($directory), ['.', '..']) : [];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Josivânia Alves</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
</head>
<body>
    <header class="header">
        <div class="logo">Josivânia Alves</div>

        <!-- Mobile Menu Toggle -->
        <div class="menu-toggle">
            <div></div>
            <div></div>
            <div></div>
        </div>

        <!-- Desktop Navigation -->
        <nav class="nav">
            <?php foreach ($categories as $name => $folder): ?>
                <a href="?category=<?= urlencode($name) ?>" 
                   class="<?= $name === $currentCategory ? 'active' : '' ?>">
                   <?= $name ?>
                </a>
            <?php endforeach; ?>
        </nav>

        <!-- Mobile Navigation -->
        <nav class="nav-mobile">
            <?php foreach ($categories as $name => $folder): ?>
                <a href="?category=<?= urlencode($name) ?>" 
                   class="<?= $name === $currentCategory ? 'active' : '' ?>">
                   <?= $name ?>
                </a>
            <?php endforeach; ?>
        </nav>
    </header>
    
    <section>
        <h2><?= $currentCategory ?></h2>
        <div class="swiper-container">
            <div class="swiper-wrapper">
                <?php if (!empty($images)): ?>
                    <?php foreach ($images as $image): ?>
                        <div class="swiper-slide">
                            <img src="<?= "$directory/$image" ?>" alt="<?= htmlspecialchars($image) ?>">
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No images available in this category.</p>
                <?php endif; ?>
            </div>
            <!-- Navigation buttons -->
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
            <!-- Pagination -->
            <div class="swiper-pagination"></div>
        </div>
    </section>

    <footer class="footer">
        <p>© 2025 Josivânia Alves. All rights reserved.</p>
    </footer>

    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script>
        // Initialize Swiper.js
        const swiper = new Swiper('.swiper-container', {
            loop: true,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            autoplay: {
                delay: 3000,
                disableOnInteraction: false,
            },
        });

        // Toggle Mobile Menu
        const menuToggle = document.querySelector('.menu-toggle');
        const navMobile = document.querySelector('.nav-mobile');

        menuToggle.addEventListener('click', () => {
            navMobile.classList.toggle('active');
        });
    </script>
</body>
</html>

