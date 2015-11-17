<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Login SDCE</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <?= $this->registerAssets(['jvalidator'], true, true) ?>
</head>
<body class="login-page">
<div class="login-box">
    <div class="login-logo" style="background: #d3d3d3;opacity: .85;">
        <a href=""><span style="color:#0d9155;"><b>Asesor</b> Prácticas</span></a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body " id="contenedor" style="opacity: .95;">
        <p class="login-box-msg" style="font-size: 18pt;"><img src="../../../../public/images/logo.jpg" onclick="window.open('http://www.fumc.edu.co')" style="cursor:pointer;"
                                                               class="img-responsive"></p>

        <?= form_open('app/ValidarCredenciales', ['method' => 'post']) ?>
        <div class="form-group has-feedback">
            <input autofocus type="text" class="form-control" placeholder="Correo" name="usuario"/>
            <span class="glyphicon glyphicon-envelope form-control-feedback" style="color:#0d9155; "></span>
        </div>
        <div class="form-group has-feedback">
            <input type="password" class="form-control" placeholder="Clave" name="clave"/>
            <span class="glyphicon glyphicon-lock form-control-feedback" style="color:#0d9155;"></span>
        </div>
        <div class="row">
            <div class="col-xs-4">
                <button type="submit" class="btn btn-success btn-block btn-flat">Ingresar <i
                        class="fa fa-sign-in"></i></button>
            </div>
            <!-- /.col -->
        </div>
        <?= form_close() ?>

    </div>
    <div style="margin:10px;">
        <p class="login-box-msg"><b><i class="ion ion-leaf" style="color:#0d9155;"></i>SDCE live green! - &copy;
                2015</b></p>
    </div>
    <br>
    <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
<!-- Bootstrap 3.3.2 JS -->
<script>
    $('button:submit').click(function () {
        event.preventDefault();
        $.ajax({
            url: 'app/ValidarCredenciales', type: 'post', data: $('form').serialize() + '&nivel=0',
            success: function (data) {
                console.log(data);
                if (data == 'ok') {
                    location.href = '<?=site_url()?>';
                }
                else Message('Usuario o clave incorrectos', 'danger', 'form', 900);
            }
        });
    });
</script>
</body>
</html>