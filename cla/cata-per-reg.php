<? header('Access-Control-Allow-Origin: *');  ?>
<? header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method"); ?>
<? header("Access-Control-Allow-Methods: GET, POST, OPTIONS, DELETE"); ?>
<? header("Allow: GET, POST, OPTIONS, PUT, DELETE"); ?>
<? header('Content-Type: application/json'); ?>
<?

if (isset($_SERVER['HTTP_ORIGIN'])) {
        header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 86400');    // cache for 1 day
    }

include("../cnx/swgc-mysql.php");

session_start();

$errores = array();

$data = json_decode( file_get_contents('php://input') );




/*Preparacion de variables*/
        
        $eCodPerfil = $data->eCodPerfil ? $data->eCodPerfil : false;
    if(!$eCodPerfil)
    {
        $tNombre = "'".$data->tNombre."'";
        $insert = "INSERT INTO SisPerfiles (tNombre) VALUES($tNombre)";
        $rsNuevo = mysql_query($insert);
        $eCodPerfil = mysqli_insert_id();
        
        if(!$rsNuevo)
        {
            $errores[] = 'Error de creacion del perfil '.mysql_error();
        }
    }
    
    mysql_query("DELETE FROM SisSeccionesPerfilesInicio WHERE eCodPerfil = $eCodPerfil");
    mysql_query("INSERT INTO SisSeccionesPerfilesInicio (eCodPerfil, tCodSeccion) VALUES ($eCodPerfil,'".$data->tCodSeccionInicio."')");
    
	mysql_query("DELETE FROM SisSeccionesPerfiles WHERE eCodPerfil = $eCodPerfil");

    
	foreach($data->secciones as $secciones)
	{
		$tCodSeccion = $secciones->tCodSeccion ? "'".$secciones->tCodSeccion."'" : false;
		$bAll = $secciones->bAll ? $secciones->bAll : 0;
        $bDelete = $secciones->bDelete ? $secciones->bDelete : 0;
        
        if($tCodSeccion)
        { 
            $insert = "INSERT INTO SisSeccionesPerfiles (eCodPerfil, tCodSeccion, bAll, bDelete) VALUES ($eCodPerfil, $tCodSeccion, $bAll, $bDelete)";
            fwrite($pf,$insert."\n");
            $rs = mysql_query($insert);

            if(!$rs)
            {
                $errores[] = 'Error al adjuntar la secci&oacute;n '.$tCodSeccion.' al perfil '.$insert.mysql_error();
            } 
        }
	}
        
  

echo json_encode(array("exito"=>((!sizeof($errores)) ? 1 : 0), 'errores'=>$errores));

?>