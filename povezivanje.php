<?php
$servername = "localhost";
$username = "root"; // Korisničko ime za bazu podataka
$password = "";     // Lozinka za bazu podataka
$dbname = "ugso_zg"; // Ime baze podataka

// Stvaranje veze
$conn = new mysqli($servername, $username, $password, $dbname);

// Provjera veze
if ($conn->connect_error) {
    die("Neuspješno povezivanje: " . $conn->connect_error);
}
?>
