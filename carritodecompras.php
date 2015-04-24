<?php
	session_start();
        echo 'la sesion actual es:'.  session_id();
	include '/php/conexionbd.php';
	if(isset($_SESSION['carrito'])){
		if(isset($_GET['id'])){
					$arreglo=$_SESSION['carrito'];
					$encontro=false;
					$numero=0;
					for($i=0;$i<count($arreglo);$i++){
						if($arreglo[$i]['Id']==$_GET['id']){
							$encontro=true;
							$numero=$i;
						}
					}
					if($encontro==true){
						$arreglo[$numero]['Cantidad']=$arreglo[$numero]['Cantidad']+1;
						$_SESSION['carrito']=$arreglo;
					}else{
						$nombre="";
						$valor_unidad=0;
						$imagen="";
						$re=mysql_query("select * from productos where id=".$_GET['id']);
						while ($f=mysql_fetch_array($re)) {
							$nombre=$f['nombre'];
							$valor_unidad=$f['valor_unidad'];
							$imagen=$f['imagen'];
						}
						$datosNuevos=array('Id'=>$_GET['id'],
										'Nombre'=>$nombre,
										'Precio'=>$valor_unidad,
										'Imagen'=>$imagen,
										'Cantidad'=>1);

						array_push($arreglo, $datosNuevos);
						$_SESSION['carrito']=$arreglo;

					}
		}




	}
        else
        {
		if(isset($_GET['id'])){
			$nombre="";
			$valor_unidad=0;
			$imagen="";
			$re=mysql_query("select * from productos where id=".$_GET['id']);
			while ($f=mysql_fetch_array($re)) {
				$nombre=$f['nombre'];
				$valor_unidad=$f['valor_unidad'];
				$imagen=$f['imagen'];
			}
			$arreglo[]=array('Id'=>$_GET['id'],
							'Nombre'=>$nombre,
							'Precio'=>$valor_unidad,
							'Imagen'=>$imagen,
							'Cantidad'=>1);
			$_SESSION['carrito']=$arreglo;
		}
	}
?>
<!DOCTYPE html>
<html>
    <head> 
        <link href="img/favicon.ico" rel="icon" type="image/x-icon" />
        <title>Tienda Net</title>
        <meta http-equiv="Content-Type" content="text/html" />
        <meta charset="utf-8">
        <link rel="stylesheet" href="css/estilo_TiendaNet.css" type="text/css" media="screen" />
<!--        <link rel="stylesheet" href="css/estilos.css" type="text/css" media="screen" />-->
        <link rel="stylesheet" href="css/jquery-ui-1.10.4.custom.css" type="text/css" media="screen" />
        <link type="text/css"  href="css/jquery.datepick.css" rel="stylesheet" media="screen" />
        <script type="text/javascript" src="js/jquery.js"></script>
        <script src="js/jquery-ui-1.10.4.custom.min.js"></script>
        <!--<script type="text/javascript" src="js/interaccionTienda.js"></script>-->
        <script type="text/javascript" src="js/amcharts.js"></script>
        <script type="text/javascript" src="js/serial.js"></script>
        <script type="text/javascript" src="js/light.js"></script>
        <script type="text/javascript" src="js/md5-min.js"></script>
        <script type="text/javascript" src="captcha/jquery.captcha.js"></script>
        <link href="captcha/captcha.css" rel="stylesheet" type="text/css"/>
    </head>
	<body style="background:#ccc;">
            <center>
                <div id="principal">
                    <div id="interno">
                        <header class="contenidoheader">
                        </header>
                            <nav class="nav">
                                <ul class="menu">
                                    <li><a href="#Registros" id="Registro">Registro Compras</a></li>
                                    <li><a href="Ventas.php" id="Ventas">Registro Ventas</a></li>
                                    <li><a href="Bodega.php" id="Ventas">Inventario</a></li>
                                    <li><a href="#Pefil" id="Pefil">Pefil</a></li>
                                    <li><a href="index.php" >Cerrar Sesion</a></li>
                                </ul>
                            </nav>
                            <section class="content">
                                <section class="sectiontienda">
                          <?php
			$total=0;
			if(isset($_SESSION['carrito'])){
			$datos=$_SESSION['carrito'];
			
			$total=0;
			for($i=0;$i<count($datos);$i++){
				
	?>
	
				<div class="producto_Carrito">
                                    <center>
                                            <img src="./productos/<?php echo $datos[$i]['Imagen'];?>"><br>
                                            <span style="font-size:15px;"><?php echo $datos[$i]['Nombre'];?></span><br>
                                            <span style="font-size:15px;">Precio: <?php echo $datos[$i]['Precio'];?></span><br>
                                            <span style="font-size:15px;">Cantidad: <input type="text"  value="<?php echo $datos[$i]['Cantidad'];?>"
                                                    data-precio="<?php echo $datos[$i]['Precio'];?>"
                                                    data-id="<?php echo $datos[$i]['Id'];?>"
                                                    class="cantidad">
                                            </span><br>
                                            <span style="font-size:15px;" class="subtotal">Subtotal:<?php echo $datos[$i]['Cantidad']*$datos[$i]['Precio'];?></span><br>

                                    </center>
				</div>
			<?php
				$total=($datos[$i]['Cantidad']*$datos[$i]['Precio'])+$total;
			}
				
			}
			else
			{
				echo '<center><h2>No has añadido ningun producto</h2></center>';
			}
			echo '<center><h2>Total: '.$total.'</h2></center>';
                        
                        if($total!=0)
                        {
                            echo '<a href="./Compras.php" class="aceptar">Comprar</a>';
			}
		
		?>
		<a class="VolverT" href="./Tienda.php">Volver a la tienda</a>
                                </section>
                            </section>
                            <footer class="piedepagina">
                                <div class="texto_depie">
                                     <p id="footerfinal">Copyright © 2015  <a style='text-decoration:none; color:#ff741B; font-size: 14px;' href='#pol' id="politica"> - Todos los derechos Reservados.</a> <br/> Diseño,Maquetacion y Desarrollo.</p>
                                 </div>
                            </footer>
                    </div>
                </div>
            </center>
	</body>
</html>
	
	
        