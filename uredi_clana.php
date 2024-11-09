<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Uređivanje podataka člana</title>
    <link rel="stylesheet" href="rundekstil.css">
<script>
        function formatDate(inputDate) {
            const date = new Date(inputDate);
            const day = String(date.getDate()).padStart(2, '0');
            const month = String(date.getMonth() + 1).padStart(2, '0');
            const year = date.getFullYear();
            return `${day}.${month}.${year}`; // Format: dan.mjesec.godina
        }

        function displayFormattedDate(inputId, displayId) {
            const dateInput = document.getElementById(inputId).value;
            const formattedDate = formatDate(dateInput);
            document.getElementById(displayId).textContent = formattedDate;
        }
    </script>
</head>
<body>

<?php
include 'header.php';
include 'navigacija.php';
include 'povezivanje.php';

// Dohvaćanje ID-a člana iz URL-a
$clan_id = $_GET['id'];
$query = "SELECT * FROM up_clanovi WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $clan_id);
$stmt->execute();
$result = $stmt->get_result();
$id = $result->fetch_assoc();
?>

<nav>
<a href="index.php">Naslovnica</a>
<a href="prikazclanova.php">Prikaži Članove</a>
</nav>

<main>
    <h2>Uredi podatke člana</h2>
    <form action="spremi_izmjene.php" method="POST">
    <input type="hidden" name="id" value="<?php echo $clan_id; ?>">
        <table>
    <tr>
        <td><label for="vrsta">Vrsta članstva</label></td>
        <td>
            <label><input type="radio" name="vrsta" value="nominalni" <?php if($id['vrsta'] == 'nominalni') echo 'checked'; ?>> nominalni član</label><br>
            <label><input type="radio" name="vrsta" value="redovni" <?php if($id['vrsta'] == 'redovni') echo 'checked'; ?>> redovni član</label><br>
            <label><input type="radio" name="vrsta" value="pocasni" <?php if($id['vrsta'] == 'pocasni') echo 'checked'; ?>> počasni član</label>
        </td>
    </tr>
    <tr>
        <td><label for="ime">Ime:</label></td>
        <td><input type="text" id="ime" name="ime" value="<?php echo $id['ime']; ?>"></td>
    </tr>
    <tr>
        <td><label for="prezime">Prezime:</label></td>
        <td><input type="text" id="prezime" name="prezime" value="<?php echo $id['prezime']; ?>"></td>
    </tr>
    <tr>
        <td><label for="datum_rodjenja">Datum rođenja:</label></td>
        <td>
            <input type="date" id="datum_rodjenja" name="datum_rodjenja" onchange="displayFormattedDate('datum_rodjenja', 'formattedDateDisplay1')" value="<?php echo $id['datum_rodjenja']; ?>" required>
            <span id="formattedDateDisplay1"></span>
        </td>
    </tr>
    <tr>
        <td><label for="oib">OIB</label></td>
        <td><input type="number" id="oib" name="oib" value="<?php echo $id['oib']; ?>"></td>
    </tr>
    <tr>
        <td><label for="gender">Spol:</label></td>
        <td>
            <select id="gender" name="gender">
                <option value="">Odaberite</option>
                <option value="M" <?php if($id['gender'] == 'M') echo 'selected'; ?>>Muško</option>
                <option value="Ž" <?php if($id['gender'] == 'Ž') echo 'selected'; ?>>Žensko</option>
            </select>
        </td>
    </tr>
    <tr>
        <td><label for="status">Status:</label></td>
        <td>
            <select id="status" name="status">
                <option value="">Odaberite</option>
                <option value="slabovidnost i gluhoća" <?php if($id['status'] == 'slabovidnost i gluhoća') echo 'selected'; ?>>slabovidnost i gluhoća</option>
                <option value="slabovidnost i nagluhost" <?php if($id['status'] == 'slabovidnost i nagluhost') echo 'selected'; ?>>slabovidnost i nagluhost</option>
                <option value="sljepoća i nagluhost" <?php if($id['status'] == 'sljepoća i nagluhost') echo 'selected'; ?>>sljepoća i nagluhost</option>
                <option value="praktična gluhosljepoća" <?php if($id['status'] == 'praktična gluhosljepoća') echo 'selected'; ?>>praktična gluhosljepoća</option>
            </select>
        </td>
    </tr>
    <tr>
        <td><label for="komunikacija">Vrsta komunikacije:</label></td>
        <td><textarea id="komunikacija" name="komunikacija" rows="4" cols="50"><?php echo $id['komunikacija']; ?></textarea></td>
    </tr>
    <tr>
        <td><label for="ulica">Ulica i kućni broj:</label></td>
        <td><input type="text" id="ulica" name="ulica" value="<?php echo $id['ulica']; ?>"></td>
    </tr>
    <tr>
        <td><label for="postanski_broj">Poštanski broj:</label></td>
        <td><input type="number" id="postanski_broj" name="postanski_broj" value="<?php echo $id['postanski_broj']; ?>"></td>
    </tr>
    <tr>
        <td><label for="mjesto">Mjesto:</label></td>
        <td><input type="text" id="mjesto" name="mjesto" value="<?php echo $id['mjesto']; ?>"></td>
    </tr>
    <tr>
        <td><label for="telefon">Telefon:</label></td>
        <td><input type="tel" id="telefon" name="telefon" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" placeholder="091-123-4567" value="<?php echo $id['telefon']; ?>"></td>
    </tr>
    <tr>
        <td><label for="email">E-adresa</label></td>
        <td><input type="email" id="email" name="email" value="<?php echo $id['email']; ?>"></td>
    </tr>
    <tr>
        <td><label for="clanstvo">Datum učlanjenja:</label></td>
        <td>
            <input type="date" id="clanstvo" name="clanstvo" onchange="displayFormattedDate('clanstvo', 'formattedDateDisplay2')" value="<?php echo $id['clanstvo']; ?>" required>
            <span id="formattedDateDisplay2"></span>
        </td>
    </tr>
    <tr>
        <td colspan="2"><input type="submit" value="Ažuriraj"></td>
    </tr>
</table>
</form>
</main>
</body>
</html>

