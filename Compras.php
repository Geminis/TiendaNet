<?php
session_start();
//echo 'la sesion actual es:'.  session_id();
include '/php/conexionbd.php';
		$arreglo=$_SESSION['carrito'];
		$numerocompra=0;
                $litro=1;
		$re=mysql_query("select * from compras order by Id DESC limit 1") or die(mysql_error());	
		while (	$f=mysql_fetch_array($re))
                {
					$numerocompra=$f['numerocompra'];	
		}
		if($numerocompra==0)
                {
			$numerocompra=1;
		}
                else
                {
			$numerocompra=$numerocompra+1;
		}
                for($i=0; $i<count($arreglo);$i++)
                {
                            mysql_query("insert into compras (numerocompra,imagen,nombre,valor_unidad,cantidad,subtotal) values(

                                    ".$numerocompra.",
                                    '".$arreglo[$i]['Imagen']."',
                                    '".$arreglo[$i]['Nombre']."',	
                                    '".$arreglo[$i]['Precio']."',
                                    '".$arreglo[$i]['Cantidad']."',
                                    '".($arreglo[$i]['Precio']*$arreglo[$i]['Cantidad'])."'
                                    )")or die(mysql_error());
                }
                
		for($i=0; $i<count($arreglo);$i++)
                {
                    if($arreglo[$i]['Precio']!=37250 & $arreglo[$i]['Precio']!=120)
                    {	mysql_query("INSERT INTO tiendanet.bodega (numerocompra, imagen, nombre, valor_unidad, cantidad, subtotal, timestamp) VALUES (
                            ".$numerocompra.",
                            '".$arreglo[$i]['Imagen']."',
                            '".$arreglo[$i]['Nombre']."',
                            '".$arreglo[$i]['Precio']."', 
                            '".$arreglo[$i]['Cantidad']."',
                            '".($arreglo[$i]['Precio']*16/100+$arreglo[$i]['Precio']*$arreglo[$i]['Cantidad']*25)."',
                            CURRENT_TIMESTAMP)")or die(mysql_error());
                        
                        }    
		}
                
		unset($_SESSION['carrito']);
		header("Location: ./Bodega.php");

?>
