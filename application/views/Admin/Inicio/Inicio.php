<?php
    /**
     * @var $this CI_Loader
     */
    $this->Header(['assets' => []]);
?>
<section class="content-header">
    <h1 style="color:#3D8EBC"><i class="fa fa-tachometer"></i> Tablero de control
        <small> Periodo académico <b><?=  date('Y-').(date('m', strtotime(date('m'))) > 6 ? 2 : 1) ?></b></small>
    </h1>
</section>
<br>
<div class="container">
    <?= $Dashboard ?>
</div>

<?= $this->Footer() ?>
