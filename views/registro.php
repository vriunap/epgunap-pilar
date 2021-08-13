<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="Registro PILAR EPG" />
    <title>EPG - Registro</title>

    <link href="<?php echo base_url('include/');?>css/styles.css" rel="stylesheet">
    <link href="<?php echo base_url('include/');?>css/web-init.css" rel="stylesheet">
    <link href="<?php echo base_url('include/');?>css/timevri.css" rel="stylesheet">
    
</head>
<body class="bg-purple">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-7">
                        <div class="text-center mt-5">
                            <a href="<?=base_url('/');?>"><img  height="70" src="<?php echo base_url('include/img/logo.png');?>" alt="Plataforma EPG"></a>
                        </div>
                        <div class="card shadow-lg border-0 rounded-lg mt-5">
                            <div class="card-header"><h3 class="text-center font-weight-light my-4 text-epg font-weight-regular">Crear cuenta</h3></div>
                            <div class="card-body m-4 " id="rsltCod" >
                                <form id="frmCOD"name='frmCOD' method="POST">
                                    <div class="form-row">

                                        <div class="col-md-7">
                                            <div class="form-group">
                                                <label class="small mb-1" for="iptCod">Código de estudiante</label>
                                                <input class="form-control py-4" id="iptCod" name="iptCod" type="number" placeholder="Código"  required="" autofocus/>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputLastName"> </label>
                                                <button  name="btn-search" id ="btn-search" type='submit' onclick="sendForm('rsltCod','inicio/doSearchCod',frmCOD);loadtimeline('2'); return false;" class="btn btn-info btn-block btn-lg bg-epg" >Siguiente <i class="fa fa-arrow-right"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                            </div>
                            <div class="card-footer text-center">
                                <div class="small "><a class="text-epg font-weight-regular" href="<?=base_url('login');?>">Si ya tienes cuenta, inicia una sesión aquí </a></div>
                            </div>
                        </div>

                        <div class="row" id="divtl1" name="divtl">
                           
                            <div class="col-3 mx-auto mt-3 containerlinea">
                                <ul class="timeline">
                                    <li class="active"></li>
                                    <li></li>
                                    <li></li>
                                </ul>
                            </div>
                        </div>

                        <div class="row" id="divtl2" name="divtl2">
                           
                            <div class="col-3 mx-auto mt-3 containerlinea">
                               <ul class="timeline">
                                   <li class="active"></li>
                                   <li class="active"></li>
                                   <li></li>
                               </ul>
                           </div>
                       </div>

                       <div class="row" id="divtl3" name="divtl3">
                           
                           <div class="col-3 mx-auto mt-3 containerlinea">
                            <ul class="timeline">
                                <li class="active"></li>
                                <li class="active"></li>
                                <li class="active"></li>
                            </ul>
                        </div>
                    </div>
                    
                    
                    

                </div>
            </div>
        </div>

    </div>
</div>
<script src="<?php echo base_url("include/js/lightajax.js");?>" crossorigin="anonymous"></script>
<script src="<?php echo base_url("include/js/web.js");?>" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>


<script>
    $(window).on('load',function(){ 
        $("#divtl2").hide();
        $("#divtl3").hide();
    });

    $(function () {
      $('[data-toggle="tooltip"]').tooltip()
  })
</script>

</body>
</html>
