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
if (isset($_POST['id']) && is_numeric($_POST['id'])) {
    $id = $_POST['id'];

    // Pripremi podatke za ažuriranje iz POST podataka (provjerite šalju li seputem POST-a)
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

    // Pripremi SQL upit za ažuriranje člana u tablici
    $stmt = mysqli_prepare($conn, "UPDATE up_clanovi SET vrsta = ?, ime = ?, prezime = ?, datum_rodjenja = ?, oib = ?, gender = ?, status = ?, komunikacija = ?, ulica = ?, postanski_broj = ?, mjesto = ?, telefon = ?, email = ?, clanstvo = ? WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "ssssssssssssssi",
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
        $clanstvo,
        $id); // Dodavanje id-a na kraj parametara

    $result = mysqli_stmt_execute($stmt);

    if ($result) {
        echo "Podatci su uspješno ažurirani.";
        // Preusmjeri na stranicu za prikaz članova
        header("Location: prikazclanova.php");
        exit();
    } else {
        echo "Greška prilikom ažuriranja podataka o članu: " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
} else {
    echo "Nije dan ispravan ID člana.";
}

// Zatvori vezu s bazom podataka
mysqli_close($conn);
?>
