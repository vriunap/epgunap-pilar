 <form id="frmDNI"name='frmDNI' method="POST">
    <div class="form-row">
        
        <div class="col-md-5">
            <div class="form-group">
                <label class="small mb-1" for="iptDNI">DNI Estudiante</label>
                <input class="form-control py-4" id="iptDNI" name="iptDNI" type="number" placeholder="DNI" required="" autofocus="" />
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label class="small mb-1" for="iptCUI">CUI</label>    
                <span class="mytooltip float-right">
                    <span class="tooltip-item">?</span>
                        <span class="tooltip-content clearfix">
                            <img src="<?php echo base_url('include/img/dnicui.jpg');?>">                       
                        </span>
                    </span>
                <input class="form-control py-4" id="iptCUI" name="iptCUI" type="number" placeholder="0" pattern="[0-9]{1}"/>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label class="small mb-1" for="inputLastName"> </label>
                <button  onclick="sendForm('rsltCod','inicio/doSearchDNI',frmDNI);loadtimeline('3'); return false;" class="btn btn-info btn-block btn-lg bg-epg" name="btn-search2" id ="btn-search2"> Siguiente <i class="fa fa-arrow-right"></i></button>
            </div>
        </div>
    </div>
</form>
