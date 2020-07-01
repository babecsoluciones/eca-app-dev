<?php
require_once("cnx/swgc-mysql.php");
require_once("cls/cls-sistema.php");
$clSistema = new clSis();
session_start();
$bAll = $clSistema->validarPermiso($_GET['tCodSeccion']);

$select = "SELECT cc.*, bp.* FROM CatClientes cc INNER JOIN BitPedidos bp ON bp.eCodCliente = cc.eCodCliente WHERE bp.eCodPedido = ".$_GET['v1'];
$rsPedido = mysql_query($select);
$rPedido = mysql_fetch_array($rsPedido);
?>


<link href="dist/easy-autocomplete.min.css" rel="stylesheet" type="text/css">
<script src="lib/jquery-1.11.2.min.js"></script>
<script src="dist/jquery.easy-autocomplete.min.js" type="text/javascript" ></script>


<div class="row">

    <div class="col-lg-12">
    <form id="datos" name="datos" action="<?=$_SERVER['REQUEST_URI']?>" method="post" enctype="multipart/form-data">
        <input type="hidden" name="eCodPedido" value="<?=$_GET['v1']?>">
        <input type="hidden" name="eAccion" id="eAccion">
                            <div class="col-lg-12">
								<h2 class="title-1 m-b-25">Detalles del Pedido</h2>
                                <div class="card col-lg-12">
                                    
                                    <div class="card-body card-block">
                                        <!--campos-->
                                        
                                      
                                        
           <div class="form-group">
              <label>Cliente</label>
           
                  Nombre <b><?=ucwords($rPedido{'tNombres'}.' '.$rPedido{'tApellidos'})?></b><br>
                  E-mail <b><?=($rPedido{'tCorreo'})?></b><br>
                  T. Fijo <b><?=($rPedido{'tTelefonoFijo'})?></b><br>
                  T. M&oacute;vil <b><?=($rPedido{'tTelefonoMovil'})?></b><br>
                  
           
      
              
               
           </div>
           <div class="form-group">
              <label>Fecha del Pedido</label>
              <?=date('d/m/Y H:i',strtotime($rPedido{'fhFechaPedido'}))?>
           </div>
           <div class="form-group">
              <label>Observaciones</label>
              <?=nl2br(base64_decode(utf8_decode($rPedido{'tObservaciones'})))?>
           </div>
           
                                        <!--campos-->
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                
                                    <div class="custom-tab" style="background-color:rgb(229,229,229)">
                                    <table class="table table-responsive table-borderless table-top-campaign" id="table" width="100%">
                                        <thead>
                                            
                                            <tr>
												<th width="85%">Producto</th>
                                                <th>Cantidad</th>
                                                <th>Archivo(s)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
											<?
                                            $i = 0;
											$select = "	SELECT DISTINCT
															rpp.*
                                                        FROM RelPedidosProductos rpp
                                                        WHERE rep.eCodEvento = ".$_GET['v1'];
											$rsPublicaciones = mysql_query($select);
                                            
											while($rPublicacion = mysql_fetch_array($rsPublicaciones))
											{
												?>
											<tr id="paq<?=$i?>">
                                                <td align="left">
                                                    <?=$rPublicacion{'tNombre'}?>
                                                </td>
                                                <td align="center">
                                                    <?=$rPublicacion{'eCantidad'}?>
                                                </td>
												<td>
                                                    <ul>
                                                <?
                                                $select = "SELECT * FROM RelPedidosProductosArchivos WHERE eCodRegistro = ".$rPublicacion{'eCodRegistro'};
                                                $rsArchivos = mysql_query($select);
                                                while($rArchivo = mysql_fetch_array($rsArchivos)) { ?>
                                                <li><a href="<?=str_replace("app.","cli.",obtenerURL());?><?=$rArchivo{'tArchivo'};?>"><?=$rArchivo{'tArchivo'};?></a></li>
                                                    <? } ?>
                                                        </ul>
                                                </td>
                                            </tr>
											<? } ?>
                                        </tbody>
                                    </table>
      
                                    </div>
                                </div>
								
                                
                            </div>
    </form>
    </div>
                        </div>