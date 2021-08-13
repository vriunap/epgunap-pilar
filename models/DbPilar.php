<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

//
// add our Base Model retrived From: PedrixAdo
//
require_once APPPATH."models/MainModel.php";

//
// our Composed Model to EpgApp
//

class DbPilar extends MainModel
{

    public function __construct()
    {
        parent::__construct();
        $this->setDB( "epg_pilar" );
    }

    //---------------------------------------------------------------------------
    // area de funciones propias para DB manage por ROW ultima iteracion
    //---------------------------------------------------------------------------
	public function mdLogin($mail,$pass){
        $query=$this->dbPilar->getSnapRow('tblTesistas',"Correo='$mail' AND Password='$pass'");
        return ($query?true:false);
    }

    public function logPilar($idUser,$op,$obs){
        echo "opps devehlp";
    }

    public function inTramTesista($IdTesista){
        return $this->dbPilar->getSnapRow('tesTramites',"IdTesista=$IdTesista AND Tipo > 0 ORDER By Id DESC");
    }

    public function inTesista($IdTesista)
    {
        return $this->dbPilar->getSnapRow('tblTesistas',"Id=$IdTesista");
    }


    public function inCorreo( $idTes )
	{
		if( ! $idTes ) return null;
		return $this->getOneField( "tblTesistas", "Correo", "Id=$idTes" );
    }

    public function infoTramite($IdTram, $estado, $iteracion)
    {

        $query = $this->db->select('tra.Id, tra.Estado, tradet.Titulo ,tra.Codigo, tes.Nombres, tes.Apellidos, pro.Nombre, tradet.DateReg, tradet.Archivo,tradet.Iteracion, tradet.vb1, tradet.vb2, tradet.vb3, tradet.vb4' )
        ->from('tesTramites as tra')
        ->join('epg_absmain.dicProgramas as pro','tra.IdPrograma = pro.Id','inner')
        ->join('tblTesistas as tes','tra.IdTesista = tes.Id','inner')
        ->join('epg_absmain.dicLineas as lin','tra.IdLinea = lin.Id','inner')
        ->join('tesTramitesDet as tradet','tra.Id = tradet.IdTram')
		->where('tra.Id',$IdTram)
		->where('tra.Estado',$estado)
        ->where('tradet.Iteracion',$iteracion)
        ->get();

        return $query->result_array();
    }


	/* Funciones panel docente  */
    public function comoDirector($idJurado, $estado)
	{	
		$numProyectos=0;
		$py_asociados=$this->dbPilar->getSnapView('tesJurados',"IdJurado=$idJurado AND Posicion=4");

		if($py_asociados->num_rows()>0)
		{
			foreach($py_asociados->result() as $jurado)
			{
				//	$proyecto=$this->dbPilar->infoTramite($jurado->IdTram,$estado,1);
				$proyecto=$this->dbPilar->getSnapRow('tesTramites',"Id = $jurado->IdTram");

				//foreach($proyecto as $item)
				//{
					if ($proyecto->Estado==$estado)
					{
						$numProyectos++;
					}
				//}
			}
			//echo ("nume:".$numProyectos);
			return $numProyectos;
		}
		else
		{
			return 0;
		}
    }

	/*
	public function comoJurado($idJurado, $estado)
	{	
		$numProyectos=0;

		$py_asociados=$this->dbPilar->getSnapView('tesJurados',"IdJurado=$idJurado AND Posicion !=4");

		//print_r($py_asociados->num_rows());

		if($py_asociados->num_rows()>0)
		{  
			foreach($py_asociados->result() as $jurado)
			{
				$proyecto=$this->dbPilar->infoTramite($jurado->IdTram,$estado,1);

				$proyecto2=$this->dbPilar->getSnapRow('tesTramites',"Id = $jurado->IdTram");

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
*/

 // función reemplazo de comoJurado

 public function comoJurado($idJurado, $estado)
 {	
	 $numProyectos=0;

	 $py_asociados=$this->dbPilar->getSnapView('tesJurados',"IdJurado=$idJurado AND Posicion !=4");

	 

	 if($py_asociados->num_rows()>0)
	 {  
		 foreach($py_asociados->result() as $jurado)
		 {
			 

			 $proyecto=$this->dbPilar->getOneField('tesTramites','Estado' ,"Id = $jurado->IdTram");
			 
				 if ($proyecto==$estado)
				 {
					 $numProyectos++;
				 }
			 
		 }

		 return $numProyectos;
	 }
	 else
	 {	
		 return 0;
	 }
 }





