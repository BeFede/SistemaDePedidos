var montoTotal = parseFloat(0.0);

window.addEventListener('load', function(){

  var cabecera = ["Articulo", "Precio bulto", "Precio unidad", "Stock", "Empaque", "Cantidad",""];
  crearTabla(datos, cabecera, document.getElementById('div-tabla-articulos'));

  $("body").on("click", ".btn-trash",function(){
        removerFila($(this));
  });

  $("#modal-articulos").on("click",".btn-sumar-articulo", function(){
    var articulo_dom = $(this).parent().parent();
    var cantidad = articulo_dom.children('td')[5].childNodes[0].value;

    if (parseInt(cantidad) > 0){

      articulo_dom.children('td')[5].childNodes[0].style.borderColor = "rgb(240,240,240)";
      articulo_dom.remove();

      var nombre = articulo_dom.children('td')[0].childNodes[0].nodeValue;
      var precio_bulto =  articulo_dom.children('td')[1].childNodes[0].nodeValue;
      var precio_unidad = articulo_dom.children('td')[2].childNodes[0].nodeValue;
      var empaque = articulo_dom.children('td')[3].childNodes[0].nodeValue;
      var articulo = crearArticulo(nombre, precio_bulto, precio_unidad, empaque, cantidad);
      agregarArticulo(articulo);
    }
    else {

      articulo_dom.children('td')[5].childNodes[0].style.borderColor = "red";
    }
  });
});


//Remover fila de tabla de articulos pedidos
function removerFila(btn_trash){
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
  var tabla_body = document.getElementById('tabla-articulos-pedidos-cuerpo');
  var art = crearFilaTabla(articulo_pedido);
  tabla_body.appendChild(art);
  montoTotal += parseFloat(articulo_pedido.precioParcial);
  actualizarTotal(montoTotal);
}

function crearFilaTabla(datos){
  var fila = document.createElement('tr');
  $.each(datos, function(j, text) {
    var td = document.createElement('td');
    var text = document.createTextNode(text);
    td.appendChild(text);
    fila.appendChild(td);
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

var datos = [
  {'nombre':'Pepas', 'precioBulto':'15,5', 'precioUnidad':'20','stock':'10'},
  {'nombre':'Galletas', 'precioBulto':'25', 'precioUnidad':'55','stock':'3'},
  {'nombre':'Alfajor', 'precioBulto':'15,5', 'precioUnidad':'15,5','stock':'2'}


]
