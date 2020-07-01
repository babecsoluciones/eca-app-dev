<?php
require_once("cnx/swgc-mysql.php");
require_once("cls/cls-sistema.php");
include("../inc/fun-ini.php");

//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);

$clSistema = new clSis();
session_start();

$bAll = $_SESSION['bAll'];
$bDelete = $_SESSION['bDelete'];

?>

<script>

function detalles(eCodCliente)
    {
        window.location="?tCodSeccion=cata-inv-det&eCodInventario="+eCodCliente;
    }
function eliminar(eCodInventario)
    {
        window.location="?tCodSeccion=cata-inv-con&eCodInventario="+eCodInventario;
    }
</script>
<div class="row">
                            <div class="col-lg-12">
                                <h2 class="title-1 m-b-25">Productos </h2>
                                
                                 <!--tabs-->
        
        <div class="card">
        <div class="custom-tab" style="background-color:rgb(229,229,229)">

											
											
													
                                                        <!--tablas-->
                                                       
                                    <table class="display" id="table" width="100%">
                                        <thead>
                                            <tr>
                                                <th>C&oacute;digo</th>
												<th>Nombre</th>
                                                <th>Descripci&oacute;n</th>
                                                <th>Precio</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
											<?
											$select = "	SELECT 
															ci.*
														FROM
															CatProductos ci ".
														" ORDER BY ci.tNombre ASC";
											$rsPublicaciones = mysql_query($select);
		   									
											while($rPublicacion = mysql_fetch_array($rsPublicaciones))
											{
												
												?>
											<tr>
                                                <td><? menuEmergente($rPublicacion{'eCodProducto'}); ?></td>
												<td><?=($rPublicacion{'tNombre'})?></td>
												<td><?=substr($rPublicacion{'tDescripcion'},0,50)?>...</td>
												<td>$<?=number_format($rPublicacion{'dPrecio'},2)?></td>
												
                                            </tr>
											<?
													$b++;
											}
											?>
                                        </tbody>
                                    </table>
                                
                                                        <!--tablas-->
                                                      
												
											

										</div>
        </div>
<!--tabs-->
                                
                            </div>
                        </div>