<?php

namespace PocketByR;

use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    //
    protected $table = 'factura';

    public function ventas(){
      return $this->hasMany('PocketByR\Venta', 'idFactura', 'idFactura')
                  ->Where([
                    ['venta.estadoBartender', 'Por atender'],
                    ['venta.estadoMesero', '<>','Cancelado']
                ]);
    }

    public function mesa(){
      return $this->belongsTo('PocketByR\Mesa', 'idMesa', 'id');
    }

    public function ventasHechas(){
      return $this->hasMany('PocketByR\Venta', 'idFactura', 'id');
    }

    public function scopeListar2($query){
         $query->where('factura.estado', 'En proceso')
                  ->join('venta', 'factura.id', '=', 'venta.idFactura');
          return $query->groupBy('factura.idMesa')
                  ->orderBy('venta.hora','ASC')
                  ->Where([
                    ['venta.estadoBartender', 'Por atender'],
                    ['venta.estadoMesero', '<>','Cancelado']
                    ]);
    }

    public function scopeListar($query){
      return $query->where('factura.estado', 'En proceso')
                   ->join('mesa', 'factura.idMesa', '=', 'mesa.id')
                   ->select('nombreMesa', 'factura.fecha', 'factura.id as id', 'factura.estado');

    }
    public function scopeBuscarMesaEnProceso($query, $nombreMesa){
      $query->where('factura.estado','En proceso');
      $query->join('mesa', 'factura.idMesa', '=', 'mesa.id')
            ->where('nombreMesa','LIKE',"%$nombreMesa%")
            ->select('nombreMesa', 'factura.fecha', 'factura.id as id', 'factura.estado');
      return $query;
    }
    public function scopeBuscarMesa($query, $nombreMesa){
      $query->join('mesa', 'factura.idMesa', '=', 'mesa.id')
            ->where('nombreMesa','LIKE',"%$nombreMesa%")
            ->select('nombreMesa', 'factura.fecha', 'factura.id as id', 'factura.estado');
      return $query;
    }

    public function scopeActualizarValor($query, $request){
        $query->where('factura.id', "$request->idFactura")
          ->update(['factura.total' => "$request->valor"]);
    }
    public function scopeActualizarFactura($query, $id){
        $query->where('factura.id', "$id")
          ->update(['factura.estado' => "Finalizada"]);
    }

    public function scopeBuscarFacturaId($query, $idMesa){
      $query->where('factura.estado','En proceso');
      $query->join('mesa', 'factura.idMesa', '=', 'mesa.id')
            ->where('mesa.id', $idMesa)
            ->select('factura.id as id');
      return $query;

    }

}
