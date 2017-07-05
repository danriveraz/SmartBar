<?php

namespace PocketByR;

use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    //
    protected $table = 'factura';
    public function scopeSearch($query){
    	$query->where('factura.estado','En proceso');
    	$query->join('mesa', 'factura.idMesa', '=', 'mesa.id')
			  ->join('venta', 'factura.id', '=', 'venta.idFactura')
			  ->where('venta.estado', 'Por atender');

		$query ->orderBy('venta.hora','ASC')
               ->groupBy('factura.idMesa')
               ->select('nombreMesa','idFactura', 'venta.hora');
    	return $query;
    }
    public function scopeListar($query){
      return $query->where('estado', 'En proceso')
                   ->join('mesa', 'factura.idMesa', '=', 'mesa.id')
                   ->select('nombreMesa', 'factura.fecha', 'factura.id as id', 'estado');

    }
    public function scopeBuscarMesaEnProceso($query, $nombreMesa){
      $query->where('factura.estado','En proceso');
      $query->join('mesa', 'factura.idMesa', '=', 'mesa.id')
            ->where('nombreMesa','LIKE',"%$nombreMesa%")
            ->select('nombreMesa', 'factura.fecha', 'factura.id as id', 'estado');
      return $query;
    }
    public function scopeBuscarMesa($query, $nombreMesa){
      $query->join('mesa', 'factura.idMesa', '=', 'mesa.id')
            ->where('nombreMesa','LIKE',"%$nombreMesa%")
            ->select('nombreMesa', 'factura.fecha', 'factura.id as id', 'estado');
      return $query;
    }
    public function scopeBuscarFactura($query, $id){
      return $query->where('factura.id', $id)
                   ->join('mesa', 'factura.idMesa', '=', 'mesa.id');
    }

}
