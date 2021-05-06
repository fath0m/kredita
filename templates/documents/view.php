<?php $this->layout('shared/layout', ['title' => $this->e($document["name"])]) ?>

<h2>
    <?= $this->e($document["name"]) ?>
</h2>

<hr />

<img src="<?= str_replace("\\", "/", $document["path"]) ?>" class="img-fluid" />

