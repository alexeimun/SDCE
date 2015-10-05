<?php
    /**
     * @var $this CI_Loader
     */
    $this->Header(['assets' => []]);
?>
<section class="content-header">
    <h1>Tablero
        <small> Periodo académico <b><?=  date('Y-').(date('m', strtotime(date('m'))) > 6 ? 2 : 1) ?></b></small>
    </h1>
</section>
<br>
<div class="container">
    <?= $Dashboard ?>
</div>

<?= $this->Footer() ?>
