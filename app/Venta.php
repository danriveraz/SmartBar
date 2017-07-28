<?php

namespace PocketByR;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
  protected $table = 'venta';
  public function scopeSearch($query){
    $query->where('estadoBartender','Por atender')
        ->join('producto', 'venta.idProducto', '=', 'producto.id')
        ->join('categoria', 'producto.idCategoria', '=', 'categoria.id')
        ->select('venta.id','cantidad', 'producto.nombre','categoria.nombre as categoria');
    return $query;
  }
  public function scopeActualizar($query, $pedidos){
    $query->wherein('id', $pedidos)
        ->update(['estadoBartender' => 'Atendido']);
  }
  public function scopeActualizarVenta($query, $rq){
      $id = $rq[0];
      $estado = $rq[1];
      $query->where('id', "$id")
            ->update(['estadoCajero' => "$estado"]);
  }
  public function scopeListarElementos($query, $id){
      $query->where('idFactura', $id)
            ->join('producto', 'venta.idProducto', '=', 'producto.id')
            ->select('nombre', 'cantidad', 'precio', 'venta.id');
      return $query;
  }
  public function scopeListarPendientes($query, $idFactura){
      $query->where([
                  ['idFactura', $idFactura],
                  ['estadoMesero', '<>', 'Cancelado']
              ]);

       return $query->whereColumn('estadoCajero', '<>', 'cantidad')
              ->orWhere([
                  ['estadoMesero', '<>', 'Cancelado'],
                  ['estadoBartender', 'Por atender']
              ]);
  }

  public function scopePedidoActualMesa($query, $idFactura){
      return $query->where('idFactura', $idFactura)
                    ->where('estadoMesero', 'Vigente');
  }

  public function producto(){
    return $this->belongsTo('PocketByR\Producto', 'idProducto', 'id');
  }
}
