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
                                                                         class="fa fa-table"></span>&nbsp;
                        Listado <?= pathinfo(__FILE__)['filename'] ?></h3>
                </div>
                <div class="box-body">
                    <?= Component::Table(['columns' => ['Nombre de la agencia', 'Dirección', 'Teléfono#1',],
                        'tableName' => 'agencia', 'autoNumeric' => true, 'id' => 'ID_AGENCIA', 'controller' => 'agencias',
                        'fields' => ['NOMBRE_AGENCIA', 'DIRECCION', 'TELEFONO1' => 'phone',]
                        , 'dataProvider' => $this->agencias_model->TraeAgencias(), 'actions' => 'duv']) ?>
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
    $(function ()
    {
        $("#tabla").dataTable();

        $('body').on('click', 'a[data-id]', function ()
        {
            Alert($(this).data('id'), '<?=site_url('agencias/eliminaragencia') ?>');
        });

        function Alert(id, url)
        {
            BootstrapDialog.show({
                title: '<span class="ion ion-android-delete" style="font-size: 20pt;font-weight: bold; color: white;"></span>&nbsp;&nbsp;&nbsp; <span  style="font-size: 18pt;">Atención!</span>',
                type: BootstrapDialog.TYPE_DANGER,
                draggable: true,
                message: '¿Está seguro que desea eliminar este registro?',
                buttons: [{
                    label: 'Aceptar',
                    cssClass: 'btn-danger',
                    action: function ()
                    {
                        $.ajax({
                            type: 'post', url: url, data: {Id: id},
                            success: function ()
                            {
                                location.href = '';
                            },
                            error: function (a)
                            {
                                if (a.status == 500)
                                {
                                    $(".bootstrap-dialog-message").html('<br> <span style="color: #8c4646"><b>&nbsp;No se puede eliminar este registro! </b>Asegurese de que no esté siendo utilizado en otros módulos del sistema.</span>')
                                }
                            }
                        });
                    }
                },
                    {
                        label: 'Cancelar',
                        action: function (dialogItself)
                        {
                            dialogItself.close();
                        }
                    }]
            });
        }
    });
</script>