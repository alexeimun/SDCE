<?php
    /**
     * @var $this CI_Loader
     */
    $this->Header(['assets' => ['datatables', 'dialogs', 'excelexport']]);
    $color = $this->session->userdata('ASESOR') ? '#099a5b' : '#3D8EBC';
?>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 style="text-align: center;color: <?= $color ?>;"><span style="font-size: 25pt;"
                                                                               class="fa fa-table"></span>&nbsp;
                        Listado Practicantes</h3>
                </div>
                <?= input_submit(['class' => 'col-lg-offset-5 col-sm-offset-5 col-lg-2 exportar', 'icon' => 'export', 'text' => 'Exportar']) ?>

                <div class="box-body">
                    <?= Component::Table(['columns' => ['Nombre practicante', 'Proyecto', 'Modalidad de la práctica','Cooperador', 'Agencia','Teléfono agencia','Dirección agencia'], 'limitCell' => 120,
                        'tableName' => 'practicante', 'id' => 'ID_PRACTICANTE', 'controller' => 'practicantes',
                        'fields' => ['NOMBRE_PRACTICANTE', 'NOMBRE_PROYECTO', 'MODALIDAD','NOMBRE_COOPERADOR', 'NOMBRE_AGENCIA','TELEFONO_AGENCIA','DIRECCION_AGENCIA']
                        , 'dataProvider' => $this->session->userdata('ASESOR') ? $this->practicantes_model->TraePracticantes() : $this->practicantes_model->TraeTodoPracticantes(),
                        'actions' => $this->session->userdata('ASESOR') ? 'v' : 'duv']) ?>
                </div>
                <div id="temp" style="display: none;">
                    <table id="itable">

                    </table>
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

        $('.exportar').on('click', function ()
        {
            ArmarTabla();
        });

        function ArmarTabla()
        {
            var nombre = 'Listado practicantes';
            $('#itable').html($('#tabla').html());
            $('#itable thead tr th:nth-of-type(8)').remove();
            $('#itable tbody tr td:nth-of-type(8)').remove();
            Pulir();
            $("#t").battatech_excelexport({
                containerid: "itable", datatype: 'table', worksheetName: nombre
            });
            location.href = '';
        }

        function Pulir()
        {
            $('#tabla').css({fontSize: '15pt'});
            $('#itable thead th').css({background: '#5082BD', color: 'white'});
            $('#itable thead th').each(function (i, el)
            {
                $(el).text($(el).text().toUpperCase());
            });
        }

        $("#tabla").dataTable();

        $('body').on('click', 'a[data-id]', function ()
        {
            Alert($(this).data('id'), '<?=site_url('practicantes/eliminarpracticante') ?>');
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