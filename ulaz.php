<?php
session_start();

// Provjera je li korisnik prijavljen
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Ako nije, preusmjerava ga na prijavu
    exit;
}

// Prikaz korisničkih informacija
echo "<h2>Dobrodošli, " . htmlspecialchars($_SESSION['username']) . "!</h2>";
echo "<p>Vaša uloga: " . htmlspecialchars($_SESSION['role']) . "</p>";

// Ovdje može ići početni sadržaj aplikacije
?>
<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Početak aplikacije</title>
<link rel="stylesheet" href="rundekstil.css">
</head>
<body>
<?php include 'header.php'; ?>
<?php include 'navigacija.php'; ?>
<main>
<h1>Aplikacija za evidenciju članova</h1>
    <p>Web aplikacija za evidenciju članova Udruge gluhoslijepih Zagreb</p>
<p>Sve poteškoće u radu prijavite administratoru.
</main>
<?php include 'footer.php'; ?>
</body>
</html>