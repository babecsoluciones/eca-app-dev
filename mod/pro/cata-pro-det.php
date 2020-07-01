<?php
require_once("cnx/swgc-mysql.php");
require_once("cls/cls-sistema.php");
$clSistema = new clSis();
session_start();
$select = "	SELECT 
	cti.tNombre as tipo, 
	ci.*
FROM
	CatInventario ci
	INNER JOIN CatTiposInventario cti
WHERE ci.eCodInventario = ".$_GET['val'];
$rsCliente = mysql_query($select);
$rCliente = mysql_fetch_array($rsCliente);
?>
<div class="row">
                            <div class="col-lg-12">
                                <h2 class="title-1 m-b-25">Detalles del Producto</h2>
                                
                                    <table class="table table-responsive">
                                        <tr>
                                            <td>Nombre</td>
                                            <td><?=$rCliente{'tNombre'}?></td>
                                        </tr><tr>
											<td>Marca</td>
                                            <td><?=$rCliente{'tMarca'}?></td>
										</tr>
										<tr>
											<td>Tipo</td>
                                            <td><?=$rCliente{'tipo'}?></td>
                                            </tr><tr>
                                            <td>Descripci&oacute;n</td>
                                            <td><?=$rCliente{'tDescripcion'}?></td>
                                        </tr>
                                        <tr>
                                            <td>Precio Interno</td>
                                            <td>$<?=$rCliente{'dPrecioInterno'}?></td>
                                            </tr><tr>
											<td>Precio Venta</td>
                                            <td>$<?=$rCliente{'dPrecioVenta'}?></td>
                                        </tr>
										<tr>
                                            <td>Imagen</td>
                                            <td colspan="3"><img src="<?=$rCliente{'tImagen'}?>" style="max-width:250px"></td>
											
                                        </tr>
                                        
                                    </table>
                                
                            </div>
                        </div>