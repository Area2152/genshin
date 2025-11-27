<?php

use Models\Personnage;


$this->layout('template', [
        'title'   => 'Collection Genshin Impact',
        'message' => $message ?? null,
]);
?>

<h2>Collection <?= $this->e($gameName) ?></h2>

<div class="cards">
    <?php foreach ($listPersonnage as $p): ?>
        <article class="card">
            <div class="card-image">
                <img src="<?= $this->e($p->getUrlImg()) ?>"
                     alt="<?= $this->e($p->getName()) ?>">
            </div>

            <div class="card-body">
                <h3 class="card-title"><?= $this->e($p->getName()) ?></h3>

                <p class="card-meta">
                    <?php if ($p->getElement()): ?>
                        <span class="tag element">
                            <?= $this->e($p->getElement()->getName()) ?>
                        </span>
                    <?php endif; ?>

                    <?php if ($p->getUnitclass()): ?>
                        <span class="tag unitclass">
                            <?= $this->e($p->getUnitclass()->getName()) ?>
                        </span>
                    <?php endif; ?>

                    <span class="tag rarity">
                        <?= str_repeat('★', $p->getRarity()) ?>
                    </span>
                </p>

                <?php if ($p->getOrigin()): ?>
                    <p class="card-origin">
                        <?= $this->e($p->getOrigin()->getName()) ?>
                    </p>
                <?php endif; ?>
            </div>

            <div class="card-actions">
                <a href="index.php?action=edit-perso&idPerso=<?= urlencode($p->getId()) ?>"
                   class="btn btn-edit" title="Modifier">✏️</a>
                <a href="index.php?action=del-perso&idPerso=<?= urlencode($p->getId()) ?>"
                   class="btn btn-delete" title="Supprimer">🗑️</a>
            </div>
        </article>
    <?php endforeach; ?>
</div>
