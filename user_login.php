<?php
session_start();

// Povezivanje s bazom
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

// Provjera prijave
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Priprema i izvršavanje SQL upita za pronalaženje korisnika
    $stmt = $pdo->prepare("SELECT * FROM admin_users WHERE username = :username");
    $stmt->execute([':username' => $username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        // Pohranjivanje korisničkih podataka u sesiju
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['login_time'] = time();  // Vrijeme prijave u sekundama

        // Zapisivanje prijave u bazu
        $stmt = $pdo->prepare("INSERT INTO user_sessions (user_id, username, login_time) VALUES (:user_id, :username, NOW())");
        $stmt->execute([':user_id' => $user['id'], ':username' => $user['username']]);

        // Preusmjeravanje na ulaznu stranicu aplikacije
        header("Location: ulaz.php");
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
    <title>Prijava zaposlenika</title>
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
	<form action="user_login.php" method="POST">
        <label for="username">Korisničko ime:</label>
        <input type="text" id="username" name="username" required><br>
<br>
        <label for="password">Lozinka:</label>
        <input type="password" id="password" name="password" required><br>
<br>
        <button type="submit">Prijava</button>
    </form>
</p>
<p>
<a href="index.php">Povratak na početnu</a>
</p>
</main>
</body>
</html>