	public function posicion($idTramite,$idJurado)
	{
		$py_asociados=$this->dbPilar->getSnapRow('tesJurados',"IdJurado=$idJurado AND IdTram =$idTramite");
		$rol= $py_asociados->Posicion;

		return $rol;
	}
/*
	public function isProyectoRevisado($idTramite, $idJurado, $rol)
	{
		
		$proyecto=$this->dbPilar->infoTramite($idTramite,4,4);		

		

		foreach($proyecto as $item)
		{
			switch ($rol) {

				case 1 :
					if($item['vb1']==1)
					{
						return true;
					} 
					else
					{
						return false;
					}
				break;
				case 2 :
					if($item['vb2']==1)
					{
						return true;
					} 
					else
					{
						return false;
					}
				break;
				case 3 :
					if($item['vb3']==1)
					{
						return true;
					} 
					else
					{
						return false;
					}
				break;
				case 4 :
					if($item['vb4']==1)
					{
						return true;
					}
					else
					{
						return false;
					} 
				break;


				default:
					return false;
				break;


			}


		}

	}

*/
	// Reemplazo de la función isProyectoRevisado
	public function isProyectoRevisado($idTramite, $idJurado, $rol)
	{
		
		//$proyecto=$this->dbPilar->infoTramite($idTramite,4,4);		

		$item=$this->dbPilar->getSnapRow('tesTramitesDet',"IdTram=$idTramite AND Iteracion=4");
		/*
		echo("<script>console.log('Debug php tramite:". $idTramite."' );</script>");
		
		echo("<script>console.log('Debug php vb1:". $item->vb1."' );</script>");
		echo("<script>console.log('Debug php vb2:". $item->vb2."' );</script>");
		echo("<script>console.log('Debug php vb3:". $item->vb3."' );</script>");
		*/

			switch ($rol) {

				case 1 :
					if($item->vb1==1)
					{
						return true;
					} 
					else
					{
						return false;
					}
				break;
				case 2 :
					if($item->vb2==1)
					{
						return true;
					} 
					else
					{
						return false;
					}
				break;
				case 3 :
					if($item->vb3==1)
					{
						return true;
					} 
					else
					{
						return false;
					}
				break;
				case 4 :
					if($item->vb4==1)
					{
						return true;
					}
					else
					{
						return false;
					} 
				break;


				default:
					return false;
				break;


			}


		

	}





	public function isProyectoDictaminado($idTramite, $idJurado, $rol)
	{
		//$proyecto=$this->dbPilar->infoTramite($idTramite,5,5);		

		$item=$this->dbPilar->getSnapRow('tesTramitesDet',"IdTram=$idTramite AND Iteracion=5");


			switch ($rol) {

				case 1 :
					if($item->vb1 !=0)
					{ 
						return true;
					} 
					else
					{
						return false;
					}
				break;
				case 2 :
					if($item->vb2 !=0)
					{
						return true;
					} 
					else
					{
						return false;
					}
				break;
				case 3 :
					if($item->vb3 !=0)
					{
						return true;
					} 
					else
					{
						return false;
					}
				break;
				case 4 :
					if($item->vb4 !=0)
					{
						return true;
					}
					else
					{
						return false;
					} 
				break;


				default:
					return false;
				break;
		
			
			}
		
			
	}



