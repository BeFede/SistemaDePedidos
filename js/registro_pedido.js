var montoTotal = parseFloat(0.0);
var page_size = 3;
var cabecera = ["Articulo", "Precio bulto", "Precio unidad", "Stock", "Empaque", "Cantidad"];
var filtro_articulos = "";
var articulos_pedidos = [];

window.addEventListener('load', function(){

  $("body").on("click", ".page-link",function(){
        var page_number = parseInt($(this).html());
        obtenerArticulos(page_size, page_number);
  });


  $("body").on("click", ".btn-trash",function(){
        removerFila($(this));
  });

  $("body").on("click", "#btn-vis-modal",function(){
        filtro_articulos = "";
        obtenerArticulos(page_size, 1);
  });


  $("#modal-articulos").on("click","#btn-filtro-articulos", function(){
    filtro_articulos = document.getElementById("input-filtro-articulo").value;
    document.getElementById("input-filtro-articulo").value = "";

    obtenerArticulos(page_size, 1)
  });

  $("#modal-articulos").on("click",".btn-sumar-articulo", function(){
    var articulo_dom = $(this).parent().parent();
    var cantidad = articulo_dom.children('td')[5].childNodes[0].value;

    if (parseInt(cantidad) > 0){

      articulo_dom.children('td')[5].childNodes[0].style.borderColor = "rgb(240,240,240)";

      $(this).css("cursor","default");
      $(this).removeClass('btn-sumar-articulo');
      $(articulo_dom).css("background-color","rgb(191,255,191");
      $(articulo_dom).children('td')[4].childNodes[0].disabled = true;
      articulo_dom.children('td')[5].childNodes[0].disabled = true;

      $($(articulo_dom).children('td')[6].childNodes[0].childNodes[0]).removeClass('fa-shopping-cart');
      $($(articulo_dom).children('td')[6].childNodes[0].childNodes[0]).addClass('fa-check');

      var id = this.parentNode.parentNode.id;
      console.log(id);
      var nombre = articulo_dom.children('td')[0].childNodes[0].nodeValue;
      var precio_bulto =  articulo_dom.children('td')[1].childNodes[0].nodeValue;
      var precio_unidad = articulo_dom.children('td')[2].childNodes[0].nodeValue;
      var empaque = articulo_dom.children('td')[4].childNodes[0].value;

      var articulo = crearArticulo(id, nombre, precio_bulto, precio_unidad, empaque, cantidad);
      agregarArticulo(articulo);
    }
    else {
      articulo_dom.children('td')[5].childNodes[0].style.borderColor = "rgb(255,120,120)";
      //articulo_dom.children('td')[5].childNodes[0].style.backgroundColor = "rgb(255,150,150)";
    }
  });
});


//Remover fila de tabla de articulos pedidos
function removerFila(btn_trash){
  var nombre = btn_trash.parent().parent().parent().children('td')[0].childNodes[0].nodeValue;

  for (var i = 0; i < articulos_pedidos.length; i++){

    if (articulos_pedidos[0].nombre == nombre){
      articulos_pedidos.splice(i, 1);
    }
  }

  var montoParcial = btn_trash.parent().parent().parent().children('td')[3].childNodes[0].nodeValue;
  montoTotal -= parseFloat(montoParcial);
  btn_trash.parent().parent().parent().remove();
  actualizarTotal(montoTotal);
}

/**
* Agrega una fila en la tabla de artículos pedidos
* @param articulo_pedido json del articulo pedido con
* nombre, stock, cantidad_pedida, precio
*/
function agregarArticulo(articulo_pedido){
  articulos_pedidos.push(articulo_pedido);

  var tabla_body = document.getElementById('tabla-articulos-pedidos-cuerpo');
  var art = crearFilaTabla(articulo_pedido);
  tabla_body.appendChild(art);
  montoTotal += parseFloat(articulo_pedido.precioParcial);
  actualizarTotal(montoTotal);
}

function crearFilaTabla(datos){

  var fila = document.createElement('tr');

  $.each(datos, function(j, txt) {
    if (j != 'id'){
      var td = document.createElement('td');
      var text = document.createTextNode(txt);
      td.appendChild(text);
      fila.appendChild(td);
}
      var input_hidden = document.createElement('input');
      input_hidden.type = "hidden";
      input_hidden.name = j+"[]";
      input_hidden.value = txt;
      fila.appendChild(input_hidden);


  });

  var td = document.createElement('td');
  var a = document.createElement('a');
  a.href = "#";
  var i = document.createElement('i');
  i.className = "fa fa-trash-o btn-trash";
  i.ariaHidden = "true";
  a.appendChild(i);
  td.appendChild(a);
  fila.appendChild(td);

  return fila;
}

//Actualización gráfica
function actualizarTotal(monto){
  var divTotal = document.getElementById('lbl-monto-total').innerHTML = monto;
}

function obtenerArticulos(tamano_pagina, numero_pagina){

  $.ajax({
        url: "../src/ctrl/ajax/obtener_articulos.ajax.php",
        data: {
          'data': 'articulos',
          'tamano_pagina':tamano_pagina,
          'numero_pagina':numero_pagina,
          'nombre_articulo':filtro_articulos
        },
      //  contentType: "application/json",
        dataType: 'json',
        type: 'POST',
        success: function(json){
                crearTabla(json.articulos, cabecera, document.getElementById('div-tabla-articulos'), json.paginas, json.pag_active);
          //crearTabla(json.examenes, json.cantidad_paginas, numero_pagina);
        },
        error: function(xhr, status){
          console.log("No se han podido obtener los artículos");
          console.log(xhr);
          console.log(status);
        }
    });

}
