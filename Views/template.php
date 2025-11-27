<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="public/css/main.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $this->e($title ?? 'TP Mihoyo') ?></title>
</head>
<body>
<header>
    <h1>Collection Mihoyo</h1>

    <nav>
        <a href="index.php">Accueil</a>
        <a href="index.php?action=add-perso">Ajouter un perso</a>
        <a href="index.php?action=add-perso-element">Ajouter un élément</a>
        <a href="index.php?action=logs">Logs</a>
        <a href="index.php?action=protected">Page protégée</a>
        <?php if (isset($_SESSION['userUID'])): ?>
            <a href="index.php?action=logout">
                Se déconnecter (<?= htmlspecialchars($_SESSION['username'] ?? '', ENT_QUOTES, 'UTF-8') ?>)
            </a>
        <?php else: ?>
            <a href="index.php?action=login">Login</a>
        <?php endif; ?>
    </nav>
</header>

<main id="contenu">
    <?php if (isset($message) && !empty($message)): ?>
        <?= $this->insert('message', ['message' => $message]) ?>
    <?php endif; ?>

    <?= $this->section('content') ?>
</main>

<footer>
    <p>&copy; <?= date('Y') ?> - TP Mihoyo</p>
</footer>
</body>
</html>
