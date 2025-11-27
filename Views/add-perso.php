<?php

use Models\Personnage;
use Models\Element;
use Models\Origin;
use Models\Unitclass;

$this->layout('template', [
        'title'   => $isEdit ? 'Modifier un personnage' : 'Ajouter un personnage',
        'message' => $message ?? null
]);

$currentElementId   = $isEdit && $perso && $perso->getElement()   ? $perso->getElement()->getId()   : null;
$currentOriginId    = $isEdit && $perso && $perso->getOrigin()    ? $perso->getOrigin()->getId()    : null;
$currentUnitclassId = $isEdit && $perso && $perso->getUnitclass() ? $perso->getUnitclass()->getId() : null;
?>

<h2><?= $isEdit ? 'Modifier un personnage' : 'Ajouter un personnage' ?></h2>

<div class="form-card">
    <form action="index.php?action=<?= $isEdit ? 'edit-perso' : 'add-perso' ?>" method="post">

        <?php if ($isEdit && $perso): ?>
            <input type="hidden" name="idPerso" value="<?= $this->e($perso->getId()) ?>">
        <?php endif; ?>

        <div class="form-field">
            <label for="perso-nom">Nom</label>
            <input type="text" id="perso-nom" name="perso-nom"
                   value="<?= $isEdit && $perso ? $this->e($perso->getName()) : '' ?>" required>
        </div>

        <div class="form-field">
            <label for="perso-element">Élément</label>
            <select id="perso-element" name="perso-element" required>
                <?php foreach ($elements as $el): ?>
                    <option value="<?= $el->getId() ?>"
                            <?= $currentElementId === $el->getId() ? 'selected' : '' ?>>
                        <?= $this->e($el->getName()) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-field">
            <label for="perso-classe">Classe / Arme</label>
            <select id="perso-classe" name="perso-classe" required>
                <?php foreach ($unitclasses as $uc): ?>
                    <option value="<?= $uc->getId() ?>"
                            <?= $currentUnitclassId === $uc->getId() ? 'selected' : '' ?>>
                        <?= $this->e($uc->getName()) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-field">
            <label for="perso-origin">Origine (optionnel)</label>
            <select id="perso-origin" name="perso-origin">
                <option value="">-- Aucune --</option>
                <?php foreach ($origins as $or): ?>
                    <option value="<?= $or->getId() ?>"
                            <?= $currentOriginId === $or->getId() ? 'selected' : '' ?>>
                        <?= $this->e($or->getName()) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-field">
            <label for="perso-rarity">Rareté (nombre d'étoiles)</label>
            <input type="number" id="perso-rarity" name="perso-rarity"
                   min="1" max="5"
                   value="<?= $isEdit && $perso ? $perso->getRarity() : 5 ?>" required>
        </div>

        <div class="form-field">
            <label for="perso-url-img">URL de l'image</label>
            <input type="url" id="perso-url-img" name="perso-url-img"
                   placeholder="https://..."
                   value="<?= $isEdit && $perso ? $this->e($perso->getUrlImg()) : '' ?>" required>
        </div>

        <button type="submit" class="btn btn-edit">
            <?= $isEdit ? 'Mettre à jour le personnage' : 'Créer le personnage' ?>
        </button>
    </form>
</div>
