<?php
// Provjerite prijavu (kod koji ste naveli za autentifikaciju je već uključen)

// Povezivanje na bazu podataka (isti podaci kao i prije)
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

// Obrada zahtjeva za brisanje korisnika
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $pdo->prepare("DELETE FROM admin_users WHERE id = :id");
    $stmt->execute([':id' => $id]);
    echo "Korisnik je uspješno obrisan!";
}

// Obrada zahtjeva za ažuriranje lozinke i uloge
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    $id = $_POST['id'];
    $password = hashPassword($_POST['password']);
    $role = $_POST['role'];
    
    $stmt = $pdo->prepare("UPDATE admin_users SET password = :password, role = :role WHERE id = :id");
    $stmt->execute([
        ':password' => $password,
        ':role' => $role,
        ':id' => $id
    ]);
    echo "Korisnik je uspješno ažuriran!";
}

// Dohvaćanje svih korisnika iz baze
$stmt = $pdo->prepare("SELECT * FROM admin_users");
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prikaz korisnika</title>
    <link rel="stylesheet" href="rundekstil.css">
</head>
<body>
<?php include 'header.php'; ?>
<nav>
<a href="admin_panel.php">Početno sučelje</a>
<a href="register.php">Dodavanje korisnika</a>
<a href="index.php">Odjava</a>
</nav>


<h2>Popis korisnika</h2>
<table>
    <tr>
        <th>ID</th>
        <th>Korisničko ime</th>
        <th>Email</th>
        <th>Uloga</th>
        <th>Akcije</th>
    </tr>
    <?php foreach ($users as $user): ?>
    <tr>
        <td><?= htmlspecialchars($user['id']) ?></td>
        <td><?= htmlspecialchars($user['username']) ?></td>
        <td><?= htmlspecialchars($user['email']) ?></td>
        <td><?= htmlspecialchars($user['role']) ?></td>
        <td>
            <form action="" method="POST" style="display:inline;">
                <input type="hidden" name="id" value="<?= htmlspecialchars($user['id']) ?>">
                <input type="password" name="password" placeholder="Nova lozinka" required>
                <select name="role">
                    <option value="Zaposlenik" <?= $user['role'] === 'Zaposlenik' ? 'selected' : '' ?>>Zaposlenik</option>
                    <option value="Administrator" <?= $user['role'] === 'Administrator' ? 'selected' : '' ?>>Administrator</option>
                </select>
                <button type="submit" name="update">Ažuriraj</button>
            </form>
            <a href="?delete=<?= htmlspecialchars($user['id']) ?>" onclick="return confirm('Jeste li sigurni da želite obrisati korisnika?')">Obriši</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
</body>
</html>