	public function num_pendientes_jurado($idJurado, $estado)
	{
		$num_pendientes=0;

		$py_asociados=$this->dbPilar->getSnapView('tesJurados',"IdJurado=$idJurado AND Posicion != 4");


	
	
		foreach($py_asociados->result() as $jurado)
		{
			$tramite = $jurado->IdTram;		
			$estadoPY=$this->dbPilar->getOneField('tesTramites',"Estado","Id=$tramite");
				
			$rol = $this->dbPilar->posicion($tramite,$idJurado);

		
			//if($estadoPY<7)
			//{ 
					echo("<script>console.log('Debug php estadoPY". $estadoPY."' );</script>");
					if(($estado==4) AND ($estadoPY==4) )
					{		
						if(!$this->dbPilar->isProyectoRevisado($tramite, $idJurado, $rol))
						{ 
						
							$num_pendientes++;
						}
					}

					if(($estado==5 )AND ($estadoPY==5))
					{
						if(!$this->dbPilar->isProyectoDictaminado($tramite, $idJurado, $rol))
						{  
							$num_pendientes++;
						}

					}
			//}
			
		}

		return $num_pendientes;
	}




	
	public function isBorradorRevisado($idTramite, $idJurado, $rol)
	{
		//$proyecto=$this->dbPilar->infoTramite($idTramite,22,22);		

		$item=$this->dbPilar->getSnapRow('tesTramitesDet',"IdTram=$idTramite AND Iteracion=22");
		
		//foreach($proyecto as $item)
		//{
			switch ($rol) {

				case 1 :
					if($item->vb1==1)
					{
						return true;
					} 
					else
					{
						return false;
					}
				break;
				case 2 :
					if($item->vb2==1)
					{
						return true;
					} 
					else
					{
						return false;
					}
				break;
				case 3 :
					if($item->vb3==1)
					{
						return true;
					} 
					else
					{
						return false;
					}
				break;
				case 4 :
					if($item->vb4==1)
					{
						return true;
					}
					else
					{
						return false;
					} 
				break;


				default:
					return false;
				break;
			
			
			}


		
			
	}



	
	public function isBorradorDictaminado($idTramite, $idJurado, $rol)
	{
		

		$item=$this->dbPilar->getSnapRow('tesTramitesDet',"IdTram=$idTramite AND Iteracion=23");


			switch ($rol) {

				case 1 :
					if($item->vb1 !=0)
					{ 
						return true;
					} 
					else
					{
						return false;
					}
				break;
				case 2 :
					if($item->vb2 !=0)
					{
						return true;
					} 
					else
					{
						return false;
					}
				break;
				case 3 :
					if($item->vb3 !=0)
					{
						return true;
					} 
					else
					{
						return false;
					}
				break;
				case 4 :
					if($item->vb4 !=0)
					{
						return true;
					}
					else
					{
						return false;
					} 
				break;


				default:
					return false;
				break;
		
			
			}
		
			
	}
/*
	public function num_pendientes_jurado_bor($idJurado, $estado)
	{
		$num_pendientes=0;

		$py_asociados=$this->dbPilar->getSnapView('tesJurados',"IdJurado=$idJurado"); 
		//print_r($py_asociados);

		foreach($py_asociados->result() as $jurado)
		{
			$tramite = $jurado->IdTram;			
			$rol = $this->dbPilar->posicion($tramite,$idJurado);

			if($estado==22)
			{	
				if(!$this->dbPilar->isBorradorRevisado($tramite, $idJurado, $rol))
				{ 
					$num_pendientes++;
				}
			}

		}

		return $num_pendientes;
	}

*/

	public function num_pendientes_jurado_bor($idJurado, $estado)
	{
		$num_pendientes=0;

		$py_asociados=$this->dbPilar->getSnapView('tesJurados',"IdJurado=$idJurado AND Posicion != 4");


	
	
		foreach($py_asociados->result() as $jurado)
		{
			$tramite = $jurado->IdTram;		
			$estadoPY=$this->dbPilar->getOneField('tesTramites',"Estado","Id=$tramite");
				
			$rol = $this->dbPilar->posicion($tramite,$idJurado);

		

					echo("<script>console.log('Debug php estadoBORRADOR". $estadoPY."' );</script>");
					if(($estado==22) AND ($estadoPY==22) )
					{		
						if(!$this->dbPilar->isBorradorRevisado($tramite, $idJurado, $rol))
						{ 
						
							$num_pendientes++;
						}
					}

					if(($estado==23 )AND ($estadoPY==23))
					{
						if(!$this->dbPilar->isBorradorDictaminado($tramite, $idJurado, $rol))
						{  
							$num_pendientes++;
						}

					}
			
			
		}

		return $num_pendientes;
	}



	public function isSustentacionDictaminado($idTramite, $idJurado, $rol)
	{
		

		$item=$this->dbPilar->getSnapRow('tesTramitesDet',"IdTram=$idTramite AND Iteracion=25");


			switch ($rol) {

				case 1 :
					if($item->vb1 !=0)
					{ 
						return true;
					} 
					else
					{
						return false;
					}
				break;
				case 2 :
					if($item->vb2 !=0)
					{
						return true;
					} 
					else
					{
						return false;
					}
				break;
				case 3 :
					if($item->vb3 !=0)
					{
						return true;
					} 
					else
					{
						return false;
					}
				break;
				case 4 :
					if($item->vb4 !=0)
					{
						return true;
					}
					else
					{
						return false;
					} 
				break;


				default:
					return false;
				break;
		
			
			}
		
			
	}



}

