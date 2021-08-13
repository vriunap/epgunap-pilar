<?php 
        $i=1;
        
        echo "<h3 class='text-center'>REPORTE PILAR EPG</h3>";
        echo "<h4 class='text-center'>TOTAL DE DOCENTES POR PROGRAMA</h4>";
        echo "<h6 class='float-right'>FECHA : ".mlCurrentDate()."</h6>";
        echo "<table class='table table-striped'>";
        echo "<tr><th>N°</th><th>Tipo</th> <th>Nombre del Programa</th> <th>Estado</th><th> N° de Docentes</th><th class='d-print-none'>Opciones</th></tr>";
        $ok = 0;
        $fail=0;
        foreach ($programas->result() as $row) {
            $docprog    = $this->dbRepo->getSnapView('tblDocProg', "IdPrograma=$row->Id");
            $nro=($docprog->num_rows()<5?"Observado":"Ok");
            $quest=($docprog->num_rows()<5?$fail++:$ok++);
            $txt=($docprog->num_rows()<5?"danger":"success");
            $tipo = ($row->Tipo==1?"Maestría":"Doctorado");
            echo "<tr><td>$i</td><td>$tipo</td> <td>$row->Nombre</td> <td class='text-center text-$txt font-weight-bold' >$nro</td> <td class='text-center'>".$docprog->num_rows()."</td><td class='d-print-none'><a class='btn btn-secondary' onclick='window.open(".base_url("reports/viewdocEsc/$row->Id").")'>Ver </a></td></tr>";
            $i++;
        }

        echo "</table>";
        echo "<hr>";
        echo "<h4 class='text-right'> <span class='text-danger'>Observados = $fail </span>| <span class='text-success'>En funcionamiento : $ok</span></h4>";

        echo "<hr>";

 ?>