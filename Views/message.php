<?php

use Helpers\Message;

if (empty($message)) {
    return;
}

$cssClass = 'message message--info';
$title    = 'Message';
$text     = '';

if ($message instanceof Message) {
    $cssClass .= ' ' . $message->getColor();
    $title     = $message->getTitle();
    $text      = $message->getMessage();
} else {
    $text = (string)$message;
}
?>
<div class="<?= $this->e($cssClass) ?>">
    <?php if (!empty($title)): ?>
        <strong class="message-title"><?= $this->e($title) ?></strong><br>
    <?php endif; ?>
    <span class="message-text"><?= $this->e($text) ?></span>
</div>
