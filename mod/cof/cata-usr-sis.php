<?php
require_once("cnx/swgc-mysql.php");
require_once("cls/cls-sistema.php");
include("../inc/fun-ini.php");

$clSistema = new clSis();
session_start();
$bAll = $clSistema->validarPermiso($_GET['tCodSeccion']);
if($_GET['bEliminar'])
{
    mysql_query("UPDATE SisUsuarios SET eCodEstatus=7 WHERE eCodUsuario = ".$_GET['bEliminar']);
    echo '<script>window.location="./?tCodSeccion=cata-usr-sis";</script>';
}
?>

<div class="row">
                            <div class="col-lg-12">
                                <h2 class="title-1 m-b-25">Usuarios</h2>
                                
                                    <table class="display" id="table" width="100%">
                                        <thead>
                                            <tr>
                                                <th></th>
												<th align="center">E</th>
                                                <th>Nombre</th>
                                                <th>Correo</th>
                                                <th>Perfil</th>
                                            </tr>
                                        </thead>
                                        <tbody>
											<?
											$select = "	SELECT 
															cc.*, 
															ce.tCodEstatus as estatus,
															cp.tNombre as perfil
														FROM
															SisUsuarios cc
														LEFT JOIN CatEstatus ce ON cc.eCodEstatus = ce.eCodEstatus 
														LEFT JOIN SisPerfiles cp ON cp.eCodPerfil = cc.eCodPerfil".
										" WHERE cc.eCodEstatus <>7 ".		($_SESSION['sessionAdmin'][0]['bAll'] ? "" : " AND cc.eCodPerfil > 1").
														" ORDER BY cc.eCodUsuario ASC";
											
											$rsPublicaciones = mysql_query($select);
											while($rPublicacion = mysql_fetch_array($rsPublicaciones))
											{
												?>
											<tr>
                                                <td><? menuEmergente($rPublicacion{'eCodUsuario'}); ?></td>
                                                <td><?=utf8_decode($rPublicacion{'estatus'})?></td>
                                                <td><?=utf8_decode($rPublicacion{'tNombre'}.' '.$rPublicacion{'tApellidos'})?></td>
                                                <td><?=utf8_decode($rPublicacion{'tCorreo'})?></td>
                                                <td><?=utf8_decode($rPublicacion{'perfil'})?></td>
                                            </tr>
											<?
											}
											?>
                                        </tbody>
                                    </table>
                                
                            </div>
                            
                        </div>