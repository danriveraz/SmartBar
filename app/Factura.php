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

    public function scopeListar2($query, $idEmpresa){
         $query->where('factura.estado', 'En proceso')
                  ->join('venta', 'factura.id', '=', 'venta.idFactura');
          return $query->groupBy('factura.idMesa')
                  ->orderBy('venta.hora','ASC')
                  ->Where([
                    ['venta.estadoBartender', 'Por atender'],
                    ['venta.estadoMesero', '<>','Cancelado'],
                    ['factura.idEmpresa', $idEmpresa]
                    ]);
    }

    public function scopeListar($query, $idEmpresa){
      return $query->join('mesa', 'factura.idMesa', '=', 'mesa.id')
                   ->where([
                    ['factura.estado', 'En proceso'],
                    ['factura.idEmpresa', $idEmpresa]
                    ])
                   ->select('nombreMesa', 'factura.fecha', 'factura.id as id', 'factura.estado');

    }
    public function scopeBuscarMesaEnProceso($query, $arreglo){
      $nombreMesa = $arreglo[0];
      $idEmpresa = $arreglo[1];
      $query->where('factura.estado','En proceso');
      $query->join('mesa', 'factura.idMesa', '=', 'mesa.id')
            ->where([
                    ['nombreMesa','LIKE',"%$nombreMesa%"],
                    ['factura.idEmpresa', $idEmpresa]
                    ])
            ->select('nombreMesa', 'factura.fecha', 'factura.id as id', 'factura.estado');
      return $query;
    }
    public function scopeBuscarMesa($query, $arreglo){
      $nombreMesa = $arreglo[0];
      $idEmpresa = $arreglo[1];
      $query->join('mesa', 'factura.idMesa', '=', 'mesa.id')
            ->where([
                    ['nombreMesa','LIKE',"%$nombreMesa%"],
                    ['factura.idEmpresa', $idEmpresa]
                    ])
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

    public function scopelistarFacturaDia($query, $idEmpresa){
      $AnhoMes=date("Y-m");
      $dia = date("d");
      $hora = date("G");
      $aux = 0;
      if($hora >= 18){
        $aux = $dia+1;
        $query->where('factura.idEmpresa', $idEmpresa)
          ->whereBetween('fecha', [ "$AnhoMes-$dia 18:00:00.000000", "$AnhoMes-$aux 06:00:00.000000"])
          ->select("id");
        return $query;
      }
      else{
        $aux = $dia-1;
        $query->where('factura.idEmpresa', $idEmpresa)
           ->whereBetween('fecha', [ "$AnhoMes-$aux 18:00:00.000000", "$AnhoMes-$dia 06:00:00.000000"])
          ->select("id");
        return $query;
      }

    }
   public function scopeBuscarFacturas($query, $idEmpresa){
        $query->where('factura.idEmpresa', $idEmpresa)
              ->where('factura.estado','En proceso');
        return $query;
      }
}
