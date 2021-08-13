<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="Acceso a servicios EPG" />
    <meta name="author" content="" />
    <title>EPG - Login</title>

    <link href="<?php echo base_url('include/');?>css/styles.css" rel="stylesheet">
    <link href="<?php echo base_url('include/');?>css/web-init.css" rel="stylesheet">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
</head>
<body class="bg-purple">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="text-center mt-5">
                                <a href="<?=base_url('/');?>"><img  height="70" src="<?php echo base_url('include/img/logo.png');?>" alt="Plataforma EPG"></a>
                            </div>

                            <div class="card shadow-lg border-0 rounded-lg mt-5 ">
                                <div class="card-header"><h3 class="text-center font-weight-bold text-epg my-4">Acceder a la Plataforma</h3></div>
                                <div class="card-body" id='dtaLogin'>

                                    <form  method="POST" name='frmLogin' id='frmLogin' action="<?php echo base_url('inicio/doLogin');?>">
                                        <div class="form-group"><label class="small mb-1" >Tipo de Usuario</label>
                                            <select name="iptKind" class="form-control" required>
                                                <option selected disabled value="">Selecciona un Tipo</option>
                                                <option value="1">TESISTA</option>
                                                <option value="2">DOCENTE</option>
                                                <option value="3">COORDINADOR</option>
                                            </select>
                                        </div>
                                        <div class="form-group"><label class="small mb-1" >Correo</label><input class="form-control py-4" id="mail" name="mail" type="email" placeholder="Ingrese su correo." required="" /></div>
                                        <div class="form-group"><label class="small mb-1" >Contraseña</label><input class="form-control py-4" id="pass" name="pass" type="password" placeholder="Contraseña" required="" /></div>
                                        <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                            <a class="small text-epg " href="<?=base_url('password');?>">Recuperar Contraseña?</a>
                                            <button class="btn btn-info btn-o bg-purple text-white" type="submit" >Ingresar</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer text-center">
                                    <div class="small "><a class="text-epg font-weight-bold" href="<?=base_url('registro');?>">No tienes cuenta? Regístrate!</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <script src="<?php echo base_url("include/js/lightajax.js");?>" crossorigin="anonymous"></script>
        <script src="<?php echo base_url("include/js/web.js");?>" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    </body>
    </html>
