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

$data = json_decode( file_get_contents('php://input') );

$eCodUsuario = $data->eCodUsuario ? $data->eCodUsuario : false;
        $eCodPerfil = $data->eCodPerfil ? $data->eCodPerfil : false;
        $tNombre = $data->tNombre ? "'".utf8_encode($data->tNombre)."'" : false;
        $tApellidos = $data->tApellidos ? "'".utf8_encode($data->tApellidos)."'" : false;
        $tPasswordAcceso = $data->tPasswordAcceso ? "'".base64_encode($data->tPasswordAcceso)."'" : false;
        $tPasswordOperaciones = $data->tPasswordOperaciones ? "'".base64_encode($data->tPasswordOperaciones)."'" : false;
        $tCorreo = $data->tCorreo ? "'".$data->tCorreo."'" : false;
        $bAll = $data->bAll ? 1 : 0;
        
        $fhFechaCreacion = "'".date('Y-m-d H:i:s')."'";
 if(!$eCodPerfil)  
     $errores[] = 'El perfil es obligatorio';
 if(!$tNombre)  
     $errores[] = 'El nombre es obligatorio';
 if(!$tApellidos)  
     $errores[] = 'Los apellidos son obligatorios';
 if(!$tPasswordAcceso)  
     $errores[] = 'El password de acceso es obligatorio';
 if(!$tPasswordOperaciones)  
     $errores[] = 'El password de operaciones es obligatorio';
 if(!$tCorreo)  
     $errores[] = 'El correo es obligatorio';

if(!sizeof($errores))
{
        if(!$eCodUsuario)
        {
            $insert = "INSERT INTO SisUsuarios (tNombre, tApellidos, tCorreo, tPasswordAcceso, tPasswordOperaciones,  eCodEstatus, eCodPerfil, fhFechaCreacion,bAll) VALUES ($tNombre, $tApellidos, $tCorreo, $tPasswordAcceso, $tPasswordOperaciones, 3, $eCodPerfil, $fhFechaCreacion,$bAll)";
        }
        else
        {
            $insert = "UPDATE SisUsuarios SET
            tPasswordAcceso = $tPasswordAcceso,
            tPasswordOperaciones = $tPasswordOperaciones,
            eCodPerfil = $eCodPerfil,
            bAll = $bAll
            WHERE
            eCodUsuario = $eCodUsuario";
        }
}
        
        $rs = mysql_query($insert);

        if(!$rs)
        {
            $errores[] = 'Error de insercion/actualizacion del usuario '.mysql_error();
        }

echo json_encode(array("exito"=>((!sizeof($errores)) ? 1 : 0), 'errores'=>$errores));

?>