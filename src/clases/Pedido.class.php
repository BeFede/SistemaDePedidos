<?php

public class Pedido{
  private $id;
  private $fecha_hora;
  private $detalles_pedido;
  private $vendedor;
  private $monto;
  private $descuento;
  private $estado;

  public function __constructor($vendedor, $descuento){
    $this->fecha_hora = date("y-m-d");
    $this->detalles_pedido = array();
    $this->vendedor = $vendedor;
    $this->descuento = $descuento;
    $this->monto = 0.0;
    //$this->estado = new EstadoPedido(""); 

  }
}
?>
