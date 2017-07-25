function crearArticulo(id, nombre, precio_bulto, precio_unidad, empaque, cantidad){

    var precio;
    var parcial;

    if (empaque === 'Bulto'){

      precio = parseFloat(precio_bulto);
    }
    else {
      precio = parseFloat(precio_unidad);
    }
    parcial = parseInt(cantidad) * precio;

    var articulo = {
      'id':id,
      'nombre':nombre,
      'precio':precio,
      'cantidad':cantidad,
      'precioParcial':parcial,
      'empaque':empaque
    }

    return articulo;
}
