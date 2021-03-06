/**
* Crea una tabla "table" en contenedor especificado por parámetro
* @data cuerpo de la tabla
* @head cabecera de la tabla
* @content contenedor html en donde se creará la tabla
*/
function crearTabla(data, head, content, num_pag, pag_active){

  $(content).empty();
  if (data.length != undefined) {
    var tabla = document.createElement('table');
    tabla.className = "table table-responsive table-hover ";

    var cabecera = crearCabecera(head);
    tabla.appendChild(cabecera);
    var cuerpo = crearCuerpo(data, tabla);
    tabla.appendChild(cuerpo);

    content.appendChild(tabla)
    content.appendChild(crearPaginacion(num_pag,pag_active));
}
}



function crearCabecera(itemsCabecera){

  var thead = document.createElement('thead');
  var tr = document.createElement('tr');


  for (var i = 0; i < itemsCabecera.length; i++) {
    var td = document.createElement('td');
    var text = document.createTextNode(itemsCabecera[i]);
    if (itemsCabecera[i] === 'Stock') td.className ="hidden-xs";
    td.appendChild(text);
    tr.appendChild(td);
  }

  thead.appendChild(tr);
  return thead;
}


function crearCuerpo(datos, tabla){
    var tbody = document.createElement('tbody');

    $.each(datos, function(i, item) {
        var tr = document.createElement('tr');
        tr.id = datos[i].id;
        var articulo_ped = enArticulosPedidos(item);

        if (articulo_ped != null){
          $(tr).css("background-color", "rgb(191,255,191)");
        }

          $.each(item, function(j, text) {
            if (j != 'id'){
              var td = document.createElement('td');
              var text = document.createTextNode(text);
              if (j === 'stock') td.className = "hidden-xs";
              td.appendChild(text);
              tr.appendChild(td);
            }
            });

        var td_1 = document.createElement('td');
        var select = document.createElement('select');
        select.className = "form-control select-bulto-unidad";

        if (articulo_ped != null){
          select.disabled = true;
          var op = document.createElement('option');
          var txt = document.createTextNode(articulo_ped.empaque);
          op.appendChild(txt);
          select.appendChild(op);
        }
        else {
          var op1 = document.createElement('option');
          var op2 = document.createElement('option');
          var txt1 = document.createTextNode('Bulto');
          var txt2 = document.createTextNode('Unidad');
          op1.appendChild(txt1);
          op2.appendChild(txt2);
          select.appendChild(op1);
          select.appendChild(op2);
        }

        td_1.appendChild(select);
        tr.appendChild(td_1);

        var td_2 = document.createElement('td');
        var input = document.createElement('input');
        input.type = "text";
        input.class = "form-control";
        //input.readOnly = "true";
        if (articulo_ped != null){
            input.value = articulo_ped.cantidad;
            input.disabled = true;
        }
        else{
          input.value = "0"
        }
        td_2.appendChild(input);
        tr.appendChild(td_2);

        var td_3 = document.createElement('td');
        btn = document.createElement('a');
        var clase = "";
        i = document.createElement('i');
        if (articulo_ped != null){
          i.className = "fa fa-check";
        }
        else {
          i.className = "fa fa-shopping-cart";
          clase = "btn-sumar-articulo";
        }

        btn.className = clase;
        i.ariaHidden = "true";
        btn.appendChild(i);
        td_3.appendChild(btn);

        tr.appendChild(td_3);

        tbody.appendChild(tr);


    });

    return tbody;
}


function crearPaginacion(cantPage, pagActiva){
  var div = document.createElement('div');
  div.style.textAlign = "center";
  var ul = document.createElement('ul');
  ul.className = "pagination";

  for(var i = 0; i < parseInt(cantPage); i++){
    var li = document.createElement('li');
    li.className = "page-item";
    if (pagActiva == (i+1)) li.className += " active";
    var a = document.createElement('a');
    a.className = "page-link";
    a.href = "#";
    var text = document.createTextNode((i+1));
    a.appendChild(text);
    li.appendChild(a);
    ul.appendChild(li);
  }

  div.appendChild(ul);

  return div;
}


function enArticulosPedidos(articulo){
  for (var i = 0; i < articulos_pedidos.length; i++) {

    if (articulos_pedidos[i].nombre == articulo.nombre){
      return articulos_pedidos[i];
    }
  }
  return null;
}
