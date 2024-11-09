<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Obrazac za unos članova</title>
    <link rel="stylesheet" href="rundekstil.css">
    <script>
        function formatDate(inputDate) {
            const date = new Date(inputDate);
            const day = String(date.getDate()).padStart(2, '0');
            const month = String(date.getMonth() + 1).padStart(2, '0');
            const year = date.getFullYear();
            return `${day}.${month}.${year}`; // Format: dan.mjesec.godina
        }

        function displayFormattedDate(inputId, displayId, iconId) {
            const dateInput = document.getElementById(inputId).value;
            const formattedDate = formatDate(dateInput);
            document.getElementById(displayId).textContent = formattedDate;
            document.getElementById(iconId).style.display = "inline"; // Prikaz ikone
        }
    </script>
    <style>
        .valid-icon {
            display: none;
            color: green;
            font-size: 1.2em;
            margin-left: 5px;
        }
    </style>
</head>
<body>
<?php include 'header.php'; ?>
<?php include 'navigacija.php'; ?>

<main>
    <h2>Unos novog člana</h2>
    <p>Sva su polja obavezna.</p>
    <form action="spremi_clanove.php" method="POST">
        <table>
            <tr>
                <td><label for="vrsta">Vrsta članstva</label></td>
                <td>
                    <label><input type="radio" name="vrsta" value="nominalni" required> nominalni član</label>
                    <label><input type="radio" name="vrsta" value="redovni" required> redovni član</label>
                </td>
            </tr>
            <tr>
                <td><label for="ime">Ime:</label></td>
                <td><input type="text" id="ime" name="ime" required></td>
            </tr>
            <tr>
                <td><label for="prezime">Prezime:</label></td>
                <td><input type="text" id="prezime" name="prezime" required></td>
            </tr>
            <tr>
                <td><label for="datum_rodjenja">Datum rođenja:</label></td>
                <td>
                    <input type="date" id="datum_rodjenja" name="datum_rodjenja" placeholder="dd.mm.gggg" onchange="displayFormattedDate('datum_rodjenja', 'formattedDateDisplay1', 'icon1')" required>
                    <span id="formattedDateDisplay1"></span>
                    <span id="icon1" class="valid-icon">✔️</span>
                </td>
            </tr>
            <tr>
                <td><label for="oib">OIB:</label></td>
                <td><input type="number" id="oib" name="oib" placeholder="12345678901" required></td>
            </tr>
            <tr>
                <td><label for="gender">Spol:</label></td>
                <td>
                    <select id="gender" name="gender" required>
                        <option value="">Odaberite</option>
                        <option value="M">Muško</option>
                        <option value="Ž">Žensko</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td><label for="status">Status:</label></td>
                <td>
                    <select id="status" name="status" required>
                        <option value="">Odaberite</option>
                        <option value="slabovidnost i gluhoća">slabovidnost i gluhoća</option>
                        <option value="slabovidnost i nagluhost">slabovidnost i nagluhost</option>
                        <option value="sljepoća i nagluhost">sljepoća i nagluhost</option>
                        <option value="praktična gluhosljepoća">praktična gluhosljepoća</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td><label for="komunikacija">Vrsta komunikacije:</label></td>
                <td><textarea id="komunikacija" name="komunikacija" rows="4" cols="50" required></textarea></td>
            </tr>
            <tr>
                <td><label for="ulica">Ulica i kućni broj:</label></td>
                <td><input type="text" id="ulica" name="ulica" required></td>
            </tr>
            <tr>
                <td><label for="postanski_broj">Poštanski broj:</label></td>
                <td><input type="number" id="postanski_broj" name="postanski_broj" required></td>
            </tr>
            <tr>
                <td><label for="mjesto">Mjesto:</label></td>
                <td><input type="text" id="mjesto" name="mjesto" required></td>
            </tr>
            <tr>
                <td><label for="telefon">Telefon:</label></td>
                <td><input type="tel" id="telefon" name="telefon" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" placeholder="091-123-4567" required></td>
            </tr>
            <tr>
                <td><label for="email">E-adresa:</label></td>
                <td><input type="email" id="email" name="email" required></td>
            </tr>
            <tr>
                <td><label for="clanstvo">Datum učlanjenja:</label></td>
                <td>
                    <input type="date" id="clanstvo" name="clanstvo" placeholder="dd.mm.gggg" onchange="displayFormattedDate('clanstvo', 'formattedDateDisplay2', 'icon2')" required>
                    <span id="formattedDateDisplay2"></span>
                    <span id="icon2" class="valid-icon">✔️</span>
                </td>
            </tr>
        </table>
        <br>
        <input type="submit" value="Spremi">
    </form>
</main>
</body>
</html>
