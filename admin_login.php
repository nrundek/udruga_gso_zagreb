<?php
// Pokretanje sesije za pohranu korisničkih podataka
session_start();

// Definiranje administratorskog korisničkog imena i lozinke
define('ADMIN_USERNAME', 'Admin');
define('ADMIN_PASSWORD', 'Severus994');

// Provjera prijave
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Provjera unesenih podataka s definiranim administratorskim podacima
    if ($username === ADMIN_USERNAME && $password === ADMIN_PASSWORD) {
        // Pohranjivanje korisničkih podataka u sesiju
        $_SESSION['username'] = $username;
        $_SESSION['role'] = 'Admin';

        // Preusmjeravanje na administratorski panel
        header("Location: admin_panel.php");
        exit;
    } else {
        $error = "Neispravno korisničko ime ili lozinka.";
    }
}
?>

<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prijava administratora</title>
    <link rel="stylesheet" href="rundekstil.css">
</head>
<body>
<?php include 'header.php'; ?>
<main>
    <h2>Prijava</h2>
    <?php if (isset($error)): ?>
        <p style="color:red;"><?php echo $error; ?></p>
    <?php endif; ?>
    <p>
	><form action="admin_login.php" method="POST">
        <label for="username">Korisničko ime:</label>
        <input type="text" id="username" name="username" required><br>
<br>
        <label for="password">Lozinka:</label>
        <input type="password" id="password" name="password" required><br>
</p>
        <button type="submit">Prijava</button>
    </form>
</p>
<p>
<a href="index.php">Povratak na početnu</a>
</p>
</main>
</body>
</html>
