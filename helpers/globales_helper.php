<?php
if(!function_exists('rolTexto'))
{
	function rolTexto($posicion)
		{
			switch ($posicion) {
				case 1:
					return "Presidente";
					break;
				case 2:
					return "Primer miembro";
					break;
				case 3:
					return "Segundo miembro";
					break;
				case 4:
					return "Director";
					break;


			}
		}
}

if(!function_exists('diasHabiles'))
{
	function diasHabiles($fecha_inicio,$fecha_fin)
		{


			
		}
}
/*
if(!function_exists('tieneProyectos'))
{

function tieneProyectos($idJurado,$rol, $estado)
{	
	$numProyectos=0;

	$py_asociados=$this->dbPilar->getSnapView('tesJurados',"IdJurado=$idJurado AND Posicion=$rol");
	

	if($py_asociados->num_rows()<1)
	{
		foreach($py_asociados->result() as $jurado)
		{
			$proyecto=$this->dbPilar->infoTramite($jurado->IdTram);
			
			foreach($proyecto as $item)
			{
				if ($item['Estado']==$estado)
				{
					$numProyectos++;
				}

			}
		}
		return $numProyectos;
	}
	else
	{
		return 0;

	}

}
}
*/

?>