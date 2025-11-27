<?php

$this->layout('template', ['title' => 'Logs']);
?>

<section class="page logs-page">
    <h1>Journal des actions</h1>

    <?php if (!empty($logFiles)) : ?>
        <form method="get" class="card logs-form">
            <input type="hidden" name="action" value="logs">

            <label for="logFile">Choisir un fichier de log :</label>
            <select id="logFile" name="file" onchange="this.form.submit()">
                <?php foreach ($logFiles as $file): ?>
                    <option value="<?= $this->e($file) ?>"
                            <?= $file === $selectedLog ? 'selected' : '' ?>>
                        <?= $this->e($file) ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <noscript>
                <button type="submit" class="btn btn-primary">Afficher</button>
            </noscript>
        </form>

        <div class="card logs-content">
            <?php if ($logContent !== null && $logContent !== ''): ?>
                <pre><?= $this->e($logContent) ?></pre>
            <?php else: ?>
                <p>Aucune entrée dans ce fichier de log.</p>
            <?php endif; ?>
        </div>
    <?php else: ?>
        <p>Aucun fichier de log pour le moment.</p>
    <?php endif; ?>
</section>
