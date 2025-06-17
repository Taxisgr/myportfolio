<?php
require_once 'db.php';
?>



<?php
// Ανάκτηση κατηγοριών από τη βάση
$categoryQuery = "SELECT * FROM categories";
$categoryStmt = $pdo->query($categoryQuery);
$categories = $categoryStmt->fetchAll();

// Ανάκτηση projects με βάση το category (αν υπάρχει)
$categoryId = $_GET['category'] ?? null;

if ($categoryId) {
 $stmt = $pdo->prepare("SELECT projects.*, categories.name AS category_name 
                       FROM projects 
                       JOIN categories ON projects.category_id = categories.id 
                       WHERE category_id = ?");
  $stmt->execute([$categoryId]);
} else {
  $stmt = $pdo->query("SELECT projects.*, categories.name AS category_name 
                     FROM projects 
                     JOIN categories ON projects.category_id = categories.id");
}

$projects = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="el">

<head>
    <meta charset="UTF-8">
    <title>Το Portfolio μου</title>
    <link rel="stylesheet" href="styles.css">
    <script src="main.js" defer></script> 
</head>

<nav class="navbar">
  <div class="nav-content">
    <a href="index.php">Αρχική</a>
    <a href="about.php">Σχετικά με εμένα</a>
  </div>
</nav>

<body>

<!-- Μπάρα στην κορυφή για το progress στην σελίδα -->
<div id="scrollProgress"></div> 



<header>
    <h1> Portfolio - Χρήστος Παπαδημητρίου</h1>
</header>

<div class="container">

    <div class="intro">
        <h2>Καλωσήρθες στο προσωπικό μου site!</h2>
        <p>Εδώ μπορείς να δεις δείγματα της δουλειάς μου, των ταξιδιών μου και των ενασχολησεών μου.</p>
    </div>

    <div class="site-content">
    
    <!-- background effect animates κυκλάκια -->
    <div class="bg-sprites">
    <span class="sprite sprite-1"></span>
    <span class="sprite sprite-2"></span>
    <span class="sprite sprite-3"></span>
    <span class="sprite sprite-4"></span>
    <span class="sprite sprite-5"></span>
    </div>

    <!-- πέρνουμε όλες τις κατηγορίες και τις κάνουμε κουμπία πάνω απο το carousel -->
    <div class="categories">
        <a href="index.php" class="category-button <?= !$categoryId ? 'selected' : '' ?>">Όλα</a>
        <?php foreach ($categories as $cat): ?>
            <a href="index.php?category=<?= $cat['id'] ?>"
            class="category-button <?= $categoryId == $cat['id'] ? 'selected' : '' ?>">
            <?= htmlspecialchars($cat['name']) ?>
            </a>
        <?php endforeach; ?>
    </div>

    <!-- Ανάλογα με την κατηγορία που επιλέχθηκε φορτώνουμε τα projects -->
    <?php if (count($projects) > 0): ?>
        <div class="project-carousel">
            <button id="prevBtn">⬅</button>
            <div id="projectContainer" class="project">
                <!-- Το project φορτώνεται εδώ με JS (main.js) -->
            </div>
            <button id="nextBtn">➡</button>
        </div>
        <div class="carousel-dots" id="carouselDots"></div>
        <div id="lightbox" class="lightbox-hidden">
            <span id="lightboxClose">✕</span>
            <img id="lightboxImg" src="" alt="Expanded Image">
        </div>
    <?php else: ?>
        <p>Δεν υπάρχουν έργα στη βάση δεδομένων.</p>
    <?php endif; ?>

    <br>
    <div class="intro">
        <h2>About Me</h2>
        <p>Εδώ μπορείς να δεις περισσότερα για τις δεξιότητες μου και τις διακρίσεις μου.</p>
    </div>

    <div class="see-about">
    <a href="about.php" class="btn-about">
        <span>Μάθε περισσότερα για εμένα</span>
        <svg xmlns="http://www.w3.org/2000/svg" class="icon-arrow" viewBox="0 0 24 24" width="24" height="24">
        <path d="M13 5l7 7-7 7M5 12h14" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
    </a>
    </div>
    
    <br>
    <div class="intro">
        <h2>Listen Now</h2>
        <p>Εδώ μπορείς να ακούσεις ένα από τα κομμάτια μου.</p>
    </div>

    <!-- Spotify embed για να ακούσουμε ένα κομμάτι -->
    <iframe style="border-radius:12px" src="https://open.spotify.com/embed/track/5SfJdaO6j36akDzgAJIPg7?utm_source=generator" width="100%" height="352" frameBorder="0" allowfullscreen="" allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" loading="lazy"></iframe>

    </div>

</div>

    <footer>
        <p>© 2025 Χρήστος Παπαδημητρίου. Όλα τα δικαιώματα διατηρούνται.</p>
        <a> Σχεδιασμένο από τον Χρήστο Παπαδημητρίου για την εργασία εξαμήνου Ιουνίου στο μάθημα "Δυναμικές Εφαρμογές Διαδικτύου"</a>
    </footer>

     <!-- κουμπί επιστροφής στην κορυφή -->
    <button id="backToTop" title="Επιστροφή στην κορυφή">↑</button>
</body>
<script>
    // εισάγουμε τα projects από το PHP στο JS
    // για να τα χρησιμοποιήσουμε στο carousel
  const projects = <?= json_encode($projects, JSON_UNESCAPED_UNICODE) ?>; 
</script>

</html>
