<?php

$this->layout('template', [
        'title'   => 'Connexion',
        'message' => $message ?? null,
]);
?>

<section class="page page-form">
    <h1>Connexion</h1>

    <div class="card">
        <form action="index.php?action=login" method="post" class="form-grid">
            <div class="form-row">
                <label for="username">Nom d'utilisateur</label>
                <input type="text" id="username" name="username" required>
            </div>

            <div class="form-row">
                <label for="password">Mot de passe</label>
                <input type="password" id="password" name="password" required>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Se connecter</button>
                <a href="index.php" class="btn btn-secondary">Annuler</a>
            </div>
        </form>
    </div>
</section>
