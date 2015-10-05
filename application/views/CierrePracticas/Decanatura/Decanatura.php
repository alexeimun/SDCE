<?php
    /**
     * @var $this CI_Loader
     */
    $this->Header(['assets' => ['datatables', 'icheck', 'excelexport']]);

?>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 style="text-align: center;color: #099a5b;"><span style="font-size: 25pt;"
                                                                         class="ios ion-android-list"></span>&nbsp;Cierre Decanatura</h3>
                </div>
                <?= input_submit(['class' => 'col-lg-offset-5 col-sm-offset-5 col-lg-2', 'icon' => 'export', 'text' => 'Exportar']) ?>

                <div class="box-body">
                    <?= TablaCierre(['columns' => ['Nombre del estudiante', 'Agencia', 'Tema', 'Registro de asesoría'],
                        'tableName' => 'practicante', 'id' => 'ID_PRACTICANTE','autoNumeric'=>true,
                        'fields' => ['NOMBRE_PRACTICANTE', 'NOMBRE_AGENCIA', 'NOMBRE_PROYECTO', 'CHECKBOX'], 'dataProvider' => $this->practicantes_model->TraePracticantes()]) ?>
                </div>
                <div id="table" style="display: none;">
                    <table id="temp">

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
    $('input:checkbox').iCheck({
        checkboxClass: 'iradio_square-green',
        increaseArea: '90%' // optional
    });
    $(function () {
        $("#tabla").dataTable();

        $(':button').on('click', function () {
            ArmarTabla();
        });

        function ArmarTabla() {
            var nombre = 'Cierra prácticas - Decanatura <?=date('d-m-Y') ?>';
            Pulir([5]);
            $("#t").battatech_excelexport({
                containerid: "tabla", datatype: 'table', worksheetName: nombre
            });
            location.href='';
        }
    });

    function Pulir(cols) {
        $('#tabla').css({fontSize:'12pt'});
        $('#tabla thead th').css({background:'#5082BD',color:'white'});
        $('#tabla thead th').each(function (i,el) {
            $(el).text($(el).text().toUpperCase());
        });
        $('#tabla tbody tr').each(function (index, ele) {
            ele = $(ele);
            $.each(cols, function (index, e) {
                var check = ele.find('td:nth-of-type(' + e + ') input');
                if (check.prop('checked')) {
                    check.parent().parent().html('<b>X</b>');
                    check.parent().remove();
                }
                else {
                    check.parent().parent().html('<b>N/A</b>');
                    check.parent().remove();
                }
            });
        });
    }

</script>