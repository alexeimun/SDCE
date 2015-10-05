<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <?= $this->registerAssets(['jvalidator'], true, true) ?>
</head>
<body class="login-page">
<div class="login-box">
    <div class="login-logo" style="background: #d3d3d3;opacity: .85;">
        <a href=""><span style="color:#0085ff;"><b>Admin</b> Prácticas</span></a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body " id="contenedor" style="opacity: .95;">
        <p class="login-box-msg" style="font-size: 18pt;"><img src="../../../../public/images/logo.jpg"
                                                               class="img-responsive"></p>

        <form method="post" action="app/ValidarCredenciales">
            <div class="form-group has-feedback">
                <input type="text" class="form-control" placeholder="Correo" name="usuario"/>
                <span class="glyphicon glyphicon-envelope form-control-feedback" style="color:#0085ff; "></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" class="form-control" placeholder="Clave" name="clave"/>
                <span class="glyphicon glyphicon-lock form-control-feedback" style="color:#0085ff;"></span>
            </div>
            <div class="row">
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Ingresar</button>
                </div>
                <!-- /.col -->
            </div>
        </form>
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
            url: 'app/ValidarCredenciales', type: 'post', data: $('form').serialize() + '&nivel=1',
            success: function (data) {
                console.log(data);
                if (data == 'ok') {
                    location.href = '<?=site_url()?>';
                }
                else  Message('Usuario o clave incorrectos', 'danger', 'form', 900);
            }
        });
    });
</script>
</body>
</html>