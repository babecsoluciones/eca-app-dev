<?php
require_once("cnx/swgc-mysql.php");
require_once("cls/cls-sistema.php");
include("../inc/fun-ini.php");

$clSistema = new clSis();
session_start();

$select = "	SELECT 
	ci.*
FROM
	CatProductos ci
	
WHERE ci.eCodProducto = ".$_GET['v1'];
//echo $select;
$rsPublicacion = mysql_query($select);
$rPublicacion = mysql_fetch_array($rsPublicacion);

?>
<?
if($_POST)
{
    $res = $clSistema -> registrarInventario();
    
    if($res)
    {
        ?>
            <div class="alert alert-success" role="alert">
                El producto se guard&oacute; correctamente!
            </div>
<script>
setTimeout(function(){
    window.location="?tCodSeccion=cata-inv-con";
},2500);
</script>
<?
    }
    else
    {
  ?>
            <div class="alert alert-danger" role="alert">
                Error al procesar la solicitud!
            </div>
<?
    }
}
?>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0-alpha1/jquery.js"></script>
	<script type="text/javascript">
		function readURL(input,destino) {
			if (input.files && input.files[0]) {
				var reader = new FileReader();
				reader.onload = function (e) {
					$('#falseinput').attr('src', e.target.result);
					$('#base').val(e.target.result);
          document.getElementById(destino).value=e.target.result;
          //llenar();
				};
				reader.readAsDataURL(input.files[0]);
			}
		}
   
function validar()
{
var bandera = false;
var mensaje = "";
var tNombre = document.getElementById("tNombre");

var tDescripcion = document.getElementById("tDescripcion");
var dPrecioInterno = document.getElementById("dPrecio");

var tImagen = document.getElementById("tImagen");

    if(!tNombre.value)
    {
        mensaje += "* Nombre\n";
        bandera = true;
    };
    if(!tDescripcion.value)
    {
        mensaje += "* Descripcion\n";
        bandera = true;
    };
    if(!dPrecio.value)
    {
        mensaje += "* Precio\n";
        bandera = true;
    };
	
	if(!tImagen.value)
    {
        mensaje += "* Imagen\n";
        bandera = true;
    };
	
    
    
    if(!bandera)
    {
        guardar();
    }
    else
    {
        alert("<- Favor de revisar la siguiente información ->\n"+mensaje)
    }
}
   
</script>
    
<div class="row">
    <div class="col-lg-12">
    <form id="datos" name="datos" action="<?=$_SERVER['REQUEST_URI']?>" method="post" enctype="multipart/form-data">
        <input type="hidden" id="eCodProducto" name="eCodProducto" value="<?=$_GET['v1']?>">
        <input type="hidden" name="eAccion" id="eAccion">
                            <div class="col-lg-12">
								<h2 class="title-1 m-b-25"><?=$_GET['v1'] ? 'Actualizar ' : '+ '?>Producto</h2>
                                <div class="card col-lg-12">
                                    
                                    <div class="card-body card-block">
                                        <!--campos-->
                                        <div class="form-group">
              
           </div>
           
		   <div class="form-group">
              <label>Nombre</label>
              <input type="text" class="form-control" name="tNombre" id="tNombre" placeholder="Nombre" value="<?=($rPublicacion{'tNombre'})?>" >
           </div>
           <div class="form-group">
              <label>Descripci&oacute;n</label>
              <textarea class="form-control" name="tDescripcion" id="tDescripcion" placeholder="Descripci&oacute;n"><?=($rPublicacion{'tDescripcion'})?></textarea>
           </div>
           <div class="form-group">
              <label>Precio</label>
              <input type="text" class="form-control" name="dPrecio" id="dPrecio" placeholder="Precio" value="<?=($rPublicacion{'dPrecio'})?>" >
           </div>
           <div class="form-group">
              <label>Imagen</label>
              <input type="file" class="form-control" name="tArchivo" id="tArchivo" onchange="readURL(this,'tImagen')">
			   <input type="hidden" id="tImagen" name="tImagen" value="<?=base64_decode($rPublicacion{'tImagen'})?>">
               <input type="hidden" id="tFichero" name="tFichero" value="<?=$rPublicacion{'tImagen'}?>">
               <input type="hidden" id="bFichero" name="bFichero" value="<?=$rPublicacion{'tImagen'} ? 1 : 0?>">
               <img src="<?=obtenerURL();?>cla/<?=$rPublicacion{'tImagen'}?>" width="250" height="250">
           </div>
           
                                        <!--campos-->
                                    </div>
                                </div>
                            </div>
    </form>
    </div>
                        </div>