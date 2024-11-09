<?php
session_start(); // Pokretanje sesije

$host = "localhost";
$dbname = "ugso_zg";
$username = "root";
$password = "";

// Spoji se na bazu podataka
$conn = mysqli_connect($host, $username, $password, $dbname);

if (mysqli_connect_errno()) {
    die("Connection error: " . mysqli_connect_error());
}

// Postavi početni upit
$sql = "";
$search = "";

// Provjeri je li obrazac poslan
if (isset($_GET['search']) && $_GET['search'] !== "") {
    $search = mysqli_real_escape_string($conn, $_GET['search']);
    $sql = "SELECT id, ime, prezime, datum_rodjenja, oib, gender, status, komunikacija, ulica, postanski_broj, mjesto, telefon, email, clanstvo FROM up_clanovi WHERE ime LIKE '%$search%' OR prezime LIKE '%$search%' OR mjesto LIKE '%$search%'";
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        die("Query error: " . mysqli_error($conn));
    }
}
?>

<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <title>Pretraga članova</title>
    <link rel="stylesheet" href="rundekstil.css">
</head>
<body>
<?php include 'header.php'; ?>
<?php include 'navigacija.php'; ?>

<main>
    <h2>Pretraga članova</h2>

    <!-- Obrazac za pretragu -->
    <form method="GET" action="pretraga.php">
        <input type="text" name="search" value="<?php echo htmlspecialchars($search); ?>" placeholder="Unesite ime, prezime ili mjesto">
        <button type="submit">Pretraži</button>
    </form>

    <?php if (!empty($sql) && isset($result)): ?>
        <?php if (mysqli_num_rows($result) > 0): ?>
            <h2>Rezultat pretrage</h2>
            <!-- Prikazi podatke u tablici -->
            <table border='1'>
                <tr>
                    <th>Ime</th>
                    <th>Prezime</th>
                    <th>Datum rođenja</th>
                    <th>OIB</th>
                    <th>Spol</th>
                    <th>Status</th>
                    <th>Vrsta komunikacije</th>
                    <th>Ulica i kućni broj</th>
                    <th>Poštanski broj</th>
                    <th>Mjesto</th>
                    <th>Telefon</th>
                    <th>E-adresa</th>
                    <th>Datum učlanjenja</th>
                    <th>Akcija</th>
                </tr>

                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?php echo $row['ime']; ?></td>
                        <td><?php echo $row['prezime']; ?></td>
                        <td><?php echo $row['datum_rodjenja']; ?></td>
                        <td><?php echo $row['oib']; ?></td>
                        <td><?php echo $row['gender']; ?></td>
                        <td><?php echo $row['status']; ?></td>
                        <td><?php echo $row['komunikacija']; ?></td>
                        <td><?php echo $row['ulica']; ?></td>
                        <td><?php echo $row['postanski_broj']; ?></td>
                        <td><?php echo $row['mjesto']; ?></td>
                        <td><?php echo $row['telefon']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['clanstvo']; ?></td>
                        <td>
                            <a href='uredi_clana.php?id=<?php echo $row['id']; ?>'>Promjena</a>
                            <?php if ($_SESSION['role'] === 'Admin'): ?>
                                <br>
                                <a href='obrisi.php?id=<?php echo $row['id']; ?>'>Izbriši</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </table>
        <?php else: ?>
            <!-- Ispis poruke kada nema rezultata -->
            <p>Nema rezultata pretrage za zadani kriterij.</p>
        <?php endif; ?>
    <?php endif; ?>
</main>

</body>
</html>
