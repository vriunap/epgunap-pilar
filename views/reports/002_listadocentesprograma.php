<?php 
        $i=1;
        
        echo "<h3 class='text-center'>REPORTE PILAR EPG</h3>";
        echo "<h4 class='text-center'>DOCENTES DEL PROGRAMA : $nombre</h4>";
        echo "<h6 class='float-right'>FECHA : ".mlCurrentDate()."</h6>";
        echo "<table class='table table-striped'>";
        echo "<tr><th>N°</th><th>Tipo</th> <th>Nombres y Apellidos</th></tr>";
        foreach ($docProg->result() as $doc) {
            $row    = $this->dbRepo->inDocente($doc->IdDocente);
            if($row){

                    $tipo = ($doc->Tipo==1?"Maestría":"Doctorado");
                    echo "<tr><td>$i</td><td>".$tipo."</td> <td>$row->Nombres, $row->Apellidos</td></tr>";
                    $i++;
            }
        }
        echo "</table>";

 ?>