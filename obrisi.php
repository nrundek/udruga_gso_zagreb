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

// Dohvati ID člana iz URL-a
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    // Pripremi SQL upit za brisanje člana iz tablice
    $stmt = mysqli_prepare($conn, "DELETE FROM up_clanovi WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    $result = mysqli_stmt_execute($stmt);

    if ($result) {
        echo "Podaci o članu su uspješno obrisani.";
        // Preusmjeri na stranicu za prikaz članova
        header("Location: prikazclanova.php");
        exit();
    } else {
        echo "Greška prilikom brisanja podataka o članu: " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
} else {
    echo "Nije pružen ispravan ID člana.";
}

// Zatvori vezu s bazom podataka
mysqli_close($conn);
?>
