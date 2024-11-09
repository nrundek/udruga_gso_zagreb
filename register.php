<?php
// Povezivanje na bazu podataka
$host = 'localhost';
$dbname = 'ugso_zg';
$username = 'root';
$password = ''; // prilagodite prema vašoj postavci baze

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Neuspješno povezivanje na bazu podataka: " . $e->getMessage());
}

// Funkcija za hashiranje lozinke
function hashPassword($password) {
    return password_hash($password, PASSWORD_BCRYPT);
}

$message = ""; // Varijabla za pohranu poruke

// Provjera unosa korisničkih podataka
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = hashPassword($_POST['password']);
    $email = $_POST['email'];
    $role = $_POST['role'];

    // Provjera valjanosti uloge
    if ($role !== 'Administrator' && $role !== 'Zaposlenik') {
        $message = "Nevažeća uloga. Molimo odaberite Administrator ili Zaposlenik.";
    } else {
        // Priprema SQL upita za unos korisnika
        $stmt = $pdo->prepare("INSERT INTO admin_users (username, password, email, role) VALUES (:username, :password, :email, :role)");

        try {
            $stmt->execute([
                ':username' => $username,
                ':password' => $password,
                ':email' => $email,
                ':role' => $role
            ]);
            $message = "Korisnik je dodan";
        } catch (PDOException $e) {
            $message = "Greška pri dodavanju korisnika: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registracija korisnika</title>
    <link rel="stylesheet" href="rundekstil.css">
</head>
<body>
<?php include 'header.php'; ?>
<nav>
<a href="admin_panel.php">Početno sučelje</a>
<a href="korisnici.php">Popis korisnika</a>
<a href="index.php">Odjava</a>
</nav>

<main>
    <h2>Dodavanje novog korisnika</h2>
    
    <?php if ($message): ?>
        <p><?php echo $message; ?></p>
        <form action="register.php" method="GET">
            <button type="submit">Dodaj</button>
        </form>
    <?php else: ?>
        <form action="register.php" method="POST">
            <label for="username">Korisničko ime:</label>
            <input type="text" id="username" name="username" required><br>

            <label for="password">Lozinka:</label>
            <input type="password" id="password" name="password" required><br>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email"><br>

            <label for="role">Uloga:</label>
            <select id="role" name="role" required>
                <option value="Zaposlenik">Zaposlenik</option>
            </select><br>

            <button type="submit">Dodaj korisnika</button>
        </form>
    <?php endif; ?>
</main>
</body>
</html>
