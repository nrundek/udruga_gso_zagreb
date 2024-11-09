<?php

// Preuzimanje podataka iz forme
$vrsta = $_POST["vrsta"];
$ime = $_POST["ime"];
$prezime = $_POST["prezime"];
$datum_rodjenja = $_POST["datum_rodjenja"];
$oib = $_POST["oib"];
$gender = $_POST["gender"];
$status = $_POST["status"];
$komunikacija = $_POST["komunikacija"];
$ulica = $_POST["ulica"];
$postanski_broj = $_POST["postanski_broj"];
$mjesto = $_POST["mjesto"];
$telefon = $_POST["telefon"];
$email = $_POST["email"];
$clanstvo = $_POST["clanstvo"];

// Validacija e-maila
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("Neispravan format email adrese.");
}

// Postavljanje parametara za povezivanje s bazom podataka
$host = "localhost";
$dbname = "ugso_zg";
$username = "root";
$password = "";

// Povezivanje s bazom podataka
$conn = mysqli_connect($host, $username, $password, $dbname);

if (mysqli_connect_errno()) {
    die("Connection error: " . mysqli_connect_error());
}

// Priprema SQL upita
$sql = "INSERT INTO up_clanovi (vrsta, ime, prezime, datum_rodjenja, oib, gender, status, komunikacija, ulica, postanski_broj, mjesto, telefon, email, clanstvo)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = mysqli_stmt_init($conn);

if (!mysqli_stmt_prepare($stmt, $sql)) {
    die("SQL priprema greška: " . mysqli_error($conn));
}

// Povezivanje parametara i njihovih vrijednosti
mysqli_stmt_bind_param($stmt, "ssssssssssssss", 
    $vrsta,
    $ime,
    $prezime,
    $datum_rodjenja,
    $oib,
    $gender,
    $status,
    $komunikacija,
    $ulica,
    $postanski_broj,
    $mjesto,
    $telefon,
    $email,
    $clanstvo
);

// Izvršavanje SQL upita
if (mysqli_stmt_execute($stmt)) {
    echo "Pohranjeno!";
    header("Location: prikazclanova.php");
    exit();
} else {
    die("Greška prilikom pohrane: " . mysqli_error($conn));
}

// Zatvaranje pripremljene izjave i veze
mysqli_stmt_close($stmt);
mysqli_close($conn);
?>

