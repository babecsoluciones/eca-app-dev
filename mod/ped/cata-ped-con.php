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
<div class="row">
                            <div class="col-lg-12">
                                <h2 class="title-1 m-b-25">Pedidos </h2>
                                
                                 <!--tabs-->
        
        <div class="card">
        <div class="custom-tab" style="background-color:rgb(229,229,229)">

											
											
													
                                                        <!--tablas-->
                                                       
                                    <table class="display" id="table" width="100%">
                                        <thead>
                                            <tr>
                                                <th>Codigo</th>
                                                <th>Fecha</th>
                                                <th>Cliente</th>
                                                <th>Etapa</th>
                                                
                                            </tr>
                                        </thead>
                                        <?
                                        $select = "SELECT
                                                        cc.tNombres, cc.tApellidos,
                                                        bp.eCodPedido,
                                                        bp.fhFechaPedido,
                                                        ce.tNombre as tEtapa
                                                    FROM
                                                        CatClientes cc
                                                    INNER JOIN BitPedidos bp ON bp.eCodCliente = cc.eCodCliente
                                                    INNER JOIN CatEtapas ce ON ce.eCodEtapa=bp.eCodEtapa
                                                    ORDER BY bp.eCodPedido DESC";
                                        $rsPedidos = mysql_query($select);
                                        ?>
                                        <tbody>
                                            <? while($rPedido = mysql_fetch_array($rsPedidos)) { ?>
                                            <tr>
                                                <td><? menuEmergente($rPedido{'eCodPedido'}); ?></td>
                                                <td><?=date('d-m-Y H:i',strtotime($rPedido{'fhFechaPedido'}));?></td>
                                                <td><?=ucwords($rPedido{'tNombres'}.' '.$rPedido{'tApellidos'});?></td>
                                                <td><?=ucwords($rPedido{'tEtapa'});?></td>
                                            </tr>
                                            <? } ?>
                                        </tbody>
                                    </table>
                                
                                                        <!--tablas-->
                                                      
												
											

										</div>
        </div>
<!--tabs-->
                                
                            </div>
                        </div>