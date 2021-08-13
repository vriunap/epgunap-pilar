<body style="font-size: 11px; font-family: Arial">

<img src="/epgunap/include/img/rotActaEpg.jpg" style="border-bottom: 1px solid black">

<div style="font-size: 17px">
 <b> <?=$codTram?> </b>
</div>

<div style="text-align: center; font-size: 14px">
    <b>ACTA DE APROBACIÓN DE <?=$tipActa?> DE TESIS</b>
</div>

<div style="text-align: justify">
En la Ciudad Universitaria, a los <?=$dia?> dias del mes <?=$mes?> del <?=$ano?> siendo horas <?=$hor?>. Los miembros
    del Jurado, declaran <b>APROBADO</b> el PROYECTO DE INVESTIGACIÓN DEL <?=$tipActa?> DE TESIS titulado:
</div>

<div style="text-align: center">
<b> <?=$Titulo?> </b>
</div>

<div>Presentado por:</div>

<div style="text-align: center">
<b> <?=$Tesista?> </b>
</div>

<div>Tesista del programa de <b><?=($prog->Tipo==2? "DOCTORADO" : "MAESTRÍA") ?></b> en:</div>


<div style="text-align: center">
<b> <?=$prog->Nombre?> </b>
</div>

<div>Siendo el Jurado Dictaminador, conformado por:</div>
<div>
    <table>
        <tr>
            <td width="40%" style="text-align: right"> <b>Presidente:</b> &nbsp;&nbsp;&nbsp; </td>
            <td width="60%"> <?=$j1?> </td>
        </tr>
        <tr>
            <td style="text-align: right"> <b>Primer Miembro:</b> &nbsp;&nbsp;&nbsp; </td>
            <td> <?=$j2?> </td>
        </tr>
        <tr>
            <td style="text-align: right"> <b>Segundo Miembro:</b> &nbsp;&nbsp;&nbsp; </td>
            <td> <?=$j3?> </td>
        </tr>
        <tr>
            <td style="text-align: right"> <b>Asesor:</b> &nbsp;&nbsp;&nbsp; </td>
            <td> <?=$j4?> </td>
        </tr>
    </table>
</div>
<div style="text-align: justify">
Para dar fé de este proceso electrónico, el Vicerrectorado de Investigación y la Escuela de Posgrado de la Universidad
Nacional del Altiplano - Puno, mediante la Plataforma de Investigación se le asigna la presente constancia y a partir de la
presente fecha queda expedito para la
<?php if( $tipActa=="PROYECTO"): ?>
    ejecución del <b>PROYECTO DE INVESTIGACIÓN DE TESIS</b>.
<?php else: ?>
    programación de la <b>DEFENSA DE LA TESIS</b>.
<?php endif; ?>
</div>

<div style="text-align: right">
<b>Puno, <?=$mes?> de <?=$ano?></b>
</div>


<img src="/epgunap/<?=$qimg?>" width="120">
<div style="font-size: 7px">
ESCUELA DE POSGRADO<br>
Universidad Nacional del Altiplano<br>
Web: https://vriunap.pe/epgunap
</div>

</body>

