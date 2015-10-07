<?php
    /**
     * @var $this CI_Loader
     */
    $this->Header(['assets' => ['datatables', 'dialogs']]);
?>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 style="text-align: center;color: #099a5b;"><span style="font-size: 25pt;"
                                                                         class="ios ion-android-list"></span>&nbsp;
                        Listado <?= Uncamelize(pathinfo(__FILE__)['filename']) ?></h3>
                </div>
                <div class="box-body">
                    <?= Component::Table(['columns' => ['Fecha de creación'], 'tableName' => 'informemensual', 'autoNumeric' => true, 'id' => 'CONSECUTIVO','controller'=>'informe',
                        'fields' => ['FECHA_REGISTRO'=>'moment'],
                        'dataProvider' => $this->informes_model->TraeTodoInformeMensuales(), 'actions' =>'pd']) ?>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
</section>

<?= $this->Footer() ?>


<script type="text/javascript">
    $(function () {
        $("#tabla").dataTable();

        $('body').on('click', 'a[data-id]', function () {
            Alert($(this).data('id'), '<?=site_url('informe/eliminarinformemensual') ?>');
        });

        function Alert(id, url) {
            BootstrapDialog.show({
                title: '<span class="ion ion-android-delete" style="font-size: 20pt;font-weight: bold; color: white;"></span>&nbsp;&nbsp;&nbsp; <span  style="font-size: 18pt;">Atención!</span>',
                type: BootstrapDialog.TYPE_DANGER,
                draggable: true,
                message: 'Está seguro que desea eliminar este registro?</span>',
                buttons: [{
                    label: 'Aceptar',
                    cssClass: 'btn-danger',
                    action: function () {
                        $.post(url, {Id: id}, function () {
                            location.href = '';
                        });
                    }
                },
                    {
                        label: 'Cancelar',
                        action: function (dialogItself) {
                            dialogItself.close();
                        }
                    }]
            });
        }
    });
</script>