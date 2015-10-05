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
                    <h3 style="text-align: center;color: #3D8EBC;"><span style="font-size: 25pt;"
                                                                         class="ios ion-android-list"></span>&nbsp;
                        Listado Asesores</h3>
                </div>
                <div class="box-body">
                    <?= Component::Table(['columns' => ['', 'Nombre','Practicantes', 'Correo',], 'tableName' => 'asesor', 'autoNumeric' => true, 'id' => 'ID_USUARIO',
                        'fields' => ['FOTO' => ['type' => 'img', 'path' => base_url('asesorfotos')], 'NOMBRE', 'PRACTICANTES','CORREO'],
                        'dataProvider' => $this->usuarios_model->TraeAsesores(), 'actions' => 'duv']) ?>
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
            Alert($(this + '[data-id]').data('id'), '<?=site_url('usuario/EliminarAsesor') ?>');
        });

        function Alert(id, url) {
            BootstrapDialog.show({
                title: '<span class="ion ion-android-delete" style="font-size: 20pt;font-weight: bold; color: white;"></span>&nbsp;&nbsp;&nbsp; <span  style="font-size: 18pt;">Atención!</span>',
                type: BootstrapDialog.TYPE_DANGER,
                draggable: true,
                message: 'Está seguro que desea eliminar este ' + $('#tabla').data('name') + '?</span>',
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