<?php
    /**
     * @var $this CI_Loader
     */
    $this->Header(['assets' => ['dialogs', 'spin', 'jvalidator', 'priceformat']]);
?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <?= page_title(['ob'=>$this,'class' => 'fa fa-bus', 'text' => 'Crear gasto de transporte']) ?>
</section>
<!-- Main content -->
<div class="container">

    <?= form_open('informe/gastostransporte', ['class' => 'form-horizontal col-md-7', 'style' => 'margin-left: 15%']) ?>
    <hr style="border: 1px solid #099a5b;"/>
    <br>
    <div class="filas">
    </div>
    <div class="form-group">
        <div class="col-lg-offset-5 col-lg-10">
            <button id="add" type="button" class="btn btn-success btn-lg" data-toggle="tooltip"
                    title="Agregar un gasto"><span
                    class="glyphicon glyphicon-plus"></span>
            </button>
        </div>
    </div>
    <br><br>

    <?= br(2) ?>
    <?= input_submit(['class' => 'col-lg-offset-4 col-lg-10']) ?>

</div>

<?= call_spin_div() ?>

<?= form_close() ?>

</div>
<?= $this->Footer() ?>

<script>
    $('form').jValidate();

    var rows = 1;


    $('#add').click(function () {
        if (rows <= 15)
            fields();
        $('.filas > div').last().hide().show(500);
    });
    function fields() {
        $('.filas').append('<div><div style="text-align:left;font-size: 14pt; color: #939695;">Gasto #' + (rows++) + '</div>' +
            '<div style="text-align: center;"><span onclick="Eliminar(this)" data-toggle="tooltip" title="Eliminar campo" class="ion ion-android-delete" style="font-size: 25pt;font-weight: bold; color:  #e54040;cursor: pointer;"></span></div><br>' +
            '<div class="form-group"> <label  class="col-lg-3 control-label">Fecha:</label> <div class="col-lg-4"> <input type="date" placeholder="Ingrese la fecha"  class="form-control obligatorio" name="FECHA_GASTO[]" required/> </div> </div>' +
            '<div class="form-group"> <label  class="col-lg-3 control-label">Lugar:</label> <div class="col-lg-9"> <textarea  name="LUGAR[]" class="form-control obligatorio"  placeholder="Ingrese el lugar"></textarea> </div> </div>' +
            '<div class="form-group"> <label  class="col-lg-3 control-label">Actividad:</label> <div class="col-lg-9"> <textarea class="form-control obligatorio" name="ACTIVIDAD[]"  placeholder="Ingrese la actividad"></textarea> </div> </div>' +
            '<div class="form-group"> <label  class="col-lg-3 control-label">Desplazamientos:</label> <div class="col-lg-9"> <input type="text" class="form-control obligatorio numero " name="NUMERO_DESPLAZAMIENTOS[]" placeholder="Ingrese el número de desplazamientos"> </div> </div>' +
            '<div class="form-group"> <label  class="col-lg-3 control-label">Valor unitario:</label> <div class="col-lg-9"> <input type="text" class="form-control numero dinero obligatorio" name="VALOR_UNITARIO[]" placeholder="Ingrese el valor unitario"> </div> </div>' +
            '<br></div>');
    }

    function Eliminar(obj) {
        $(obj).parent().parent().hide(500, function () {
            $(obj).parent().parent().remove();
            rows--;
            $('.filas div  div:nth-child(1)').each(function (index, element) {
                $(element).text('Fila #' + (index + 1));
            });
        });
    }

    (new Spinner({
        lines: 10, width: 4,
        radius: 6, color: '#000', speed: 1, length: 15, top: '10%'
    })).spin(document.getElementById("spin"));

    function Save() {
        console.log('pas');
        if($('form').serialize()!='') {
            $.ajax({
                type: 'post', url: '<?=site_url('informe/creargastostransporte')?>', data: $('form').serialize(),
                beforeSend: function () {
                    $('body').addClass('Wait');
                    $('body,html').animate({scrollTop: 0}, 200);
                    $('#spin').show();
                },
                success: function (data) {
                    $('body').removeClass('Wait');
                    Alerta('La lista de gastos de transporte se ha creado correctamente', function (dialogItself) {
                        dialogItself.close();
                        window.open('<?=site_url('informe/imprimirgastostransporte')?>/' + data);
                    });
                    $('#spin').hide();
                }
            });
        }
        else Message('Debe agregar al menos un gasto de transporte');
    }
</script>