<?php
// Pokreni sesiju ako nije već aktivna
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<nav>
    <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'Admin'): ?>
        <a href="admin_panel.php">Početno sučelje</a>
    <?php endif; ?>
    <a href="pretraga.php">Pretraga</a>
    <a href="unos_clanova.php">Unos Članova</a>
    <a href="prikazclanova.php">Prikaz Članova</a>
    <a href="index.php">Odjava</a>
</nav>
