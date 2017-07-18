function crearArticulo(nombre, precio_bulto, precio_unidad, empaque, cantidad){
    var precio;
    var parcial;
    if (empaque === 'Bulto'){
      precio = parseInt(precio_bulto);
    }
    else {
      precio = parseInt(precio_unidad);
    }
    parcial = parseInt(cantidad) * precio;

    var articulo = {
      'nombre':nombre,
      'precio':precio,
      'cantidad':cantidad,
      'precioParcial':parcial,
      'empaque':empaque
    }

    return articulo;
}
