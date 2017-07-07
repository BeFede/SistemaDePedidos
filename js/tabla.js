/**
* Crea una tabla "table" en contenedor especificado por parámetro
* @data cuerpo de la tabla
* @head cabecera de la tabla
* @content contenedor html en donde se creará la tabla
*/
function crearTabla(data, head, content){

  var tabla = document.createElement('table');
  tabla.className = "table table-responsive table-hover ";

  var cabecera = crearCabecera(head);
  tabla.appendChild(cabecera);
  var cuerpo = crearCuerpo(data, tabla);
  tabla.appendChild(cuerpo);

  content.appendChild(tabla)
  content.appendChild(crearPaginacion(5));
}



function crearCabecera(itemsCabecera){

  var thead = document.createElement('thead');
  var tr = document.createElement('tr');


  for (var i = 0; i < itemsCabecera.length; i++) {
    var td = document.createElement('td');
    var text = document.createTextNode(itemsCabecera[i]);
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
        $.each(item, function(j, text) {
          if (text != ""){
          var td = document.createElement('td');
          var text = document.createTextNode(text);
          td.appendChild(text);
          tr.appendChild(td);}
        });

        var tde = document.createElement('td');
        var texte = document.createTextNode("0.0");
        tde.className = "hidden-xs";
        tde.appendChild(texte);
        tr.appendChild(tde);

        var div = document.createElement('div');
        div.className = "input-group ";
        var input = document.createElement('input');
        input.type = "text";
        input.className = 'input-pedir-articulo form-control';
        input.readOnly = "true";
        input.value = "0"
        var i = document.createElement('i');
        i.className = "fa fa-plus";
        var btn = document.createElement('a');
        btn.className = "btn btn-default input-group-addon";
        btn.appendChild(i);
        div.appendChild(input);
        div.appendChild(btn);

        tr.appendChild(div);
        tbody.appendChild(tr);
    });

    return tbody;
}


function crearPaginacion(cantPage){

  var div = document.createElement('div');
  div.style.textAlign = "center";
  var ul = document.createElement('ul');
  ul.className = "pagination";

  for(var i = 0; i < parseInt(cantPage); i++){
    var li = document.createElement('li');
    li.className = "page-item";
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
