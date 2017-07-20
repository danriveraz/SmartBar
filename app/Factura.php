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
               ->select('nombreMesa','idFactura', 'venta.hora', 'mesa.id');
    	return $query;
    }

    public function ventas(){
      return $this->hasMany('PocketByR\Venta', 'idFactura', 'idFactura')
                  ->where('venta.estado', 'Por atender');
    }

    public function mesa(){
      return $this->belongsTo('PocketByR\Mesa', 'idMesa', 'id');                
    }

    public function ventasHechas(){
      return $this->hasMany('PocketByR\Venta', 'idFactura', 'id')
                  ->where('venta.estado', 'Atendido');
    }

    public function scopeListar2($query){
         $query->where('factura.estado', 'En proceso')
                  ->join('venta', 'factura.id', '=', 'venta.idFactura');
          return $query->groupBy('factura.idMesa')
                  ->orderBy('venta.hora','ASC')
                  ->where('venta.estado', 'Por atender');
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
       $query->where('factura.estado', 'En proceso')
                  ->join('venta', 'factura.id', '=', 'venta.idFactura');
         $query->groupBy('factura.idMesa')
                  ->orderBy('venta.hora','ASC')
                  ->where('venta.estado', 'Por atender');
        return $query->where('factura.id', '$id');
    }

    public function scopeActualizarValor($query, $request){
        $query->where('factura.id', "$request->idFactura")
          ->update(['factura.total' => "$request->valor"]); 
    }
    public function scopeActualizarFactura($query, $id){
        $query->where('factura.id', "$id")
          ->update(['factura.estado' => "Finalizada"]); 
    }


}
