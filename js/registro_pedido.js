window.addEventListener('load', function(){

  var cabecera = ["Articulo", "Precio", "Stock", "Parcial", "Cantidad",""];
  crearTabla(datos, cabecera, document.getElementById('div-tabla-articulos'));

  $("body").on("click", ".borrar_fila",function(){
        removerFila($(this));
  });

});

//Remover fila de tabla de articulos pedidos
function removerFila(btn_trash){
  btn_trash.parent().parent().parent().remove();
}

var datos = [
  {'nombre':'Avena', 'precio':'15,5','stock':'10'},
  {'nombre':'Cereal', 'precio':'10','stock':'3'},
  {'nombre':'Alfajor', 'precio':'19','stock':'2'}


]
