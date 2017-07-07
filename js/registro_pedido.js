window.addEventListener('load', function(){

  var cabecera = ["Articulo", "Precio", "Stock", "Parcial", "Cantidad"];
  crearTabla(datos, cabecera, document.getElementById('div-tabla-articulos'));

});

var datos = [
  {'nombre':'Avena', 'precio':'15,5','stock':'10'},
  {'nombre':'Cereal', 'precio':'10','stock':'3'},
  {'nombre':'Alfajor', 'precio':'19','stock':'2'}


]
