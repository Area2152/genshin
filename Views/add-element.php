<?php
$this->layout('template', [
        'title'   => 'Ajouter un élément',
        'message' => $message ?? null,
]);
?>

<section class="page page-form">
    <h1>Ajouter un élément</h1>

    <div class="card">
        <form action="index.php?action=add-perso-element" method="post" class="form-grid">
            <div class="form-row">
                <label for="attr-name">Nom</label>
                <input type="text" id="attr-name" name="attr-name" required>
            </div>

            <div class="form-row">
                <label for="attr-img">URL de l'image</label>
                <input type="url" id="attr-img" name="attr-img" required>
            </div>

            <div class="form-row">
                <label for="attr-type">Type</label>
                <select id="attr-type" name="attr-type" required>
                    <option value="">-- Choisir un type --</option>
                    <option value="element">Élément</option>
                    <option value="origin">Origine</option>
                    <option value="unitclass">Classe / Arme</option>
                </select>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Créer</button>
                <a href="index.php" class="btn btn-secondary">Retour</a>
            </div>
        </form>
    </div>
</section>
