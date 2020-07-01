<?php
require_once("cnx/swgc-mysql.php");
require_once("cls/cls-sistema.php");
$clSistema = new clSis();
session_start();

$select = "SELECT * FROM SisUsuarios WHERE eCodUsuario = ".$_GET['eCodUsuario'];
$rsUsuario = mysql_query($select);
$rUsuario = mysql_fetch_array($rsUsuario);

?>
<?
if($_POST)
{
    $res = $clSistema -> actualizarPerfil();
    if($res)
    {
        ?>
            <div class="alert alert-success" role="alert">
                El perfil se actualiz&oacute; correctamente!
            </div>
<script>
setTimeout(function(){
    window.location="?tCodSeccion=inicio";
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
<div class="row">
	<div class="col-lg-12">
        <button type="button" class="btn btn-primary" onclick="activarValidacion()" id="btnValidar">
            <i class="fa fa-key" ></i></button>
	<input type="hidden" id="tPasswordVerificador"  style="display:none;" value="<?=base64_decode($_SESSION['sessionAdmin'][0]['tPasswordOperaciones'])?>">
        <input type="password" class="form-control col-md-6" onkeyup="validarUsuario()"  id="tPasswordOperaciones"  style="display:none;" size="8">
        <button type="button" id="btnGuardar" class="btn btn-primary" disabled onclick="guardar(1)"><i class="fa fa-floppy-o"></i> Guardar</button>
	</div>
</div>
<div class="row">
    <form id="datos" name="datos" action="<?=$_SERVER['REQUEST_URI']?>" method="post">
        <input type="hidden" name="eCodUsuario" value="<?=$_GET['eCodUsuario']?>">
        <input type="hidden" name="eAccion" id="eAccion">
                            <div class="col-lg-6">
								<h2 class="title-1 m-b-25">Mi Perfil</h2>
                                <div class="card">
                                    
                                    <div class="card-body card-block">
                                        <div class="form-group">
                                            <label for="company" class=" form-control-label">Correo electr&oacute;nico</label>
                                            <input type="text" name="tCorreo" placeholder="Correo electrónico" value="<?=$rUsuario{'tCorreo'}?>" class="form-control"<?=$_GET['eCodUsuario'] ? 'readonly' : ''?>>
                                        </div>
                                        <div class=" row form-group col-6">
                                            <label for="vat" class=" form-control-label">Password Acceso</label>
                                            <input type="password" name="tPasswordAcceso" placeholder="Password Acceso" value="<?=base64_decode($rUsuario{'tPasswordAcceso'})?>" class="form-control">
                                        </div>
                                        <div class=" row form-group col-6">
                                            <label for="street" class=" form-control-label">Password Operaciones</label>
                                            <input type="password" name="tPasswordOperaciones" placeholder="Password Operaciones" value="<?=base64_decode($rUsuario{'tPasswordOperaciones'})?>" class="form-control">
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="city" class=" form-control-label">Nombre(s)</label>
                                                    <input type="text" name="tNombre" placeholder="Nombre(s)" value="<?=$rUsuario{'tNombre'}?>" class="form-control" <?=$_GET['eCodUsuario'] ? 'readonly' : ''?>>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="postal-code" class=" form-control-label">Apellido(s)</label>
                                                    <input type="text" name="tApellidos" placeholder="Apellido(s)" value="<?=$rUsuario{'tApellidos'}?>" class="form-control"<?=$_GET['eCodUsuario'] ? 'readonly' : ''?>>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
    </form>
                        </div>