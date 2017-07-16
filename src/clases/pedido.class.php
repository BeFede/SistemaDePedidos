<?php

public class Pedido{
  private $_id;
  private $_fecha_hora;
  private $_detalles_pedido;
  private $_vendedor;
  private $_monto;
  private $_porcentaje_descuento;
  private $_estado;

  //Hay dos tipos de productos de disitnto IVA
  //Se debe guardar para saber cuanto se paga por cada uno
  private $monto_por_IVA1;
  private $monto_porIVA2;

}
?>
