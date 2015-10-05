<?php
    /**
     * @var $this CI_Loader
     */
    $this->Header(['assets' => []]);
?>
<section class="content-header">
    <h1>Tablero
        <small> Periodo académico <a
                href="parametros"><b><?= date('Y-', strtotime($this->session->userdata('PERIODO'))) . (date('m', strtotime($this->session->userdata('PERIODO'))) > 6 ? 2 : 1) ?></b></a>
        </small>
    </h1>
</section>
<br>
<div class="container">
    <?= $Dashboard ?>
</div>

<?= $this->Footer() ?>
