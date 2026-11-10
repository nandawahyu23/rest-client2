
<?php
include("config/config.php");

// API KEY NewsAPI
$api_key = "629269a76f8a40ae8cad47211a6f6274";

// Mengambil berita teknologi
$url = "https://newsapi.org/v2/top-headlines?country=us&category=technology&pageSize=12&apiKey=".$api_key;

$data = http_request_get($url);
$hasil = json_decode($data, true);

$articles = $hasil['articles'] ?? [];

function clean($value) {
    return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechNews - Technology News</title>

    <link rel="stylesheet" href="CSS/style.css">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark">
    <a class="navbar-brand" href="#">
        Tech<span>News.</span>
    </a>

    <button class="navbar-toggler" type="button"
        data-toggle="collapse" data-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="#">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#news">Technology News</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#about">About</a>
            </li>
        </ul>
    </div>
</nav>

<!-- HERO SECTION -->
<section class="hero">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-md-8">

                <div class="hero-label">
                    ✦ YOUR DAILY TECHNOLOGY UPDATE
                </div>

                <h1>
                    Explore The Future<br>
                    Of <span>Technology.</span>
                </h1>

                <p>
                    Temukan berita terbaru seputar teknologi,
                    inovasi digital, perkembangan AI, dan dunia
                    teknologi dari berbagai sumber internasional.
                </p>

                <a href="#news" class="hero-btn">
                    Explore News →
                </a>

            </div>
        </div>
    </div>
</section>

<!-- NEWS SECTION -->
<section class="news-section" id="news">

    <div class="container-fluid">

        <h2 class="section-title">Latest Technology News</h2>

        <p class="section-desc">
            Berita teknologi terbaru yang dikumpulkan secara otomatis.
        </p>

        <div class="row">

            <?php if (!empty($articles)) { ?>

                <?php foreach ($articles as $row) { ?>

                    <div class="col-lg-4 col-md-6">

                        <div class="news-card">

                            <img
                                src="<?php echo clean($row['urlToImage'] ?? ''); ?>"
                                class="news-image"
                                alt="News Image"
                                onerror="this.src='https://placehold.co/600x400/172033/FFFFFF?text=TechNews';"
                            >

                            <div class="news-body">

                                <span class="category">
                                    TECHNOLOGY
                                </span>

                                <h3 class="news-title">
                                    <?php echo clean($row['title'] ?? ''); ?>
                                </h3>

                                <p class="news-description">
                                    <?php echo clean($row['description'] ?? 'Deskripsi berita tidak tersedia.'); ?>
                                </p>

                                <p class="news-author">
                                    ✍ <?php echo clean($row['author'] ?? 'Unknown Author'); ?>
                                    <br>
                                    📰 <?php echo clean($row['source']['name'] ?? 'Unknown Source'); ?>
                                </p>

                                <a
                                    href="<?php echo clean($row['url'] ?? '#'); ?>"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    class="read-more"
                                >
                                    READ FULL ARTICLE →
                                </a>

                            </div>
                        </div>

                    </div>

                <?php } ?>

            <?php } else { ?>

                <div class="col-12">
                    <div class="alert alert-warning">
                        Berita tidak ditemukan. Silakan periksa koneksi
                        API News atau API Key Anda.
                    </div>
                </div>

            <?php } ?>

        </div>
    </div>
</section>

<!-- FOOTER -->
<footer id="about">
    <p>
        © 2026 <span>TechNews.</span>
        All Rights Reserved.
    </p>
    <p>Powered by NewsAPI</p>
</footer>

</body>
</html>
