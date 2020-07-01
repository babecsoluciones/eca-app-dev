<? header('Access-Control-Allow-Origin: *');  ?>
<? header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method"); ?>
<? header("Access-Control-Allow-Methods: GET, POST, OPTIONS, DELETE"); ?>
<? header("Allow: GET, POST, OPTIONS, PUT, DELETE"); ?>
<? header('Content-Type: application/json'); ?>
<?

if (isset($_SERVER{'HTTP_ORIGIN'})) {
        header("Access-Control-Allow-Origin: {$_SERVER{'HTTP_ORIGIN'}}");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 86400');    // cache for 1 day
    }

require("../cnx/swgc-mysql.php");

session_start();

$errores = array();

function obtenerURL()
{
	$select = "SELECT tValor FROM SisVariables WHERE tNombre = 'tURL'";
    $rCFG = mysql_fetch_array(mysql_query($select));
    return $rCFG{'tValor'};
}

function base64toImage($datos)
{
    
    $fname = "inv/".uniqid().'.jpg';
        $datos1 = explode(',', base64_decode($datos));
        $content = base64_decode($datos1[1]);
        //$img = filter_input(INPUT_POST, "image");
        //$img = str_replace(array('data:image/png;base64,','data:image/jpg;base64,'), '', base64_decode($data));
        //$img = str_replace(' ', '+', $img);
        //$img = base64_decode($img);
        
        //file_put_contents($fname, $img);
        
        $pf = fopen($fname,"w");
        fwrite($pf,$content);
        fclose($pf);
        
        return $fname;
}

$data = json_decode( file_get_contents('php://input') );

/*Preparacion de variables*/
        
        $eCodProducto = $data->eCodProducto ? $data->eCodProducto : false;
		
        $tNombre = "'".$data->tNombre."'";
        $tMarca = "'".$data->tMarca."'";
        $tDescripcion = "'".$data->tDescripcion."'";
        $dPrecio = $data->dPrecio;
        $tImagen = ($data->bFichero && !$data->tImagen) ? "'".$data->tFichero."'" : ($data->tImagen ? "'".base64toImage(base64_encode($data->tImagen))."'" : "NULL");


if(!$tNombre)
   $errores[] = 'El nombre de producto es obligatorio'; 

if(!$tDescripcion)
   $errores[] = 'La descripcion de producto es obligatorio'; 

if(!$dPrecio)
   $errores[] = 'El precio interno de producto es obligatorio'; 


        
if(!sizeof($errores))
{
        if(!$eCodProducto)
        {
            $insert = " INSERT INTO CatProductos
            (
            tNombre,
            tDescripcion,
            dPrecio,
			tImagen
			)
            VALUES
            (
            $tNombre,
            $tDescripcion,
            $dPrecio,
			$tImagen
            )";
        }
        else
        {
            $insert = "UPDATE 
                            CatProductos
                        SET
            				tNombre=$tNombre,
            				tDescripcion=$tDescripcion,
            				dPrecio=$dPrecio,
							tImagen=$tImagen
                            WHERE
                            eCodProducto = ".$eCodProducto;
        }
}
        
        $rs = mysql_query($insert);

        if(!$rs)
        {
            $errores[] = 'Error de insercion/actualizacion del producto '.mysql_error();
        }

if(!sizeof($errores))
{
    $tDescripcion = "Se ha insertado/actualizado el producto ".sprintf("%07d",eCodProducto);
    $tDescripcion = "'".$tDescripcion."'";
    $fecha = "'".date('Y-m-d H:i:S')."'";
    $eCodUsuario = $_SESSION['sessionAdmin']['eCodUsuario'];
    mysql_query("INSERT INTO SisLogs (eCodUsuario, fhFecha, tDescripcion) VALUES ($eCodUsuario, $fecha, $tDescripcion)");
}

echo json_encode(array("exito"=>((!sizeof($errores)) ? 1 : 0), 'errores'=>$errores));

?>