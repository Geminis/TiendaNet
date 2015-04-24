/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var serviceURL = "http://localhost/TiendaNet/php/";
var pagina;
pagina=$(document);
pagina.ready(inicializar);
function inicializar()
{
    seccionpricipal();
}

function IniciarTabers()
{
    $(".tab_content").hide();
    $("ul.tabs li:first").addClass("active").show();
    $(".tab_content:first").show();

    $("ul.tabs li").click(function()
    {
        $("ul.tabs li").removeClass("active");
        $(this).addClass("active");
        $(".tab_content").hide();

        var activeTab = $(this).find("a").attr("href");
        $(activeTab).show();

        return false;
    });
}

function seccionpricipal()
{
    alert("seccionpricipal");
      var codigoHTML = '<div class="encabezado2">REGISTRO DE COMPRA</div>'+
                            '<div class="cargalambiental">'+
                                '<table class="cargalambiental"'+
                                 '<table cellpadding="0" border="0" width="100%">'+
                                    '<tr>'+
                                        '<th colspan="3" align="center"><img src="Imagenes/Carrito_Compra.png" title="Adicionar Producto" id="AGregarProducto" /></th>'+
                                        '<th align="center">N°</th>'+
                                        '<th align="center">Fecha De Ingreso</th>'+
                                        '<th align="center">Producto</th>'+
                                        '<th align="center">Unidad De Medidad</th>'+
                                        '<th align="center">Valor De la Unidad</th>'+
                                     '</tr>';
   $(".sectiontienda").html(codigoHTML);
   $("#AGregarProducto").click(FuncionCarrito);
}

function FuncionCarrito(evento)
{
    alert("estoy en carrito compra");
    
   '<script>'+
    $.ajax({
     type: "POST",
     url: "tiendacompra.php",
      data: { "codigo" :  "codigo" },
      success: function(data){
          alert(data);
      }
  });
 '</script>';
    
   
}