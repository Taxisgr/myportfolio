<?php require_once 'db.php'; ?>

<!-- εδώ fetcharoume τα ταξίδια,βιβλία και τραγούδια από την sql -->
<?php 
$travelsQuery = "SELECT * FROM travels";
$travelsStmt = $pdo->query($travelsQuery);
$travels = $travelsStmt->fetchAll();

$booksQuery = "SELECT * FROM books";
$booksStmt = $pdo->query($booksQuery);
$books = $booksStmt->fetchAll();

$songsQuery = "SELECT * FROM songs";
$songsStmt = $pdo->query($songsQuery);
$songs = $songsStmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="el">

<head>
  <meta charset="UTF-8">
  <title>Σχετικά με εμένα</title>
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
  <div class="about-header">
    <h1>Σχετικά με τον Χρήστο</h1>
    <p>Είμαι 23 ετών και σπουδάζω στό Τμήμα Τεχνών Ήχου & Εικόνας στήν Κέρκυρα</p>
  </div>

  <div class="site-content">

  <!-- background effect (κυκλάκια) -->
    <div class="bg-sprites">
    <span class="sprite sprite-1"></span>
    <span class="sprite sprite-2"></span>
    <span class="sprite sprite-3"></span>
    <span class="sprite sprite-4"></span>
    <span class="sprite sprite-5"></span>
    </div>


  <div class="about-container">
    <!-- 1. Εκπαίδευση & Γλώσσες -->
    <section class="about-card">
      <h2>Εκπαίδευση & Γλώσσες</h2>
      <ul>
        <li>Τμήμα Τεχνών Ήχου & Εικόνας (Κέρκυρα)</li>
        <li>Πτυχίο Αγγλικών (Cambridge)</li>
      </ul>
    </section>

    <!-- 2. Εργασία -->
    <section class="about-card">
      <h2>Εργασία & Άδεια Οδήγησης</h2>
      <ul>
        <li>Εστίαση (Barista / Σερβιτόρος)</li>
        <li>Δίπλωμα Οδήγησης Κατηγορίας B</li>
      </ul>
    </section>

    <!-- 3. Δεξιότητες -->
    <section class="about-card">
      <h2>Δεξιότητες</h2>
      <ul>
        <li>Sound Design & Παραγωγή Hip‑Hop</li>
        <li>Audio Editing (Ableton, Pro Tools)</li>
        <li>HTML, CSS, JavaScript (βασικά)</li>
      </ul>
    </section>

    <!-- 4. Ενδιαφέροντα -->
    <section class="about-card">
      <h2>Ενδιαφέροντα & Χόμπι</h2>
      <p>Βιβλία, Ταξίδια, Μουσική</p>
      <div class="hobbies-grid">
        <div>
          <h3>📚 Βιβλία</h3>
          <!-- πέρνουμε όλα τα βιβλία και τα βάζουμε σε λίστα -->
        <?php foreach ($books as $book): ?>
            <li>
                <a> <?= htmlspecialchars($book['title']) ?> </a>
            </li>
        <?php endforeach; ?>
        </div>
        <div>
          <h3>🌍 Ταξίδια</h3>
          <!-- πέρνουμε όλα τα ταξίδια και τα βάζουμε σε λίστα -->
        <?php foreach ($travels as $travel): ?>
            <li>
                <a href="<?= htmlspecialchars($travel['link']) ?>" target="_blank">
                    <?= htmlspecialchars($travel['title']) ?>
                </a>
            </li>
        <?php endforeach; ?>
        </div>
        <div>
          <h3>🎵 Hip‑Hop</h3>
          <!-- πέρνουμε όλα τα τραγούδια και τα βάζουμε σε λίστα -->
        <?php foreach ($songs as $song): ?>
            <li>
                <a href="<?= htmlspecialchars($song['link']) ?>" target="_blank">
                    <?= htmlspecialchars($song['title']) ?>
                </a>
            </li>
        </div>
        <?php endforeach; ?>
    </section>

    <!-- 5. Αθλητισμός & Διακρίσεις -->
    <section class="about-card">
      <h2>Αθλητισμός & Διακρίσεις</h2>
      <ul>
        <li>Παίζω Ποδόσφαιρο σε τοπική ομάδα</li>
        <br>
        <li>Θερμός υποστηρικτής της Real Madrid</li>
        <br>
        <li>Νικητής σε τοπικό διαγωνισμό σκάκι</li>
      </ul>
    </section>

    <!-- 6. Προσωπικά Χαρακτηριστικά -->
    <section class="about-card">
      <h2>Χαρακτήρας</h2>
    <ul>
        <li>Είμαι δημιουργικός, οργανωτικός και πάντα έτοιμος να μάθω κάτι νέο.</li>
        <br>
        <li>Αγαπώ τις προκλήσεις και την ομαδική εργασία.</li>
        <br>
        <li>Είμαι φιλότιμος και προσπαθώ πάντα να δίνω τον καλύτερό μου εαυτό.</li>
    </ul>
    </section>
  </div>
  <div class="see-about">
    <a href="index.php" class="btn-about">
        <span>Επιστροφή στην αρχή</span>
        <svg xmlns="http://www.w3.org/2000/svg" class="icon-arrow" viewBox="0 0 24 24" width="24" height="24">
        <path d="M13 5l7 7-7 7M5 12h14" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
    </a>
    </div>

    </div>

 <footer>
        <p>© 2025 Χρήστος Παπαδημητρίου. Όλα τα δικαιώματα διατηρούνται.</p>
        <a> Σχεδιασμένο από τον Χρήστο Παπαδημητρίου για την εργασία εξαμήνου Ιουνίου στο μάθημα "Δυναμικές Εφαρμογές Διαδικτύου"</a>
 </footer>

 <!-- κουμπί επιστροφής στην κορυφή -->
<button id="backToTop" title="Επιστροφή στην κορυφή">↑</button>
</body>
</html>
