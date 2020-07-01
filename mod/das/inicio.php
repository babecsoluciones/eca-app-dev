<?php
require_once("cnx/swgc-mysql.php");
require_once("cls/cls-sistema.php");
include("../inc/fun-ini.php");

$clSistema = new clSis();
session_start();

$bAll = $_SESSION['bAll'];
$bDelete = $_SESSION['bDelete'];
?>

<div class="row">
<!--widgets-->
    <div class="row">
                            <div class="col-lg-8">
                                <h2 class="title-1 m-b-25">&Uacute;ltimos Pedidos</h2>
                                <div class="table-responsive table--no-card m-b-40">
                                    <table class="table table-borderless table-striped table-earning">
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
                                                    ORDER BY bp.eCodPedido DESC LIMIT 0,10";
                                        $rsPedidos = mysql_query($select);
                                        ?>
                                        <tbody>
                                            <? while($rPedido = mysql_fetch_array($rsPedidos)) { ?>
                                            <tr>
                                                <td><? menuEmergente($rPedido{'eCodPedido'}); ?></td>
                                                <!--<td><?=sprintf("%07d",$rPedido{'eCodPedido'});?></td>-->
                                                <td><?=date('d-m-Y H:i',strtotime($rPedido{'fhFechaPedido'}));?></td>
                                                <td><?=ucwords($rPedido{'tNombres'}.' '.$rPedido{'tApellidos'});?></td>
                                                <td><?=ucwords($rPedido{'tEtapa'});?></td>
                                            </tr>
                                            <? } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <h2 class="title-1 m-b-25">&Uacute;ltimos Clientes</h2>
                                <div class="au-card au-card--bg-blue au-card-top-countries m-b-40">
                                    <div class="au-card-inner">
                                        <div class="table-responsive">
                                            <table class="table table-top-countries">
                                                <tbody>
                                                    <?
                                                    $select = "SELECT * FROM CatClientes ORDER BY eCodCliente DESC LIMIT 0,10";
                                                    $rsClientes = mysql_query($select);
                                                    while($rCliente = mysql_fetch_array($rsClientes)) { ?>
                                                    <tr>
                                                        <td><?=ucwords($rCliente{'tNombres'}.' '.$rCliente{'tApellidos'});?></td>
                                                    </tr>
                                                    <? } ?>
                                                    
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
<!--widgets-->

</div>