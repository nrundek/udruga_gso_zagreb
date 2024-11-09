<?php
$host = "localhost";
$dbname = "ugso_zg";
$username = "root";
$password = "";

// Spoji se na bazu podataka
$conn = mysqli_connect($host, $username, $password, $dbname);

if (mysqli_connect_errno()) {
    die("Connection error: " . mysqli_connect_error());
}

// Izvrši SQL upit za dohvaćanje podataka
$sql = "SELECT * FROM up_clanovi";
$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Query error: " . mysqli_error($conn));
}

// Broj članova
$brojClanova = mysqli_num_rows($result);
?>
<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <title>Popis članova</title>
    <link rel="stylesheet" href="rundekstil.css">
    <script>
        function ispisiClanove() {
            var printContents = document.getElementById("clanovi").innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = "<h2>Popis članova</h2>" + printContents + "<p>Ukupno članova: " + <?php echo $brojClanova; ?> + "</p>";
            window.print();
            document.body.innerHTML = originalContents;
        }
    </script>
</head>
<body>
<?php include 'header.php'; ?>
<?php include 'navigacija.php'; ?>
<main>
    <h2>Popis članova</h2>
    <p>Broj članova: <span id="brojClanova"><?php echo $brojClanova; ?></span></p>
    <div id="clanovi">
        <table>
            <tr>
                <th>Vrsta članstva</th>
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
            </tr>

            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['vrsta']); ?></td>
                    <td><?php echo htmlspecialchars($row['ime']); ?></td>
                    <td><?php echo htmlspecialchars($row['prezime']); ?></td>
                    <td><?php 
                        $datumRodjenja = DateTime::createFromFormat('Y-m-d', $row['datum_rodjenja']);
                        echo htmlspecialchars($datumRodjenja->format('d. m. Y.')); 
                    ?></td>
                    <td><?php echo htmlspecialchars($row['oib']); ?></td>
                    <td><?php echo htmlspecialchars($row['gender']); ?></td>
                    <td><?php echo htmlspecialchars($row['status']); ?></td>
                    <td><?php echo htmlspecialchars($row['komunikacija']); ?></td>
                    <td><?php echo htmlspecialchars($row['ulica']); ?></td>
                    <td><?php echo htmlspecialchars($row['postanski_broj']); ?></td>
                    <td><?php echo htmlspecialchars($row['mjesto']); ?></td>
                    <td><?php echo htmlspecialchars($row['telefon']); ?></td>
                    <td><?php echo htmlspecialchars($row['email']); ?></td>
                    <td><?php 
                        $datumClanstva = DateTime::createFromFormat('Y-m-d', $row['clanstvo']);
                        echo htmlspecialchars($datumClanstva->format('d. m. Y.')); 
                    ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
    </div>
    <a href="download_csv.php" class="download-button">Preuzmi popis članova (CSV)</a>
    <button onclick="ispisiClanove()" class="print-button">Ispis popisa članova</button>
</main>
<?php
mysqli_close($conn);
?>
</body>
</html>
