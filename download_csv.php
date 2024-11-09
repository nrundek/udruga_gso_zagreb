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

// Postavi zaglavlje za preuzimanje CSV datoteke
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=clanovi.csv');

// Otvori "file pointer" za izlaz
$output = fopen('php://output', 'w');

// Dodaj zaglavlja stupaca u CSV
fputcsv($output, array('Vrsta članstva', 'Ime', 'Prezime', 'Datum rođenja', 'OIB', 'Spol', 'Status', 'Vrsta komunikacije', 'Ulica i kućni broj', 'Poštanski broj', 'Mjesto', 'Telefon', 'E-adresa', 'Datum učlanjenja'));

// Izvrši SQL upit za dohvaćanje podataka
$sql = "SELECT * FROM up_clanovi";
$result = mysqli_query($conn, $sql);

// Dodaj redove podataka u CSV
while ($row = mysqli_fetch_assoc($result)) {
    // Formatiraj datume
    $row['datum_rodjenja'] = DateTime::createFromFormat('Y-m-d', $row['datum_rodjenja'])->format('d. m. Y.');
    $row['clanstvo'] = DateTime::createFromFormat('Y-m-d', $row['clanstvo'])->format('d. m. Y.');
    fputcsv($output, $row);
}

// Zatvori konekciju
fclose($output);
mysqli_close($conn);
?>
